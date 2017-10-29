<?php
/**
 * Dieses Template wird für die Archive der alten Zeitungen verwendet. Zuordnung in der functions.php
 * Es basiert auf dem Template für das normale Heftarchiv mit ein paar Modifikationen.
 */
get_header(); ?>
<div class="box">
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


if (have_posts()) :
	if (is_category()){
		$this_category = get_category($cat);


		echo '<p class="interaction_box">';
		echo $this_category->name;
		echo '<br/>';
		foreach ($dates as $d){
			echo ' &middot; <a href="#'.$d.'">'.$d.'</a>';
		}
		echo ' &middot;';
		echo '<br/>';
		echo '<br/>';
		//links zu den anderen dingen, aber nur wenn das nicht die aktuelle Kategorie ist...
		echo ' &middot; ';
		if ($this_category->cat_ID != 898) {
			echo '<a href="'.get_category_link(898).'">Das Provisorium (1967 - 1968)</a>';
			echo ' &middot; ';
		}
		if ($this_category->cat_ID != 896) {
			echo '<a href="'.get_category_link(896).'">Der Springende Punkt (1975 – 1990)</a>';
			echo ' &middot; ';
		}
		if ($this_category->cat_ID != 897) {
			echo '<a href="'.get_category_link(897).'">Das Hörrohr (? - 1983)</a>';
			echo ' &middot; ';
		}
		if ($this_category->cat_ID != 524) {
			echo '<a href="'.get_category_link(524).'">Die Bauchpresse (1993 – 2002)</a>';
			echo ' &middot; ';
		}
		if ($this_category->cat_ID != 937) {
			echo '<a href="'.get_category_link(937).'">MUFtI (1998 – 2002)</a>';
			echo ' &middot; ';
		}
		if ($this_category->cat_ID != 1146) {
			echo '<a href="'.get_category_link(1146).'">Campus HL (2014 – 2016)</a>';
			echo ' &middot; ';
		}
		//pack immer, weil pack nie mit diesem template angezeigt wird...hoffentlich...
		echo '<br/>';
		echo '<a href="'.get_category_link(105).'">Das StudentenPACK (seit 2005)</a>';
		echo ' &middot; ';
		if ($this_category->cat_ID != 948) {
			echo ' &middot; ';
			echo '<a href="'.get_category_link(948).'">Weitere studentische Publikationen</a>';
			echo ' &middot; ';
		}
		echo '</p>';

		//Anzeige der Hierarchie
		if($this_category->category_parent != 0){
			echo '<h2 class="page_title_hierarchy">';
			echo get_category_parents($this_category->category_parent, true, ' &raquo; ').'<br/>';
			echo '</h2>';
		}
		//Anzeige der Zeitspanne
		echo '<h2 class="page_title_author_date">';
			$range= get_the_time( 'F Y', ($posts[(sizeof($posts)) - 1]->ID)).' – '.get_the_time( 'F Y', ($posts[0]->ID));
			echo $range;
		echo '</h2>'; 
	} ?>
	<h1 class="page_title"><?php echo $this_category->name; ?></h1>
	<div class="gallery">
		<?php //Anzeige des Beschreibungstexts ?>
		<p class="cat_description smalltext"><?php $this_category = get_category($cat); echo $this_category->description; ?></p>
		<?php while (have_posts()) : the_post(); ?>
			<div class="gallery_element">
				<?php 
				echo '<h2 class="smalltitle">'.get_the_time('F Y').': '.get_the_title().'</h2>';
				echo '<a href="'.get_permalink().'">';
				the_post_thumbnail('sidebar');
				echo '</a>';
				?>
			</div>
		<?php endwhile; ?>
	</div>
<?php else: ?>

<!-- olol, alles weg, gnihihi! -->

<?php endif; ?>
</div>

<?php get_footer(); ?>