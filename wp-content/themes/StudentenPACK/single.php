<?php get_header(); ?>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div class="article fulltext">
	<?php
		$mykey_values = get_post_custom_values('Untertitel');
		if (!empty($mykey_values)){
  			foreach ( $mykey_values as $key => $value ) {
  				echo "<p class=\"article-subtitle\">".$value."</p>"; 
  			}
  		}
  	?>
	<h1 class="article-title"><?php the_title(); ?></h1>

	<div class="article-body">
		<?php the_content(); ?>
		<p class="interaction_box"><a href="#comments"><?php comments_number('Noch keine Kommentare, sei der Erste!', 'Jemand hat die Diskussion eröffnet, mach mit!', 'Schon % Kommentare, hast auch du eine Meinung zu diesem Artikel?' );?></a></p>
	</div>
</div>

<div class="sidebar colorscheme_navi">
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/category16px.png" alt="rubrik"/> ';?> Rubrik</h2>
		<p class="smalltext"><?php the_category( ' | ', '', false ); ?> </p>
	</div>
	<?php if (get_the_tags()): ?>
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/tag16px.png" alt="tag"/> ';?> Themen</h2>
		<p class="smalltext"><?php the_tags( '', ' &middot; ', '' ); ?> </p>
	</div>
	<?php endif; ?>
	<div class="sidebar-section">
		<h2 class="smalltitle">
			<?php 
				echo '<img src="'.get_bloginfo('template_directory').'/images/author16px.png" alt="autor"/> ';
				$authors = new CoAuthorsIterator();
				print $authors->count() == 1 ? 'Der Autor' : 'Die Autoren';
			?>
		</h2>
		<p class="smalltext"><?php coauthors_posts_links('<br/>&raquo; ','<br/>&raquo; ','&raquo; ',''); ?></p>
	</div>
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/calendar16px.png" alt="kalender"/> '; ?>Datum</h2>
		<?php
			echo '<p class="smalltext">Erschienen am '.get_the_time('j. F Y H:i').'<br/>';
			echo '<a href="'.get_month_link().'">&raquo; zum Monats-Archiv</a></p>';
		?>
	</div>
	<?php 
		$mykey_values = get_post_custom_values('OnlineOnly');
		if (empty($mykey_values)) :
	?>
			
			<?php
				$tmp = $wp_query;
				$in_heftarchiv = in_category('105');
		
				$year = get_the_time('Y');
				$month = get_the_time('n');
				//105 = Heftarchiv
				$myquery= new WP_Query('cat=105&year='.$year.'&monthnum='.$month.'&order=DESC&posts_per_page=1');
				if ($myquery->have_posts()) :
					while ($myquery->have_posts()) : $myquery->the_post();
						echo '<div class="sidebar-section">';
						echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/pdf16px.png" alt="pdf"/> '.'Ausgabe '.get_the_date('F Y').'</h2>';
						echo '<div class="sidebar_avatar">';
							if ($in_heftarchiv){
								$imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), '');
								echo '<a href="'.$imgsrc[0].'" rel="shadowbox">';
							} else {
								echo '<a href="'.get_permalink().'">';
							}
							echo the_post_thumbnail('sidebar');
						echo '</a></div>';
						if (!($in_heftarchiv)){ //auf der Heftseite selbst, muss da natürlich kein Link hin
							echo '<p class="smalltext"><a href="'.get_permalink().'">&raquo; zur Heftseite</a><br/>';
						}
						echo '</div>';
					endwhile;		
				else: 

				endif; 
  		wp_reset_postdata();
   		//loop wieder herstellen
		$wp_query = $tmp;
		?>
	<?php endif; ?>
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/share16px.png" alt="share"/> ';?>Mundpropaganda</h2>
		<!--<p class="smalltext"><a href="<?php trackback_url(); ?>">Trackback-URL</a></p>-->
		<p class="sharebuttons">
		<?php 
			sfc_share_button(); 
			echo '&nbsp;';
			stc_tweetbutton();
		?>
		</p>
	</div>
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/comments16px.png" alt="kommentare"/> ';?>Diskussion <a name="comments">&nbsp;</a></h2>
		<?php comments_template( '', true ); ?>
	</div>
</div>
<?php endwhile; ?>

<?php endif; ?>
<?php get_footer(); ?>