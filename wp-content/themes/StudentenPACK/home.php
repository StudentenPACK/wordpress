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
		<?php if (have_posts()) : ?>
			<?php $loopcounter = 0; ?>
			<?php while (have_posts()) : the_post(); $loopcounter++; ?>
				<?php if (($loopcounter == 1) and is_sticky() and has_post_thumbnail()) { ?>
					<div class="featured-post">
						<?php the_post_thumbnail('featured-post'); ?>
						<a href="<?php the_permalink();?>"><div class="featured-post_title contentarea">
							<h1><?php the_title(); ?></h1>
						</div></a>
						<p class="post_in_list_description contentarea smalltext">
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
						</p>
						<p class="post_in_list_meta colorscheme_navi smalltext">
						<span class="colorsquare <?php echo(get_root_category(get_the_category())->slug); ?>">&nbsp;</span>
						<?php $datetime = get_the_date('j. F Y H:i'); ?>
						<span title="<?php echo "$datetime"; ?>">
							<?php echo TimeAgo(get_the_time('U')); ?>
						</span>
						in der Rubrik
						<?php the_category(', '); ?>. 
						<?php 
							$tagcount = count(get_the_tags());
							if ($tagcount == 1) {
								the_tags('Tag: ', ' &middot; ', '');
							} elseif ($tagcount > 1) {
								the_tags('Tags: ', ' &middot; ', '');
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
		<h2 class="smalltitle">In eigener Sache</h2>
		<div class="sidebar-section"><p class="smalltext colorscheme_navi devcomment">Hier könnte man als Redaktion Bloggen und/oder mit Editorals und der gleichen aktuelle Ausgaben preisen.</p></div>
		<h2 class="smalltitle">Wayne interessiert's</h2>
		<div class="sidebar-section"><p class="smalltext colorscheme_navi devcomment">Meistgelesene/-kommentierte Artikel und so, fehlt allerdings noch das passende Plugin für</p></div>
		
		<h2 class="smalltitle">Themen</h2>
		<div class="sidebar-section"><p class="colorscheme_navi"><?php wp_tag_cloud(); ?></p><p class="devcomment smalltext">das wird sicher beeindruckender aussehen, wenn es mehr Texte und mehr (und vor allem öfter benutzte) Tags gibt.</p></div>
		
		<!--<h2 class="smalltitle">Comic</h2>
			<?php query_posts('cat=27&posts_per_page=1'); ?>
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<div id="frontpage_comic"> 
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'sidebar' ); ?>
								</a>
							</div>
						<?php } else { ?>
							<div id="frontpage_comic">
								<img src="http://dummyimage.com/300x300/abcdef/fff.png&text=Meh" alt=""/>
							</div>
						<?php } ?>
					<?php endwhile; ?>

				<?php else: ?>
					<div id="frontpage_comic">
						<img src="http://dummyimage.com/300x300/abcdef/fff.png&text=Teaser%20f%C3%BCr%27n%20aktuellen%20Comic" alt=""/>
					</div>
				<?php endif; ?>
			<?php rewind_posts(); ?>
	</div>-->
</div>

<div id="frontpage_content_middle">
	<?php //hier alle Kategorien auflisten, die auf der Startseite sein sollen (alle Toplevel)
		$display_cats = array(57, 58, 59, 61, 62); 
		$catcounter = 0; ?>
	<?php foreach($display_cats as $cat) { 
		$catcounter++; ?>
		<div class="frontpage_category contentarea">
			<h2 class="smalltitle">
				<span class="colorsquare <?php echo(get_category($cat)->slug); ?>">&nbsp;</span>
				<a href="<?php echo(get_category_link($cat));?>"><?php echo(get_cat_name($cat)); ?></a>
			</h2>
			<?php query_posts('cat='.$cat.'&posts_per_page=5'); 
				$loopcounter = 0; ?>
			<?php if (have_posts()) : ?>

				<?php while (have_posts()) : the_post(); $loopcounter++; ?>
					<?php if ($loopcounter == 1) {
							if (has_post_thumbnail()) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('frontpage-category'); ?> </a>
							<?php } else { ?>
								<a href="<?php the_permalink(); ?>"><img src="http://dummyimage.com/324x100/abcdef/fff.png&text=<?php echo(get_category($cat)->slug); ?>" alt=""/></a>
							<?php }
						}?>
					<p class="smalltext post_smallinfo">
						<a href="<?php the_permalink(); ?>">
							<span class="post_smallinfo_category"><?php $tmp=get_the_category(); echo $tmp[0]->cat_name;?>:</span> 
							<?php the_title(); ?> 
						</a><br/>
						<span class="post_smallinfo_time"><?php echo TimeAgo(get_the_time('U')); ?></span>
					</p>

				<?php endwhile; ?>

			<?php else: ?>

			<?php endif; ?>
			<?php rewind_posts(); ?>
		</div>
		<?php if (($catcounter % 3) <> 0){ ?>
			<div class="frontpage_category_spacer">&nbsp;</div>
		<?php }
	} ?>
	<div id="frontpage_ad">
		<h2 class="smalltitle">Kommerz</h2>
		<img src="http://dummyimage.com/300x300/abcdef/fff.png&text=Werbung" alt=""/>
	</div>
</div>
<div id="frontpage_content_bottom">
	<div id="frontpage_calendar">
		<h2 class="smalltitle">Deadline</h2>
		<p class="smalltext devcomment">Termine und so, am besten von irgendwo einlesen (Google Calendar?)</p>
	</div>
	<div class="frontpage_category_spacer">&nbsp;</div>
	<div id="frontpage_kolumne">
		<h2 class="smalltitle">Gut Gesagt</h2>		
		<?php query_posts('cat=33&posts_per_page=1'); ?>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<h1 class="smallarticle_title"><?php the_title(); ?></h1>
				<div class="smallarticle_body contentarea"><?php the_content('&raquo; weiterlesen'); ?></div>
			<?php endwhile; ?>

		<?php else: ?>

		<?php endif; ?>
		<?php rewind_posts(); ?>
	</div>	
	<div class="frontpage_category_spacer">&nbsp;</div>
	<div id="frontpage_poster">
		<h2 class="smalltitle">Rückseite</h2>
		<!-- hier automatisch das Verzeitchnis http://studentenpack.phibography.de/propaganda/ auslesen -->
		<link rel="stylesheet" href="http://studentenpack.phibography.de/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
		<script src="http://studentenpack.phibography.de/nivo-slider/jquery.nivo.slider.pack.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(window).load(function() {
			    $('#slider').nivoSlider({directionNav:false, controlNav:false, keyboardNav:false, pauseTime:5000, effect:'fade'});
			});
		</script>
		<div id="slider">
			<img src="http://studentenpack.phibography.de/propaganda/bigband2011_01.png" alt=""/>
			<img src="http://studentenpack.phibography.de/propaganda/bts2011_01.png" alt=""/>
			<img src="http://studentenpack.phibography.de/propaganda/werkhof2010_02.png" alt=""/>
		</div>
	</div>
</div>
<?php get_footer(); ?>