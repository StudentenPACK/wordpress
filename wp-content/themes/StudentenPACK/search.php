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
	<?php 
		echo '<h1 class="page_title">Suchergebnis für "'.$_GET['s'].'"</h1>';
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
	<?php 
	echo '<div class="sidebar-section">';
		echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/stats16px.png" alt="statistiken"/> '.' Statistik</h2>';
		echo '<p class="smalltext">';
    		echo $wp_query->found_posts.' Artikel';
    	echo '</p>';
    	
		$parameters = ($wp_query->query_vars);
    	$parameters['nopaging'] = true;
       	$myquery= new WP_Query($parameters);
       	$posts=$myquery->posts;	
       	if((sizeof($posts)) > 1){
    		echo '<p class="smalltext">';
    		echo 'Zeitraum: '.get_the_time( 'j. F Y', ($posts[(sizeof($posts)) - 1]->ID)).' – '.get_the_time( 'j. F Y', ($posts[0]->ID));
	    	echo '</p>';   
       	}
      	foreach($posts as $p){
      		$tmp = get_coauthors($p->ID);
  			foreach ($tmp as $t){
       			$authors[] = $t->display_name;
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
    	wp_reset_postdata();
    echo '</div>';
    	
	
	?>
</div>
<?php else: ?>

olol, alles weg, gnihihi!

<?php endif; ?>
</div>

<?php get_footer(); ?>