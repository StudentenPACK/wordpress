<?php
/**
 * Theme Name: StudentenPACK
 * Theme URI: http://www.phibography.de/
 * Description: StudentenPACK Homepage
 * Author: Philipp Bohnenstengel
 * Author URI: http://www.phibography.de/
 * Version: 0.1 
 * Tags: 
 * 
 * License:
 * License URI:
 * 
 * General comments (optional).
 */
get_header(); ?>

<div class="box">
<?php if (have_posts()) : ?>
<div class="archive_list">
	<?php if (is_category()){
		echo '<h1 class="page_title">';
		single_cat_title('Rubrik: ', true);
		echo '<a href="'.get_category_feed_link(get_query_var('cat')).'" title="Abonniere diese Rubrik"><img src="'.get_bloginfo('template_directory').'/images/rss.png" alt=""/></a>';
		echo '</h1>';
	} elseif (is_tag()){
		echo '<h1 class="page_title">';
		single_tag_title('Thema: ', true);
		echo '</h1>';
	} elseif (is_author()){
		echo '<h1 class="page_title">Artikel von ';
		the_author_meta('display_name', get_query_var('author'));
		echo '<a href="'.get_author_feed_link(get_query_var('author')).'" title="Abonniere diesen Autoren"><img src="'.get_bloginfo('template_directory').'/images/rss.png" alt=""/></a>';
		echo '</h1>';
	} elseif (is_month()){
		echo '<h1 class="page_title">Archiv: ';
		the_time('F Y');
		echo '</h1>';
	} elseif (is_year()){
		echo '<h1 class="page_title">Archiv: ';
		the_time('Y');
		echo '</h1>';
	} elseif (is_day()){
		echo '<h1 class="page_title">Archiv: ';
		the_time('jS F Y');
		echo '</h1>';
	} else {
		echo '<h1 class="page_title">Archiv</h1>';
	}	
	?>
	<?php while (have_posts()) : the_post(); ?>
	
		<?php include('postinlist.php'); ?>

	<?php endwhile; ?>
	
		<p class="interaction_box">
			<?php next_posts_link('ältere Artikel'); ?>
			<?php previous_posts_link('neuere Artikel'); ?>
		</p>
</div>
<div class="sidebar colorscheme_navi">
	<?php if(is_category){
		$this_category = get_category($cat);
		
		if($this_category->description != ""){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/description16px.png" alt="beschreibung"/> '.' Beschreibung</h2>';
			echo '<p class="smalltext">';
			echo $this_category->description;
			echo '</p>';
			echo '</div>';
		}
		if($this_category->category_parent != 0){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/category16px.png" alt="hierarchie"/> '.' Hierarchie</h2>';
			echo '<p class="smalltext">';
			echo get_category_parents($this_category->category_parent, true, ' &raquo; ').$this_category->cat_name;
			echo '</p>';
			echo '</div>';
		}
  		if (get_category_children($this_category->cat_ID) != "") {
    		echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/subcategory16px.png" alt="unterrubriken"/> '.' Unter-Rubriken</h2>';
			echo '<ul class="sidebar_list_categories smalltext">';
    		wp_list_categories('orderby=id&show_count=0&title_li=&child_of='.$this_category->cat_ID);
    		echo '</ul>';	
			echo '</div>';
    	}	
    	
	}
	if (is_author()){
		if (get_the_author_meta('description', get_query_var('author')) != ""){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/author16px.png" alt="autor"/> '.' Bio</h2>';
			echo '<div class="sidebar_avatar">'.get_avatar(get_query_var('author'),150).'</div>';
			echo '<p class="smalltext">';
			echo get_the_author_meta('description', get_query_var('author'));
			echo '</p>';
			echo '</div>';
		}
		if (get_the_author_meta('user_url', get_query_var('author')) != ""){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/www16px.png" alt="homepage"/> '.' Homepage</h2>';
			echo '<p class="smalltext">';
			echo '<a href="'.get_the_author_meta('user_url', get_query_var('author')).'">'.get_the_author_meta('user_url', get_query_var('author')).'</a>';
			echo '</p>';			
			echo '</div>';
		}
	}
	if(is_month()){
		$year = get_the_time('Y');
		$month = get_the_time('n');
		//105 = Heftarchiv
		$myquery= new WP_Query('cat=105&year='.$year.'&monthnum='.$month.'&order=DESC&posts_per_page=1');
		if ($myquery->have_posts()) :
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/pdf16px.png" alt="pdf"/> '.' Das Heft</h2>';
			while ($myquery->have_posts()) : $myquery->the_post();
				echo '<div class="sidebar_avatar"><a href="'.get_permalink().'">';
				echo the_post_thumbnail('sidebar');
				echo '</a></div>';
				echo '<p class="smalltext"><a href="'.get_permalink().'">zur Heftseite</a></p>';
			endwhile;		
			echo '</div>';
		else: 

		endif; 
		wp_reset_postdata();
	}
	echo '<div class="sidebar-section">';
		echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/stats16px.png" alt="statistik"/> '.' Statistik</h2>';
		echo '<p class="smalltext">';
    		echo $wp_query->found_posts.' Artikel';
    	echo '</p>';
    	
		$parameters = ($wp_query->query_vars);
    	$parameters['nopaging'] = true;
       	$myquery= new WP_Query($parameters);
       	$posts=$myquery->posts;	
       	if((!is_month()) && (sizeof($posts)) > 1){
    		echo '<p class="smalltext">';
    		echo 'Zeitraum: '.get_the_time( 'j. F Y', ($posts[(sizeof($posts)) - 1]->ID)).' – '.get_the_time( 'j. F Y', ($posts[0]->ID));
	    	echo '</p>';   
       	}
       	if(!is_author()){
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
   			if (count($authors) > 0){
   				echo '<p class="smalltext">'.(count($authors) > 1 ? count($authors).' Autoren' : '1 Autor').':';
   				echo '<ul class="sidebar_list_categories smalltext">';
   				foreach($authors as $a){
   					echo '<li>'.$a.'</li>';
   				}
    			echo '</li></p>'; 
   			}
       	}
    	wp_reset_postdata();
    echo '</div>';
    	
	
	?>
</div>
<?php else: ?>

olol, alles weg, gnihihi!

<?php endif; ?>
</div>

<?php get_footer(); ?>