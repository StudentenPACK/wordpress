<?php
/**
 * Dieses Template wird standardmäßig geladen, wenn ein Archiv angezeigt wird. Das betrifft Kategorien, Tags, Zeiträume, Autoren.
 */
get_header(); ?>

<div class="box">
<?php 
if (have_posts()) : ?>
<div class="archive_list">
	<?php 
	//Verschiedene Überschriften für verschiedene Archivtypen. Bei Kategorien und Autoren RSS Link anzeigen
	if (is_category()){
		echo '<h1 class="page_title">';
		single_cat_title('Rubrik: ', true);
		echo '<a href="'.get_category_feed_link(get_query_var('cat')).'" title="Abonniere diese Rubrik"><img src="'.get_bloginfo('template_directory').'/images/rss.png" alt=""/></a>';
		echo '</h1>';
	} elseif (is_tag()){
		echo '<h1 class="page_title">';
		single_tag_title('Thema: ', true);
		echo '</h1>';
	} elseif (is_author()){
		echo '<h1 class="page_title">Artikel von ';
		the_author_meta('display_name', get_query_var('author'));
		echo '<a href="'.get_author_feed_link(get_query_var('author')).'" title="Abonniere diesen Autoren"><img src="'.get_bloginfo('template_directory').'/images/rss.png" alt=""/></a>';
		echo '</h1>';
	} elseif (is_month()){
		echo '<h1 class="page_title">Archiv: ';
		the_time('F Y');
		echo '</h1>';
	} elseif (is_year()){
		echo '<h1 class="page_title">Archiv: ';
		the_time('Y');
		echo '</h1>';
	} elseif (is_day()){
		echo '<h1 class="page_title">Archiv: ';
		the_time('jS F Y');
		echo '</h1>';
	} else {
		echo '<h1 class="page_title">Archiv</h1>';
	}	
	?>
	<?php 
	//hier werden die posts aufgelistet
	while (have_posts()) : the_post(); ?>
	
		<?php include('postinlist.php'); ?>

	<?php endwhile; ?>
