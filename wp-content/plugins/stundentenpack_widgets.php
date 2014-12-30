<?php 
/*
Plugin Name: StudentenPACK Widgets
Plugin URI: http://www.studentenpack.uni-luebeck.de/
Version: 1.0
Description: Widgets für die StudentenPACK Homepage
Author: Philipp Bohnenstengel
Author URI: http://www.phibography.de/
*/
?>

<?php
/* Excerpt */

class ExcerptWidget extends WP_Widget {
	
	function ExcerptWidget() {
 	   $widget_ops = array('classname' => 'ExcerptWidget', 'description' => 'Zeigt von einer Rubrik das Excerpt des neuesten Artikels an' );
 	   $this->WP_Widget('ExcerptWidget', 'StudentenPACK: Excerpt', $widget_ops);
 	}
 
  	function form($instance) {
 	   $instance = wp_parse_args( (array) $instance, array( 'category' => '' ) );
 	   $category = $instance['category']
?>
 		<p>
 			<label for="<?php echo $this->get_field_id('category'); ?>">Rubrik (ID): 
 				<input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
 			</label>
 		</p>


<?php
	}
 
  	function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    $instance['category'] = $new_instance['category'];
	    return $instance;
  	}
 
  	function widget($args, $instance) {
	    extract($args, EXTR_SKIP);
 
	    echo $before_widget;
	    //$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	    $title = '<a href="'.get_category_link($instance['category']).'">'.get_cat_name($instance['category']).'</a>';
	 
	    if (!empty($title)) {
	    	echo $before_title . $title . $after_title;;
	    }

    	// WIDGET CODE GOES HERE
		query_posts('cat='.$instance['category'].'&posts_per_page=1');
		if (have_posts()) {
			while (have_posts()) { 
				the_post();
				echo '<h1 class="smallarticle_title">'.get_the_title().'</h1>';
				echo '<div class="smallarticle_body fulltext">'.get_the_content('&raquo; weiterlesen').'</div>';
			}
		} else {
		}

		rewind_posts(); 
		wp_reset_query(); 
		wp_reset_postdata();

    	echo $after_widget;
  	}
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("ExcerptWidget");') );?>

<?php
/* Rubrik */

class RubrikWidget extends WP_Widget {
	function RubrikWidget() {
 	   $widget_ops = array('classname' => 'RubrikWidget', 'description' => 'Zeigt von einer Rubrik die neuesten 5 Artikel an, der neueste mit Bild' );
 	   $this->WP_Widget('RubrikWidget', 'StudentenPACK: Rubrik', $widget_ops);
 	}
 
  	function form($instance) {
 	   $instance = wp_parse_args( (array) $instance, array( 'category' => '' ) );
 	   $category = $instance['category']
?>
 		<p>
 			<label for="<?php echo $this->get_field_id('category'); ?>">Rubrik (ID): 
 				<input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
 			</label>
 		</p>


<?php
	}
 
  	function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    $instance['category'] = $new_instance['category'];
	    return $instance;
  	}
 
  	function widget($args, $instance) {
	    extract($args, EXTR_SKIP);
 
	    echo $before_widget;
	    //$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	 	$title = '<span class="colorsquare '.get_category($instance['category'])->slug.'">&nbsp;</span>'.'<a href="'.get_category_link($instance['category']).'">'.get_cat_name($instance['category']).'</a>';
	 
	    if (!empty($title)) {
	    	echo $before_title . $title . $after_title;;
	    }

    	// WIDGET CODE GOES HERE
		query_posts('cat='.$instance['category'].'&posts_per_page=5'); 
		$loopcounter = 0; 
		if (have_posts()) {
			while (have_posts()) {
				the_post(); 
				$loopcounter++; 
				if ($loopcounter == 1) {
					echo '<span class="post_in_list_thumbnail">';
					if (has_post_thumbnail()) { 
						echo '<a href="'.get_permalink().'">';
						the_post_thumbnail('frontpage-category');
						echo '</a>';
					} else {
						echo '<a href="'.get_permalink().'"><img src="http://dummyimage.com/324x100/eeeeee/B50022.gif&text='.get_category($instance['category'])->slug.'" alt=""/></a>';
					}
					echo '</span>';
				}
				echo '<p class="smalltext post_smallinfo contentarea">';
					echo '<a href="'.get_permalink().'">';
						echo '<span class="post_smallinfo_category">';
							$tmp=get_the_category(); 
							echo $tmp[0]->cat_name;
						echo ': </span>'; 
						the_title(); 
					echo '</a><br/>';
					echo '<span class="post_smallinfo_time" title="'.get_the_date('j. F Y H:i').'">';
						echo TimeAgo(get_the_time('U'));
					echo '</span>';
				echo '</p>';
			}				
		} else {}

		rewind_posts();
		wp_reset_query(); 
		wp_reset_postdata();
		
    	echo $after_widget;
  	}
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("RubrikWidget");') );?>