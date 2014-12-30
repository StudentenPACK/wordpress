<?php
/**
 * Theme Name: StudentenPACK
 * Theme URI: http://www.phibography.de/
 * Description: StudentenPACK Homepage
 * Author: Philipp Bohnenstengel
 * Author URI: http://www.phibography.de/
 * Version: 0.1 
 * Tags: 
 * 
 * License:
 * License URI:
 * 
 * General comments (optional).
 */
get_header(); ?>
<div id="frontpage_content_top">
	<div id="frontpage_news">
		<?php
		//exclude blog und so 
		query_posts( 'cat=-104&posts_per_page=9' );
		if (have_posts()) : ?>
			<?php $loopcounter = 0; ?>
			<?php while (have_posts()) : the_post(); $loopcounter++; ?>
				<?php if (($loopcounter == 1) and is_sticky() and has_post_thumbnail()) { ?>
					<div class="featured-post">
						<?php the_post_thumbnail('featured-post'); ?>
						<a href="<?php the_permalink();?>"><div class="featured-post_title contentarea">
							<h1><?php the_title(); ?></h1>
						</div></a>
						<p class="post_in_list_description contentarea smalltext"><a href="<?php the_permalink();?>">
						<?php
							$mykey_values = get_post_custom_values('Untertitel');
							if (!empty($mykey_values)){
  								foreach ( $mykey_values as $key => $value ) {
  									echo ($value); 
  								}
  							} else {
  								the_excerpt();
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
					$evenodd = $evenodd == 'even' ? 'odd' : 'even';
					include('postinlist.php'); 
				} ?>
			<?php endwhile; ?>
		<?php else: ?>


		<?php endif; ?>
		<?php rewind_posts(); ?>
	</div>
	<div id="frontpage_sidebar">
		<h2 class="smalltitle contentarea"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/blog16px.png" alt="blog"/> ';?> <a href="<?php echo(get_category_link(104));?>">In eigener Sache</a></h2>
		<div class="sidebar-section">
			<?php $myquery= new WP_Query('cat=104&posts_per_page=1'); ?>
			<?php if ($myquery->have_posts()) : ?>
				<?php while ($myquery->have_posts()) : $myquery->the_post(); ?>
					<h1 class="smallarticle_title"><?php the_title(); ?></h1>
					<?php echo '<div class="sidebar_avatar"><a href="'.get_permalink().'">';
					echo the_post_thumbnail('sidebar');
					echo '</a></div>'; ?>
					<div class="smallarticle_body fulltext">
					<?php the_content('&raquo; weiterlesen'); ?>
					</div>
				<?php endwhile; ?>

			<?php else: ?>

			<?php endif; ?>
			<?php rewind_posts();
			wp_reset_query(); ?>
		</div>
		<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/comments16px.png" alt="kommentar"/> ';?> Diese Woche Heiß & Fettig</h2>
		<div class="sidebar-section smalltext colorscheme_navi" id="sidebar-popularposts">
			<?php if (function_exists('wpp_get_mostpopular')) wpp_get_mostpopular("header=Meistgelesen&limit=5&range=weekly&order_by=views&stats_views=1&stats_comments=0");?>
			<?php if (function_exists('wpp_get_mostpopular')) wpp_get_mostpopular("header=Meistkommentiert&limit=5&range=weekly&order_by=comments&stats_comments=1&pages=0");?>
		</div>
		
		
		<div class="sidebar-section">
			<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/tag16px.png" alt="tag"/> ';?> Themen</h2>
			<p class="colorscheme_navi"><?php wp_tag_cloud('smallest=0.8&largest=2.0&unit=em'); ?></p>
		</div>
	</div>
</div>


<div id="frontpage_content_bottom">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('frontpage') ) {} ?>
</div>
<?php get_footer(); ?>