</div>
<div class="sidebar colorscheme_navi">
	<?php 
	//Verschiedene Archivtypen bekommen verschiedene Zusatzinfos zur Anzeige in der Sidebar
	if(is_category){
		$this_category = get_category($cat);
		//Kategorien zeigen eine Beschreibung (falls vorhanden) an
		if($this_category->description != ""){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/description16px.png" alt="beschreibung"/> '.' Beschreibung</h2>';
			echo '<p class="smalltext">';
			echo $this_category->description;
			echo '</p>';
			echo '</div>';
		}
		//Kategorien zeigen ihren Platz in der Kategorienhierarchie an, sofern sie keine Hauptkategorie sind
		if($this_category->category_parent != 0){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/category16px.png" alt="hierarchie"/> '.' Hierarchie</h2>';
			echo '<p class="smalltext">';
			echo get_category_parents($this_category->category_parent, true, ' &raquo; ').$this_category->cat_name;
			echo '</p>';
			echo '</div>';
		}
		//Kategorien zeigen Unterkategorien an, falls vorhanden
  		if (get_category_children($this_category->cat_ID) != "") {
    		echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/subcategory16px.png" alt="unterrubriken"/> '.' Unter-Rubriken</h2>';
			echo '<ul class="sidebar_list_categories smalltext">';
    		wp_list_categories('orderby=id&show_count=0&title_li=&child_of='.$this_category->cat_ID);
    		echo '</ul>';	
			echo '</div>';
    	}	
    	
	}
	if (is_author()){
		//Autoren zeigen einen Beschreibungstext an (falls vorhanden)
		if (get_the_author_meta('description', get_query_var('author')) != ""){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/author16px.png" alt="autor"/> '.' Bio</h2>';
			//echo '<div class="sidebar_avatar">'.get_avatar(get_query_var('author'),150).'</div>';
			echo '<p class="smalltext">';
			echo get_the_author_meta('description', get_query_var('author'));
			echo '</p>';
			
		}
		//Autoren, die eine StudentenPACK-Emailadresse haben, zeigen diese an
		if (preg_match('/@studentenpack.uni-luebeck.de/', get_the_author_meta('user_email', get_query_var('author')))){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/email16px.png" alt="email"/> '.' Kontakt</h2>';
			echo '<p class="smalltext">';
			echo '<a href="mailto:'.get_the_author_meta('user_email', get_query_var('author')).'">'.get_the_author_meta('user_email', get_query_var('author')).'</a>';
			echo '</p>';	
			echo '</div>';
		}
		//Autoren, die eine eigene Homepage angegeben haben, zeigen diese an
		if (get_the_author_meta('user_url', get_query_var('author')) != ""){
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/www16px.png" alt="homepage"/> '.' Homepage</h2>';
			echo '<p class="smalltext">';
			echo '<a href="'.get_the_author_meta('user_url', get_query_var('author')).'">'.get_the_author_meta('user_url', get_query_var('author')).'</a>';
			echo '</p>';			
			echo '</div>';
		}
	}
	if(is_month()){
		//Monate zeigen die zugehörige Ausgabe an
		$year = get_the_time('Y');
		$month = get_the_time('n');
		//Gesucht wird ein post, der nicht das Tag "wahlausgabe" (327) hat, im der Kategorie Heftarchiv (105) ist, und Jahr und Monat des angezeigten Archivs hat.
		$myquery= new WP_Query(array('tag__not_in' => array(327), 'cat' => 105, 'year' => $year, 'monthnum' => $month));
		if ($myquery->have_posts()) :
			echo '<div class="sidebar-section">';
			echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/pdf16px.png" alt="pdf"/> '.' Das Heft</h2>';
			while ($myquery->have_posts()) : $myquery->the_post();
				echo '<div class="sidebar_avatar"><a href="'.get_permalink().'">';
				echo the_post_thumbnail('sidebar');
				echo '</a></div>';
				echo '<p class="smalltext"><a href="'.get_permalink().'">zur Heftseite</a></p>';
			endwhile;		
			echo '</div>';
		else: 

		endif; 
		//nach dieser zusätzlichen Datenbankabfrage soll alles wieder wie vorher sein
		wp_reset_postdata();
	}
	echo '<div class="sidebar-section">';
		//Alle Archive zeigen ein paar allgemeine Statistiken an
       	$posts=$wp_query->posts;	
		echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/stats16px.png" alt="statistik"/> '.' Statistik</h2>';
		//Anzahl der Artikel in diesem Archiv
		echo '<p class="smalltext">';
    		echo sizeof($posts).' Artikel';
    	echo '</p>';
    	//Zeitraum der Artikel (außer es ist ein Monatsarchiv)
       	if((!is_month()) && (sizeof($posts)) > 1){
    		echo '<p class="smalltext">';
    		echo 'Zeitraum: '.get_the_time( 'j. F Y', ($posts[(sizeof($posts)) - 1]->ID)).' – '.get_the_time( 'j. F Y', ($posts[0]->ID));
	    	echo '</p>';   
       	}
       	//Liste der in diesem Archiv vertretenen Autoren (außer es ist ein Autorenarchiv)
       	if(!is_author()){
       		foreach($posts as $p){
       			//sollte noch gegen Deaktivierung des Coauthors Plugins abgesichert werden
       			$tmp = get_coauthors($p->ID);
       			foreach ($tmp as $t){
       				//1 ist der Admin Account "StudentenPACK"
       				if ($t->ID != 1){
       					//eventuell könnte man statt einem Link zum Autorenarchiv irgendwie eine Filterfunktion für das aktuelle Archiv implementieren. Aber das ist irgendwie kompliziert.
       					$authors[] = '<a href="'.get_author_posts_url($t->ID).'">'.$t->display_name.'</a>';
       				}
       			}
       		}
       		$authors = array_unique($authors);
   			asort($authors);
   			if (count($authors) > 0){
   				echo '<p class="smalltext">'.(count($authors) > 1 ? count($authors).' Autoren' : '1 Autor').':';
   				echo '<ul class="sidebar_list_categories smalltext">';
   				foreach($authors as $a){
   					echo '<li>'.$a.'</li>';
   				}
    			echo '</li></p>'; 
   			}
       	}
       	//nach dieser zusätzlichen Datenbankabfrage soll alles wieder wie vorher sein
    	wp_reset_postdata();
    echo '</div>';
    	
	
	?>
</div>
<?php 
else: ?>

<!-- olol, alles weg, gnihihi! -->

<?php endif; ?>
</div>

<?php get_footer(); ?>