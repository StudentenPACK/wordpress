<?php
/**
 * Dieses Template ist für die Gastartikel-Seite. Neben dem normalen Seiteninhalt wird falls festgelegt eine Deadline angezeigt.
 */
get_header(); ?>

<div class="box">
	<div class="page_frame">
		<?php if (have_posts()) :

			while (have_posts()) : the_post();
					//frage noch nicht erschienene Posts der Kategorie Heftarchiv ab
					$myquery = new WP_Query( array( 'post_status' => array( /*'pending', 'draft',*/ 'future' ), 'cat' => 105, 'orderby' => 'date' , 'order' => 'ASC') );
					$posts = $myquery->posts;
					if(count($posts)>0){
						$nextissue = $posts[0];
						$date = $nextissue->post_date;
						$deadline = new DateTime($date);
						//zeige an, wann die nächste Ausgabe erscheinen soll
						echo '<p>Die nächste Ausgabe erscheint am '.$deadline->format('d.m.Y').'. ';
						//Deadline zwei Wochen vorher
						$deadline = $deadline->modify('-15days');
						echo '<span style="text-decoration: underline;">Deadline für externe Texte ist der <span style="color: red; font-weight: bold;"> '.$deadline->format('d.m.Y').'</span></span>, damit Zeit für Rückfragen bleibt.</p>';
					} 
				?>
				<h1 class="page_title"><?php the_title();?></h1>
				<div class="article-body fulltext">
					<?php the_content();?>
				</div>
				<p class="page_modified">Seite bearbeitet: <?php the_modified_time('j. M Y H:i'); ?></p>
	
			<?php endwhile;
		else: ?>

			<!-- olol, alles weg, gnihihi! -->

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
