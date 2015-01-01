<?php
/**
 * Dieses Template wird für das Audimieze-Archiv verwendet. Es gibt exakt 0 Unterschiede zum ULC-Template.
 */
get_header(); ?>

<div class="box">
<?php 
	//Alles auf einer Seite anzeigen, Comics abfragen
	$parameters = ($wp_query->query_vars);
	$parameters['nopaging'] = true;
	$parameters['post_type'] = array('comic','post');
	query_posts($parameters);
	$posts=get_posts($parameters);
	if (have_posts()) : 
		//Hierarchie anzeigen
		if (is_category()){
		$this_category = get_category($cat);
		if($this_category->category_parent != 0){
			echo '<h2 class="page_title_hierarchy">';
			echo get_category_parents($this_category->category_parent, true, ' &raquo; ');
			echo '</h2>';
		}
		//Autor und Zeitraum anzeigen
		echo '<h2 class="page_title_author_date">';

			foreach($posts as $p){
       			$tmp = get_coauthors($p->ID);
       			foreach ($tmp as $t){
       				if ($t->ID != 1){
       					$authors[] = $t->display_name;
       				}
       			}
       		}
       		$authors = array_unique($authors);
   			asort($authors);
   			if (count($authors) > 1){
   				foreach($authors as $a){
   					echo $a.', ';
   				} 
   			} else if (count($authors) == 1) {
   				echo $authors[0];
   			}
   			echo ' | ';

			$range= get_the_time( 'F Y', ($posts[(sizeof($posts)) - 1]->ID)).' – '.get_the_time( 'F Y', ($posts[0]->ID));
			echo $range;
		echo '</h2>';
		echo '<h1 class="page_title">';
		single_cat_title('', true);
		echo '<a href="'.get_category_feed_link(get_query_var('cat')).'" title="Abonniere diese Rubrik"><img src="'.get_bloginfo('template_directory').'/images/rss.png" alt=""/></a>';
		echo '</h1>';

		if (have_posts()) {
			echo '<div class="gallery">';
			echo '<p class="cat_description smalltext">'.$this_category->description.'</p>';
			while (have_posts()) {
				the_post(); 
				echo '<div class="gallery_element">';
				echo '<h2 class="smalltitle">'.get_the_title().'</h2>';
				echo '<a href="'.get_permalink().'">';
				the_post_thumbnail('square');
				echo '</a></div>';

			}				
			echo '</div>';
		} else {}
	}?>
<?php else: ?>

<!-- olol, alles weg, gnihihi! -->

<?php endif; ?>
</div>

<?php get_footer(); ?>