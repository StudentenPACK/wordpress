<?php
/**
 * Dieses Template stellt Suchergebnisse dar
 */
get_header(); ?>

<div class="box">
<?php if (have_posts()) : ?>
<div class="archive_list">
  <?php 
    //Suchbegriff als Seitentitel
    echo '<h1 class="page_title">Suchergebnis für "'.$_GET['s'].'"</h1>';

  while (have_posts()) : the_post();
  
    include('postinlist.php');

  endwhile; ?>
  
    <p class="interaction_box">
      <?php 
      //Suchergebnisse sind im Gegensatz zu den meisten anderen Dingen in Seiten unterteilt
      next_posts_link('weitere Suchergebnisse');
      previous_posts_link('vorherige Suchergebnisse'); ?>
    </p>
</div>
<div class="sidebar colorscheme_navi">
  <?php 
  //ähnlich wie Archive haben Suchergebnisse eine Sidebar mit Statistiken
  echo '<div class="sidebar-section">';
    echo '<h2 class="smalltitle">'.'<img src="'.get_bloginfo('template_directory').'/images/stats16px.png" alt="statistiken"/> '.' Statistik</h2>';
    echo '<p class="smalltext">';
        //Anzahl Ergebnisse
        echo $wp_query->found_posts.' Artikel';
    echo '</p>';
    
        //Zeitraum berechnen
        $parameters = ($wp_query->query_vars);
        $parameters['nopaging'] = true;
        $myquery= new WP_Query($parameters);
        $posts=$myquery->posts; 
        if((sizeof($posts)) > 1){
        echo '<p class="smalltext">';
        echo 'Zeitraum: '.get_the_time( 'j. F Y', ($posts[(sizeof($posts)) - 1]->ID)).' – '.get_the_time( 'j. F Y', ($posts[0]->ID));
        echo '</p>';   
        }
        //Autoren (sollte noch gegen deaktivierung des Coauthors Plugins abgesichert werden)
        foreach($posts as $p){
          $tmp = get_coauthors($p->ID);
        foreach ($tmp as $t){
            //eventuell könnte man statt einem Link zum Autorenarchiv irgendwie eine Filterfunktion für das aktuelle Archiv implementieren. Aber das ist irgendwie kompliziert.
            $authors[] = '<a href="'.get_author_posts_url($t->ID).'">'.$t->display_name.'</a>';
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
      wp_reset_postdata();
    echo '</div>';
      
  
  ?>
</div>
<?php else: ?>

<!-- olol, alles weg, gnihihi! -->

<?php endif; ?>
</div>
<?php get_footer(); ?>