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
	<div class="page_frame">
		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>
		
				<h1 class="page_title"><?php the_title();?></h1>
				<div class="article-body fulltext">
					<?php the_content();?>
				</div>
				<p class="page_modified">Stand: <?php the_modified_time('j. M Y H:i:s'); ?></p>
	
			<?php endwhile; ?>
		<?php else: ?>

			olol, alles weg, gnihihi!

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>