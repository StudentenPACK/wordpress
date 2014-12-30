<?php
/**
 * Dieses Template wird für Events der Deadline benutzt. Es war nötig, um bei von Facebook importierten Events einen Hinweis
 * anzuzeigen, dass die Zeitangabe nicht immer zuverlässig übertragen wurde. Da diese Bug anscheinend nicht mehr auftritt,
 * kann das Template eigentlich auch wieder weg...
 */
get_header(); ?>

<div class="box">
	<div class="page_frame">
		<?php if (have_posts()) :

			while (have_posts()) : the_post(); ?>
		
				<h1 class="page_title"><?php the_title();?></h1>
				<!--<?php if (has_term('Facebook','events_tags')) : ?>
					<div class="article-infobox">
						<p class="smalltext" style="padding-top: 10px;">Dieser Termin wurde aus Facebook ausgelesen. Aufgrund einer technischen Einchränkung kann es in seltenen Fällen vorkommen, dass die Zeitangabe fehlerhaft ist. Bitte die korrekte Zeit über den Link "Originalbeitrag" überprüfen.</p>
					</div>
				<?php endif ?> -->
				<div class="article-body fulltext">
				<?php the_content();?>
				</div>	
			<?php endwhile;
		else: ?>

			<!-- olol, alles weg, gnihihi! -->

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>