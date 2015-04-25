<?php
/**
 * Dieses Template wird für das Heftarchiv verwendet. 
 * Auf ihm basieren neben dem Bauchpressearchiv auch die Templates für die einzelnen Comicserien und teilweise die Redaktionsseite.
 */
get_header(); ?>

<div class="box">
<?php if (have_posts()) : ?>
	<h1 class="page_title">Heftarchiv 
		<?php echo '<a href="'.get_category_feed_link(get_query_var('cat')).'"><img src="'.get_bloginfo('template_directory').'/images/rss.png" alt=""/></a>';
		?>
	</h1>
	<?php
		//Anzeige einer Jahresübersicht 
		$posts = $wp_query->posts;
		foreach ($posts as $p){
			$dates[] = get_the_time('Y', $p->ID);
		}
		$dates = array_unique($dates);
		asort($dates);
		echo '<p class="interaction_box">';
		echo 'Das StudentenPACK';
		echo '<br>';
		foreach ($dates as $d){
			echo ' &middot; <a href="#'.$d.'">'.$d.'</a>';
		}
		echo ' &middot;';
		echo '<br>';
		echo '<br>';
		echo '<a href="'.get_category_link(898).'">Das Provisorium (1967 - 1968)</a>';
		echo ' &middot ';
		echo '<a href="'.get_category_link(896).'">Der Springende Punkt (1975 – 1990)</a>';
		echo ' &middot ';
		echo '<a href="'.get_category_link(897).'">Das Hörrohr (? - 1983)</a>';
		echo ' &middot ';
		echo '<a href="'.get_category_link(524).'">Die Bauchpresse (1993 – 2002)</a>';
		echo ' &middot ';
		echo '<a href="'.get_category_link(937).'">MUFtI (1998 – 2002)</a>';
		echo '<br>';
		echo ' &middot ';
		echo '<a href="'.get_category_link(948).'">Weitere studentische Publikationen (1964 – 2014)</a>';
		echo ' &middot ';
		echo '</p>'; ?>
	<div class="gallery">
	<?php $year = 0; ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php 
			//Unterteilung in Jahrgänge
			if($year != get_the_time('Y')){
				echo '<h2 class="smallarticle_title"><a name="'.get_the_time('Y').'">'.get_the_time('Y').'</a></h2>';
				$year = get_the_time('Y');
			}
		
		?>
		<div class="gallery_element">
		<?php 
			echo '<h2 class="smalltitle">'.get_the_time('F').': '.get_the_title().'</h2>';
			echo '<a href="'.get_permalink().'">';
			the_post_thumbnail('sidebar');
			echo '</a>';
		?>
		</div>
	<?php endwhile; 

	//noch mal ein prominenter Hinweis auf unsere Vorgänger. Ergänzen, wenn der Springende Punkt online geht!
	?>
	<h2 class="smallarticle_title">Interesse an unseren Vorgängern?</h2>
	<div class="gallery_element"> 
		<h2 class="smalltitle">1967 – 1968: Das Provisorium</h2> 
		<a href="<?php echo get_category_link(898); ?>"><img src="/wordpress/wp-content/uploads/2014/07/provisorium1_1967_12_300.jpg"/></a> 
	</div> 
	<div class="gallery_element"> 
		<h2 class="smalltitle">1975 – 1990: Der Springende Punkt</h2> 
		<a href="<?php echo get_category_link(896); ?>"><img src="/wordpress/wp-content/uploads/2014/06/SpriPu06_1976_02_cover_211x300.png"/></a> 
	</div> 
	<div class="gallery_element"> 
		<h2 class="smalltitle">1983: Das Hörrohr</h2> 
		<a href="<?php echo get_category_link(897); ?>"><img src="/wordpress/wp-content/uploads/2014/06/hoerrohr_6_cover_211x300.png"/></a> 
	</div> 
	<div class="gallery_element">
		<h2 class="smalltitle">1993 – 2002: Die Bauchpresse</h2>
		<a href="<?php echo get_category_link(524); ?>"><img src="/wordpress/wp-content/uploads/2012/10/bp1-211x300.jpg"/></a>
	</div> 
	<div class="gallery_element"> 
		<h2 class="smalltitle">1998 – 2002: MUFtI</h2> 
		<a href="<?php echo get_category_link(937); ?>"><img src="/wordpress/wp-content/uploads/1967/12/Mufti-1998-02_300.jpg"/></a> 
	</div>
<?php else: ?>

<!-- olol, alles weg, gnihihi! -->
<?php endif; ?>
</div>

<?php get_footer(); ?>