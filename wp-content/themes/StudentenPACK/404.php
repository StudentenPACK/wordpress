<?php get_header(); ?>
<div class="full_width_div descriptiontext">Sorry, die angeforderte Seite existiert nicht mehr, vielleicht hat sie auch nie existiert. Aber, bevor du traurig von dannen ziehst – schau doch mal, ob du nicht doch noch was bei uns findest, was dich interessiert:</div>

<div class="sitemap-block colorscheme_navi">
	<h2 class="smalltitle">Rubriken</h2>
	<ul class="smalltext">
		<?php wp_list_categories('title_li='); ?>
	</ul>
</div>
<div class="sitemap-block colorscheme_navi">
	<h2 class="smalltitle">Autoren</h2>
	<ul class="smalltext">
		<?php wp_list_authors('title_li='); ?>
	</ul>
</div>
<div class="sitemap-block colorscheme_navi">
	<h2 class="smalltitle">Monatsarchive</h2>
	<ul class="smalltext">
		<?php wp_get_archives('title_li='); ?>
	</ul>
</div>
<div class="sitemap-block colorscheme_navi">
	<h2 class="smalltitle">Sonderseiten</h2>
	<ul class="smalltext">
		<?php wp_list_pages('title_li='); ?>
	</ul>
</div>
<?php get_footer(); ?>