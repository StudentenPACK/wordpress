<?php
/**
 * Dieses Template wird für die Übersichtsseite der Comics verwendet. 
 */
get_header(); ?>

<div class="box">
<?php 
//comics abfragen
$parameters = ($wp_query->query_vars);
$parameters['post_type'] = array('comic','post');
query_posts($parameters);

if (have_posts()) : ?>
	<?php 
	if (is_category()){
		//Anzeige der Hierarchie
		$this_category = get_category($cat);
		if($this_category->category_parent != 0){
			echo '<h2 class="page_title_hierarchy">';
			echo get_category_parents($this_category->category_parent, true, ' &raquo; ').'<br/>';
			echo '</h2>';
		}

		echo '<h1 class="page_title">';
		single_cat_title('', true);
		echo '<a href="'.get_category_feed_link(get_query_var('cat')).'" title="Abonniere diese Rubrik"><img src="'.get_bloginfo('template_directory').'/images/rss.png" alt=""/></a>';
		echo '</h1>';

		//Unterkategorien (Comicserien) abfragen
		if (get_category_children($this_category->cat_ID) != "") {
    		$comics = get_categories('child_of='.$this_category->cat_ID);
    		foreach ($comics as $com) {
    			//für jede Comicserie den aktuellsten Comis abfragen
				query_posts(array('cat' => ($com->cat_ID), 'posts_per_page' => 1 , 'post_type' => array('comic','post'))); 

				if (have_posts()) {
					while (have_posts()) {
					the_post();
					echo '<div class="showroom_block">';
						//hier wird das gleiche Design verwendet wie auf der Startseite für die aktuelle Titelstory 
						echo '<div class="featured-post">';
							the_post_thumbnail('featured-post');
							echo '<a href="'.get_category_link( $com->cat_ID ).'"><div class="featured-post_title contentarea">';
								//Zeitraum berechnen
								$parameters = ($wp_query->query_vars);
	   							$parameters['nopaging'] = true;
	      						$myquery= new WP_Query($parameters);
	       						$posts=$myquery->posts;	
				    			$range= get_the_time( 'Y', ($posts[(sizeof($posts)) - 1]->ID)).' – '.get_the_time( 'Y', ($posts[0]->ID));
					    		wp_reset_postdata();
								echo '<h1>'.$com->name.': '.$com->count.' Folge'.((($com->count) != 1) ? 'n' : '').' ('.$range.')</h1>';
							echo '</div></a>';
						echo '</div>';
						//Anzeige des Beschreibungstexts
						echo '<div class="featured-post_description smalltext">';
							echo $com->description;
						echo '</div>';
		       		echo '</div>';
					}				
				} else {}

				rewind_posts();
				wp_reset_query(); 
				wp_reset_postdata();
       		}
    	}
	}?>
<?php else: ?>

<!-- olol, alles weg, gnihihi! -->
<?php endif; ?>
</div>

<?php get_footer(); ?>