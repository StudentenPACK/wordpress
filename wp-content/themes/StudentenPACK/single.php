<?php 
/**
 * Dieses ist das Standard-Template für Artikel
 */
get_header();
if (have_posts()) :

while (have_posts()) : the_post(); ?>

<div class="article fulltext">
	<?php
		//Zweittitel
		
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
		//Heftarchiv Posts haben Links zum Wechseln zwischen aufeinanderfolgenden Ausgaben
		$in_heftarchiv = in_category(array(105, 524));
		if($in_heftarchiv){
			echo "<p class=\"article-subtitle\">";
			previous_post_link("%link","&laquo;",true);
			echo "&nbsp;";
			if (!empty($mykey_values)){
  				foreach ( $mykey_values as $key => $value ) {
  					echo $value; 
  				}
  			}
 			echo "&nbsp;";
 			next_post_link("%link","&raquo;",true);
  			echo "</p>";
		} else {
			if (!empty($mykey_values)){
  				foreach ( $mykey_values as $key => $value ) {
  					echo "<p class=\"article-subtitle\">".$value."</p>"; 
  				}
  			}
		}
  	?>
	<h1 class="article-title"><?php 
	//Titel
	the_title(); ?></h1>

	<div class="article-body">
		<?php 
		//Inhalt
		the_content(); ?>
		<p class="interaction_box"><a href="#comments"><?php 
		//Link zur Kommentarfunktion
		comments_number('Noch keine Kommentare, sei der Erste!', 'Jemand hat die Diskussion eröffnet, mach mit!', 'Schon % Kommentare, hast auch du eine Meinung zu diesem Artikel?' );?></a></p>
	</div>
</div>

<div class="sidebar colorscheme_navi">
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/category16px.png" alt="rubrik"/> ';?> Rubrik</h2>
		<p class="smalltext"><?php 
		//Kategorie(n)
		the_category( ' | ', '', false ); ?> </p>
	</div>
	<?php 
	//Schlagwörter
	if (get_the_tags()): ?>
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/tag16px.png" alt="tag"/> ';?> Themen</h2>
		<p class="smalltext"><?php the_tags( '', ' &middot; ', '' ); ?> </p>
	</div>
	<?php endif; ?>
	<div class="sidebar-section">
		<h2 class="smalltitle">
			<?php 
				//Autor(en)
				echo '<img src="'.get_bloginfo('template_directory').'/images/author16px.png" alt="autor"/> ';
				$authors = new CoAuthorsIterator();
				print $authors->count() == 1 ? 'Der Autor' : 'Die Autoren';
			?>
		</h2>
		<ul class="smalltext authors">
			<?php 
				coauthors_posts_links('</li><li>','</li><li>','<li>','</li>'); 
			?>
		</ul>
	</div>
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/calendar16px.png" alt="kalender"/> '; ?>Datum</h2>
		<?php
			//Datum
			echo '<p class="smalltext">Erschienen am '.get_the_time('j. F Y H:i').'<br/>';
			//Monatsarchiv
			echo '<a href="'.get_month_link(get_the_time('Y'), get_the_time('n')).'">&raquo; zum Monats-Archiv</a></p>';
		?>
	</div>
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/author16px.png" alt="kalender"/> '; ?>Lizenz</h2>
		<?php
		$mykey_values = get_post_custom_values('Lizenz');
		if (empty($mykey_values)) :
			echo '<p class="smalltext">Copyright StudentenPACK '.get_the_time('Y').'.</p>';
		endif;
		if ($mykey_values[0] == 'ccbyncsa') :
			echo '<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons Lizenzvertrag" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>';
		endif;
		if($mykey_values[0] == 'ccbync') :
			echo '<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons Lizenzvertrag" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a>';
		endif;
		?>	
	</div>
	<?php 
		//ist dies ein reiner Onlineartikel (ansonsten war er in einem Heft)
		$mykey_values = get_post_custom_values('OnlineOnly');
		if (empty($mykey_values)) :
			
				$tmp = $wp_query;
				$in_heftarchiv = in_category(array(105, 524));
		
				$year = get_the_time('Y');
				$month = get_the_time('n');
				//Gesucht wird ein post, der nicht das Tag "wahlausgabe" (327) hat, im der Kategorie Heftarchiv (105) ist, und Jahr und Monat des angezeigten Archivs hat.
				$myquery= new WP_Query(array('tag__not_in' => array(327), 'cat' => 105, 'year' => $year, 'monthnum' => $month));
				if ($myquery->have_posts()) :
					while ($myquery->have_posts()) : $myquery->the_post();
						//anzeige der zugehörigen Ausgabe
						echo '<div class="sidebar-section">';
						echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/pdf16px.png" alt="pdf"/> '.'Ausgabe '.get_the_date('F Y').'</h2>';
						echo '<div class="sidebar_avatar">';
							if ($in_heftarchiv){
								//im Heftarchiv nur das Titelbild anzeigen
								$imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), '');
								echo '<a href="'.$imgsrc[0].'" rel="shadowbox">';
							} else {
								//sonst Link zur Ausgabe
								echo '<a href="'.get_permalink().'">';
							}
							echo the_post_thumbnail('sidebar');
						echo '</a>';
						echo '</div>';
						if (!($in_heftarchiv)){ //auf der Heftseite selbst muss da natürlich kein Link hin
							echo '<p class="smalltext"><a href="'.get_permalink().'">&raquo; zur Heftseite</a><br/>';
						}
						echo '</div>';
					endwhile;		
				else: 

				endif; 
  		wp_reset_postdata();
   		//loop wieder herstellen
		$wp_query = $tmp;
	endif; ?>

	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/share16px.png" alt="share"/> ';?>Mundpropaganda</h2>
		<!--<p class="smalltext"><a href="<?php trackback_url(); ?>">Trackback-URL</a></p>-->
		<p class="sharebuttons">
		<?php 
			//Social Media Buttons (gegen Deaktivierung der Plugins absichern)
			if(function_exists('get_twoclick_buttons')) {
				get_twoclick_buttons(get_the_ID());
			}
			//keeping the old code here just in case the new plugin sux.
			//sfc_share_button(); 
			//echo '&nbsp;';
			//stc_tweetbutton();
		?>
		</p>
	</div>
	<div class="sidebar-section">
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/comments16px.png" alt="kommentare"/> ';?>Diskussion <a name="comments">&nbsp;</a></h2>
		<?php 
		//Kommentare
		comments_template( '', true ); ?>
	</div>
</div>
<?php endwhile;

endif;

get_footer(); ?>
