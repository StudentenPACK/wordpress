<?php
/**
 * Dieses Template stellt die Startseite dar
 */
get_header(); ?>
<div id="frontpage_content_top">
	<div id="frontpage_news">
		<?php
		if (have_posts()) :
			$loopcounter = 0;
			while (have_posts()) : the_post(); $loopcounter++;
				//die Aktuelle Titelstory ist im CMS sticky und daher am Anfang der Liste
				//diser wird prominenter dargstellt
				if (($loopcounter == 1) and is_sticky() and has_post_thumbnail()) { ?>
					<div class="featured-post">
						<?php the_post_thumbnail('featured-post'); ?>
						<a href="<?php the_permalink();?>"><div class="featured-post_title contentarea">
							<h1><?php the_title(); ?></h1>
						</div></a>
						<p class="post_in_list_description contentarea smalltext"><a href="<?php the_permalink();?>">
						<?php
							//Zweittitel oder Excerpt ...edit: Lukas will das so.
							$mykey_values = get_post_custom_values('Untertitel');
							if(!empty($_GET["lang"]) && $_GET["lang"] != "de"){
								$mykey_values = get_post_custom_values('Untertitel_'+$_GET["lang"]);
			
								//a language has been chosen but does not exist, default to english
								if(empty($mykey_values)) {
									$mykey_values = get_post_custom_values('Untertitel_en');
				
									//and if it still is empty, german will do...
									if(empty($mykey_values)) {
										$mykey_values = get_post_custom_values('Untertitel');
									}
								}
							}

							if (!empty($mykey_values)){
  					 			foreach ( $mykey_values as $key => $value ) {
  					 				//echo ($value); 
									$valueslength = strlen($value);
									if($valueslength<90)
									{
										echo("<b>");
										echo ($value);
										echo("</b>");
										$remain = 100 - $valuelength;
										$subexcerp = substr(get_the_excerpt(), 0, $remain);
										echo($subexcerp);
									}
									else
									{
										echo ($value);
									}
  					 			}
  					 		} 
							else 
							{
  								echo(get_the_excerpt());
  							}
  						?>
						</a></p>
						<p class="post_in_list_meta colorscheme_navi smalltext">
						<span class="colorsquare <?php echo(get_root_category(get_the_category())->slug); ?>">&nbsp;</span>
						<?php $datetime = get_the_date('j. F Y H:i'); ?>
						<span title="<?php echo "$datetime"; ?>">
							<?php echo '<img src="'.get_bloginfo('template_directory').'/images/calendar16px.png" alt="kalender"/> '.TimeAgo(get_the_time('U')); ?>
						</span>
						<?php 
							echo '<img src="'.get_bloginfo('template_directory').'/images/category16px.png" alt="rubrik"/> ';
							the_category(', '); ?>
						<?php 
							if (has_tag()) {
								echo '<img src="'.get_bloginfo('template_directory').'/images/tag16px.png" alt="tag"/> ';
								$tagcount = count(get_the_tags());
								if ($tagcount == 1) {
									the_tags('Thema: ', ' &middot; ', '');
								} elseif ($tagcount > 1) {
									the_tags('Themen: ', ' &middot; ', '');
								}
							}
						?> 
						<?php 
							if (get_comments_number() > 0){
								echo '<img src="'.get_bloginfo('template_directory').'/images/comments16px.png" alt="kommentare"/> ';
								comments_number('','1 Kommentar','% Kommentare');
							}
						?>
						</p>					
					</div>
				<?php } else {
					//restliche Posts bekommen das normale Listentemplate
					//öh...irgendwann gabs mal bei Listenelementen abwechselnd verschiedene Hintergrundfarben oder sowas...
					//kann sein, dass das gar nicht mehr genutzt wird...
					$evenodd = $evenodd == 'even' ? 'odd' : 'even';
					//listen template
					include('postinlist.php'); 
				} ?>
			<?php endwhile; ?>
		<?php else: ?>


		<?php endif; ?>
		<?php 
		//an dieser Stelle wirklich wichtig: auf dem Rest der Seite werden Posts aus den Hauptkategorien dargestellt, 
		//da sollen die bereits oben angezeigten auch noch mal auftauchen
		rewind_posts(); ?>
	</div>
	<div id="frontpage_sidebar">
		<div class="sidebar-section">
			<?php 
				//Wenn bereits ein Erscheinungsdatum für die nächste Ausgabe feststeht und ein vorläufiger Post angelegt wurde,
				//wird hier das Datum angezeigt angezeigt
				//frage noch nicht erschienene Posts der Kategorie Heftarchiv ab
				$myquery = new WP_Query( array( 'post_status' => array( /*'pending', 'draft',*/ 'future' ), 'cat' => 105, 'orderby' => 'date' , 'order' => 'ASC') );
				$posts = $myquery->posts;
				echo '<h2 class="smalltitle fulltext">';
				if(count($posts)>0){
					//wenn was gefunden wurde, Datum des nächsten Post
					$nextissue = $posts[0];
					$date = $nextissue->post_date;
					$deadline = new DateTime($date);
					echo 'Neue Ausgabe: '.$deadline->format('j.n.Y').'  – ';
				} 
				rewind_posts();
				wp_reset_query();
				//Link zur Seite über Gastartikel
				echo '<a href="'.get_page_link(111926).'">Gastartikel einsenden</a>';
				echo '</h2>';
			?>
		</div>
		<h2 class="smalltitle contentarea"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/blog16px.png" alt="blog"/> ';?> <a href="<?php echo(get_category_link(104));?>">In eigener Sache</a></h2>
		<div class="sidebar-section">
			<?php 
			//zeige aktuellsten Post aus der Kategorie Blog (normalerweise Heftankündigung)
			$myquery= new WP_Query('cat=104&posts_per_page=1');
			if ($myquery->have_posts()) :
				while ($myquery->have_posts()) : $myquery->the_post(); ?>
					<h1 class="smallarticle_title"><?php the_title(); ?></h1>
					<?php echo '<div class="sidebar_avatar"><a href="'.get_permalink().'">';
					echo the_post_thumbnail('sidebar');
					echo '</a></div>'; ?>
					<div class="smallarticle_body fulltext">
					<?php 
					//es wird nur der erste Absatz angezeigt
					the_content('&raquo; weiterlesen'); ?>
					</div>
				<?php endwhile;

			else:

			endif;
			rewind_posts();
			wp_reset_query(); ?>
		</div>
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/comments16px.png" alt="kommentar"/> ';?> Diesen Monat Heiß &amp; Fettig</h2>
		<div class="sidebar-section smalltext colorscheme_navi" id="sidebar-popularposts">
			<?php 
				//echo do_shortcode( '[google_top_content pageviews=1 number=10 showhome=no time=2628000 timeval=1]' );
				//Liste der meistgelesenen Artikel im letzten Monat (Plugin: WordPress Popular Posts)
				if (function_exists('wpp_get_mostpopular')) wpp_get_mostpopular("header=Meistgelesen&limit=5&range=monthly&order_by=views&post_type=post,comic&stats_views=1&stats_comments=0");
				//Liste der meistkommentierten Artukel im letzten Monat (Plugin: WordPress Popular Posts)
				if (function_exists('wpp_get_mostpopular')) wpp_get_mostpopular("header=Meistkommentiert&limit=5&range=monthly&order_by=comments&post_type=post,comic&stats_comments=1&pages=0");
			?>
		</div>
		
		
		<div class="sidebar-section">
			<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/tag16px.png" alt="tag"/> ';?> Themen</h2>
			<p class="colorscheme_navi" style="text-align:center;">
				<?php
					//Tagcloud. Das hier sind nach langer Analyse etablierte Schriftgrößen. Ischschwör!
					wp_tag_cloud('smallest=8&largest=22&unit=pt');
				?>
			</p>
		</div>
	</div>
</div>


<div id="frontpage_content_bottom">
	<?php 
		//der Rest der Startseite ist mit Widgets umgesetzt.
		//bitte fragt nicht, warum das hier so komisch aussieht. Ich habe keinen Plan. Aber es funktioniert...
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('frontpage') ) {} 
	?>
</div>
<?php get_footer(); ?>
