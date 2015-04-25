<?php
/**
 * Default Template, wenn nichts anderes zugeordnet wird. Kommt glaub ich nicht vor...
 */
get_header(); ?>

<div class="box">
<?php 
if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	
		<?php include('postinlist.php'); ?>

	<?php endwhile; ?>
	
	<div class="colorscheme_navi">
		<?php next_posts_link('ältere Artikel'); ?>
		<?php previous_posts_link('neuere Artikel'); ?>
	</div>
<?php else: ?>

<!-- olol, alles weg, gnihihi! -->

<?php endif; ?>
</div>

<?php get_footer(); ?>