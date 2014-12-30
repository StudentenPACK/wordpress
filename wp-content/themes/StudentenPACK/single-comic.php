<?php
/**
 * Dieses Template wird für einzelne Comics verwendet
 */
get_header();
if (have_posts()) :

while (have_posts()) : the_post(); ?>

<div class="showroom article fulltext">
	<?php
		//Hierarchie anzeigen
		$this_category = get_the_category();
		echo '<h2 class="page_title_hierarchy">';
		echo get_category_parents($this_category[0]->cat_ID, true, ' &raquo; ');
		echo '</h2>';
		echo '<h2 class="page_title_author_date">';
		//Autor (sollte gegen Deaktivierung des Plugins abgesichert werden)
		coauthors_posts_links();
		echo ' | ';
		//Datum
		echo get_the_time('j. F Y');
		echo '</h2>';
		//Titel
		echo '<h1 class="article-title">';
		the_title();
		echo '</h1>';
	?>
	<div class="article-body">
		<?php 
			//der Comic (normalerweise nur Bilder)
			the_content(); 

			echo '<p class="navi">';
			//vorheriger Comic
			previous_post_link('<span class="prev_link">%link</span>', '<img src="'.get_bloginfo('template_directory').'/images/previous48px.png" alt=""/>', TRUE);
			//Galerie der Serie
			echo '<a href="'.get_category_link($this_category[0]->cat_ID).'" title="zur Galerie"><img src="'.get_bloginfo('template_directory').'/images/playlist48px.png" /></a>';
			//nächster Comic
			next_post_link('<span class="next_link">%link</span>', '<img src="'.get_bloginfo('template_directory').'/images/next48px.png" alt=""/>', TRUE);
			echo '</p>';
		?>
		<div class="interaction_box sharebuttons">
		<?php 
			//Social Media buttons
			//sollte gegen Deaktivierung der Plugins abgesichert werden

			//sfc_share_button(); 
			//echo '&nbsp;';
			stc_tweetbutton();

		//Kommentare
		comments_template( '', true ); ?>
		</div>
	</div>
</div>
<?php endwhile;

endif;
get_footer(); ?>