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
get_header();
?>

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<?php the_category( '&gt;', 'multiple', false ); ?> 

<?php the_tags( '', '&middot;', '' ); ?> 

<?php the_title(); ?>

<?php coauthors(); ?>

<?php the_content(); ?>

<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>