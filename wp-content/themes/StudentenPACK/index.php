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

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	
		<?php include('postinlist.php'); ?>

	<?php endwhile; ?>
	
	<div class="colorscheme_navi">
		<?php next_posts_link('ältere Artikel'); ?>
		<?php previous_posts_link('neuere Artikel'); ?>
	</div>
<?php else: ?>

olol, alles weg, gnihihi!

<?php endif; ?>

<?php get_footer(); ?>