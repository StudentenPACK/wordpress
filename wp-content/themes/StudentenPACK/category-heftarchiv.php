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
<?php
	//neue Query ohne Seitenlimit
	$parameters = ($wp_query->query_vars);
    $parameters['nopaging'] = true;
    $wp_query= new WP_Query($parameters);
?>
<?php if (have_posts()) : ?>
	<h1 class="page_title">Heftarchiv 
		<?php echo '<a href="'.get_category_feed_link(get_query_var('cat')).'"><img src="'.get_bloginfo('template_directory').'/images/rss.png" alt=""/></a>';
		?>
	</h1>
	<?php $posts = $wp_query->posts;
		foreach ($posts as $p){
			$dates[] = get_the_time('Y', $p->ID);
		}
		$dates = array_unique($dates);
		asort($dates);
		echo '<p class="interaction_box">';
		foreach ($dates as $d){
			echo '<a href="#'.$d.'">'.$d.'</a> ';
		}
		echo '</p>'; ?>
	<div class="gallery">
	<?php $year = 0; ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php 
			if($year != get_the_time('Y')){
				echo '<h2 class="smallarticle_title"><a name="'.get_the_time('Y').'">'.get_the_time('Y').'</a></h2>';
				$year = get_the_time('Y');
			}
		
		?>
		<div class="gallery_element">
		<?php 
			echo '<h2 class="smalltitle">'.get_the_time('F').': '.get_the_title().'</h2>';
			echo '<a href="'.get_permalink().'">';
			the_post_thumbnail('sidebar');
			echo '</a>';
		?>
		</div>

	<?php endwhile; ?>
	</div>
	<div class="colorscheme_navi">
		<?php next_posts_link('ältere Artikel'); ?>
		<?php previous_posts_link('neuere Artikel'); ?>
	</div>
<?php else: ?>

olol, alles weg, gnihihi!

<?php endif; ?>
</div>

<?php get_footer(); ?>