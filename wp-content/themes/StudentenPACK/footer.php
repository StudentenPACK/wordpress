<?php
/**
 * Dieses Template muss auf allen Seiten am Fußende eingebunden werden.
 */
?>
<!-- begin footer -->
</div> <?php //das ist das ende von div id="content" ?>
<div class="box box_footer">
	<?php 
	/**
	 * Die Sitemap beinaltet vier Spalteb: Liste der Kategorien, Liste der Autoren, Liste der Monatsarchive, Liste der Sonderseiten
	 * Normalerweise ist nur ein großer Link zu sehen, die Listen werden per jQuery aufgeklappt
	 */
	?>
	<a name="sitemap">&nbsp;</a>
	<div id="sitemap_hidden">
		<h1><a href="#sitemap">Sitemap anzeigen</a></h1>
	</div>
	<div id="sitemap">
		<div id="sitemap_hide"><a href="#sitemap">&times;</a></div>
		<div class="sitemap-block colorscheme_navi">
			<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/category16px.png" alt="rubriken"/> ';?> Rubriken</h2>
			<ul class="smalltext">
				<?php wp_list_categories('show_count=true&title_li='); ?>
			</ul>
		</div>
		<div class="sitemap-block colorscheme_navi">
			<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/author16px.png" alt="autoren"/> ';?> Autoren</h2>
			<ul class="smalltext">
				<?php 
				//achtung, hier wird eine Funktion aus dem Coauthors Plugin verwendet. Eventuell sollte man das mal absichern gegen Deaktivierung des Plugins...
				coauthors_wp_list_authors('optioncount=true&number=null&title_li='); ?>
			</ul>
		</div>
		<div class="sitemap-block colorscheme_navi">
			<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/calendar16px.png" alt="monate"/> ';?> Monatsarchive</h2>
			<ul class="smalltext">
				<?php wp_get_archives('show_post_count=true&title_li='); ?>
			</ul>
		</div>
		<div class="sitemap-block colorscheme_navi">
			<h2 class="smalltitle"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/page16px.png" alt="seiten"/> ';?> Sonderseiten</h2>
			<ul class="smalltext">
				<?php wp_list_pages('title_li='); ?>
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		$('#sitemap').hide();
		$('#sitemap_hidden').click(function() {
			$('#sitemap_hidden').hide();
			$('#sitemap').slideDown(500);
		});
		$('#sitemap_hide').click(function() {
			$('#sitemap').slideUp(500);
			$('#sitemap_hidden').show();
		});
	</script>
</div>


<div id="footer">
<p class="smalltext colorscheme_navi"><a href="http://www.studentenpack.uni-luebeck.de/index.php/impressum/">Impressum</a> | <a href="http://www.studentenpack.uni-luebeck.de/index.php/kudos/">Kudos</a> | <?php wp_loginout(); ?> <?php wp_register(' | ', ''); ?></p>
</div>
<?php wp_footer(); ?>
</div><?php // das ist das Ende von div id="container" ?>
<a name="bottom"></a>
</body>
</html>