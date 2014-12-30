<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
<div id="container">
<div id="header">
	<a href="<?php echo home_url(); ?>"><div id="logo">&nbsp;</div></a>
	<div id="menubar">
		<ul id="menubar_toplevel">
			<?php //hier die Toplevel Categories in der gewünschten Reihenfolge aufzählen
				$tlcats = array(57,58,59,61,62);
				foreach ($tlcats as $cat){
					$exclude = array_diff($tlcats,array($cat));
					echo('<div id="menubar_color_'.$cat.'">');
					wp_list_categories('exclude='.implode(',',$exclude).'&title_li=');
					echo('</div>');
				}
			?>
			<?php wp_list_pages('title_li'); ?>
			<!-- Hier könnte eine Dropdownauswahl für monatliche Archive hin
				<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
				<option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
  				<?php wp_get_archives( 'type=monthly&format=option&show_post_count=1' ); ?>
			</select>-->
			<!-- und hier sollte noch ne Suchfunktion hin-->
		</ul>
	</div>
<!-- Menü und so -->


</div>
<div id="content">
<!-- end header -->
