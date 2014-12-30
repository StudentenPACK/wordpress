<?php
/**
 * Dies ist das Standard-Template für Seiten (pages)
 */
get_header(); ?>

<div class="box">
	<div class="page_frame">
		<?php if (have_posts()) :

			while (have_posts()) : the_post(); ?>
		
				<h1 class="page_title"><?php the_title();?></h1>
				<div class="article-body fulltext">
					<?php 
					//kein Schnickschnack, einfach nur Content aus dem CMS
					the_content();?>
				</div>
				<p class="page_modified">Seite bearbeitet: <?php the_modified_time('j. M Y H:i'); ?></p>
	
			<?php endwhile;
		else: ?>

			<!-- olol, alles weg, gnihihi! -->

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>