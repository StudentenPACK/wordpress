<?php
/**
 * Dieses Template muss auf allen Seiten am Kopfende eingebunden werden.
 * HTML head und Stuff...
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>

	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/vnd.microsoft.icon" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); 
	//Zeitzone und Sommerzeit-Sensitivität aktivieren
	date_default_timezone_set('Europe/Berlin');
	//JQuery, eventuell mal neuere Version benutzen. Aber ist eigentlich auch mal egal, so wenig wie davon benutzt wird ?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
<div id="container">
<div id="header">
	<a href="<?php echo home_url(); ?>"><div id="logo">&nbsp;</div></a>
	<div id="header_icons" class="colorscheme_navi">
		<?php //Die Social Media Icons oben rechts ?>
		<p>
			<a href="http://twitter.com/StudentenPack" target="_blank" title="Folge dem StudentenPACK auf Twitter">
				<img src="<?php bloginfo('template_directory'); ?>/images/twitter24px.png" alt="twitter"/>
			</a>
			<a href="http://www.facebook.com/StudentenPACK" target="_blank" title="Werde auf Facebook unser Fan">
				<img src="<?php bloginfo('template_directory'); ?>/images/facebook24px.png" alt="facebook"/>
			</a>
			<a href="http://www.flickr.com/photos/studentenpack" target="_blank" title="Besuche unsere Fotoarchive auf Flickr">
				<img src="<?php bloginfo('template_directory'); ?>/images/flickr24px.png" alt="flickr"/>
			</a>
			<a href="http://www.youtube.com/user/StudentenPackHL" target="_blank" title="Schau dir auf YouTube Videos des StudentenPACKs an">
				<img src="<?php bloginfo('template_directory'); ?>/images/youtube24px.png" alt="youtube"/>
			</a>
		</p>
		<?php //Die Links oben rechts (höhö, links rechts, höhö) ?>
		<p>
			<a href="<?php bloginfo('rss2_url'); ?>" title="Abonniere unsere Artikel">
				Abonnieren <img src="<?php bloginfo('template_directory'); ?>/images/rss24px.png" alt="rss"/>
			</a>
		</p>
		<p>
			<a href="/index.php/deadline/" title="Deadline: Der Terminkalender">
				Deadline <img src="<?php bloginfo('template_directory'); ?>/images/calendar24px.png" alt="calendar"/>
			</a>
		</p>		
		<p>
			<a href="/index.php/category/blog/heftarchiv/" title="Alte Ausgaben als PDF herunterladen">
				Heftarchiv <img src="<?php bloginfo('template_directory'); ?>/images/pdf24px.png" alt="archiv"/>
			</a>
		</p>
		<p>
			<a href="/index.php/die-redaktion/" title="Wer macht eigentlich diese Zeitung?">
				Redaktion <img src="<?php bloginfo('template_directory'); ?>/images/author24px.png" alt="team"/>
			</a>
		</p>		
	</div>
	<div id="menubar">
		<ul id="menubar_toplevel">
			<?php
				//das hier ist die Menüleiste 
				//hier die Toplevel Categories in der gewünschten Reihenfolge aufzählen
				$tlcats = array(5,3,8,11,12,10);
				foreach ($tlcats as $cat){
					//Unterkategorien laden
					$children = get_categories('child_of='.$cat);
					$include = array($cat);
					foreach($children as $c){
						array_push($include, $c->cat_ID);
					}
					echo('<div class="menubar_color '.get_category($cat)->slug.'">');
					wp_list_categories('include='.implode(',',$include).'&title_li=');
					echo('</div>');
				}
			?>
			<div><li id="search"><?php get_search_form(); ?></li></div>
		</ul>
	</div>
</div>
<div id="content">
<!-- end header -->