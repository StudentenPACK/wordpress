<?php get_header(); ?>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div class="article contentarea">
	<?php
		$mykey_values = get_post_custom_values('Untertitel');
		if (!empty($mykey_values)){
  			foreach ( $mykey_values as $key => $value ) {
  				echo "<p class=\"article-subtitle\">".$value."</p>"; 
  			}
  		}
  	?>
	<h1 class="article-title"><?php the_title(); ?></h1>

	<div class="article-body"><?php the_content(); ?></div>
</div>

<div class="sidebar colorscheme_navi">
	<div class="sidebar-section">
		<h2 class="smalltitle">Rubrik</h2>
		<p class="smalltext"><?php the_category( ' &raquo; ', 'multiple', false ); ?> </p>
	</div>
	<?php if (get_the_tags()): ?>
	<div class="sidebar-section">
		<h2 class="smalltitle">Themen</h2>
		<p class="smalltext"><?php the_tags( '', ' &middot; ', '' ); ?> </p>
	</div>
	<?php endif; ?>
	<div class="sidebar-section">
		<h2 class="smalltitle">
			<?php 
				$authors = new CoAuthorsIterator();
				print $authors->count() == 1 ? 'Der Autor' : 'Die Autoren';
			?>
		</h2>
		<p class="smalltext"><?php coauthors_posts_links('<br/','<br/>','',''); ?></p>
	</div>
	<div class="sidebar-section">
		<h2 class="smalltitle">Erschienen</h2>
		<p class="smalltext"><?php echo get_the_date('F Y'); ?></p>
		<p class="smalltext devcomment">Hier könnte für Sachen, die auch gedruckt wurden, das jeweilige Titelbild angezeigt werden. 
		Und für Online erschienenes exaktes Datum und Uhrzeit</p>
	</div>
	<div class="sidebar-section">
		<h2 class="smalltitle">Weitersagen</h2>
		<p class="smalltext devcomment">Platz für Twitter, Facebook, Flattr Buttons</p>
	</div>
	<div class="sidebar-section">
		<?php comments_template( '', true ); ?>
	</div>
</div>
<?php endwhile; ?>

<?php endif; ?>
<?php get_footer(); ?>