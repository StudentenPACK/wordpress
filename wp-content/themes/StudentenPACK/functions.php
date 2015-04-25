<?php
/**
 * Diese Datei enthält eine Reihe von Funktionen, die Features des Themes umsetzen oder WordPress anpassen
 */

/**
 * eine Reihe von Größen für Artikelbilder festlegen
 */
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' );
  //existierendes Maß thumbnail umdefinieren
  set_post_thumbnail_size( 150, 100, true );
  //featured-post wird für die Titelstory auf der Startseite und für die Comicübersich verwendet
  add_image_size( 'featured-post', 636, 300, true ); 
  //Standardgröße für Listen
  add_image_size( 'std-post', 150, 100, true );
  //Kleine Heftcover für Sidebar und Heftarchiv. Man beachte das fehlende "true", es wird also nicht scharf zugeschnitten
  add_image_size( 'sidebar', 300, 300);
  //Symbolbilder für die auf der Startseite gelisteten Hauptkategorien
  add_image_size( 'frontpage-category', 324, 100, true );
  //Comicarchive benutzen diese Quadrate
  add_image_size( 'square', 211, 211, true );
}

/**
 * Anpassung der automatischen Excerptlänge. Excerpts werden in Listen verwendet, wenn es keine Zweittitel gibt
 */
add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {
	return 20; 
}

/**
 * Keine automatischen Absätze (<p>) in Excerpts
 */
remove_filter('the_excerpt', 'wpautop');

/**
 * Die untere Hälfte der Startseite ist mit Widgets im Dashboard gestaltbar und daher als sidebar definiert
 */
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name'=>'frontpage',
'before_widget' => '<div class="frontpage_column">',
'after_widget' => '</div>',
'before_title' => '<h2 class="smalltitle contentarea">',
'after_title' => '</h2>',
));

/**
 * ausgehend von einer gegebenen Kategorie die Hauptkategorie bestimmen. 
 */
function get_root_category($tmp)
{
	$tmproot = $tmp[0]->category_parent; 
	while ($tmproot != 0) {
		$tmp = get_category($tmproot);
		$tmproot = $tmp->category_parent;
	}
	return $tmp;
}

/**
 * Ausgabe von natürlichsprachlichen Zeitangaben
 * http://www.sajithmr.me/php-time-ago-calculation
 */
function TimeAgo($datefrom,$dateto=-1)
{	
	// Defaults and assume if 0 is passed in that
	// its an error rather than the epoch

	if($datefrom<=0) { return "A long time ago"; }
	if($dateto==-1) { 
		//Zeitzone und Sommerzeit-Sensitivität aktivieren
		date_default_timezone_set('Europe/Berlin'); 
		$dateto = date('U'); }

	// Calculate the difference in seconds betweeen
	// the two timestamps

	$difference = $dateto - $datefrom;

	// If difference is less than 60 seconds,
	// seconds is a good interval of choice

	if($difference < 60)
	{
		$interval = "s";
	}

	// If difference is between 60 seconds and
	// 60 minutes, minutes is a good interval
	elseif($difference >= 60 && $difference<60*60)
	{
		$interval = "n";
	}

	// If difference is between 1 hour and 24 hours
	// hours is a good interval
	elseif($difference >= 60*60 && $difference<60*60*24)
	{
		$interval = "h";
	}

	// If difference is between 1 day and 7 days
	// days is a good interval
	elseif($difference >= 60*60*24 && $difference<60*60*24*7)
	{
		$interval = "d";
	}

	// If difference is between 1 week and 30 days
	// weeks is a good interval
	elseif($difference >= 60*60*24*7 && $difference < 60*60*24*30)
	{
		$interval = "ww";
	}

	// If difference is between 30 days and 365 days
	// months is a good interval, again, the same thing
	// applies, if the 29th February happens to exist
	// between your 2 dates, the function will return
	// the 'incorrect' value for a day
	elseif($difference >= 60*60*24*30 && $difference < 60*60*24*365)
	{
		$interval = "m";
	}

	// If difference is greater than or equal to 365
	// days, return year. This will be incorrect if
	// for example, you call the function on the 28th April
	// 2008 passing in 29th April 2007. It will return
	// 1 year ago when in actual fact (yawn!) not quite
	// a year has gone by
	elseif($difference >= 60*60*24*365)
	{
		$interval = "y";
	}

	// Based on the interval, determine the
	// number of units between the two dates
	// From this point on, you would be hard
	// pushed telling the difference between
	// this function and DateDiff. If the $datediff
	// returned is 1, be sure to return the singular
	// of the unit, e.g. 'day' rather 'days'

	switch($interval)
	{
		case "m":
			$months_difference = floor($difference / 60 / 60 / 24 / 29);
			while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto)
			{
				$months_difference++;
			}
			$datediff = $months_difference;

	// We need this in here because it is possible
	// to have an 'm' interval and a months
	// difference of 12 because we are using 29 days
	// in a month

			if($datediff==12)
			{
				$datediff--;
			}
	
			$res = ($datediff==1) ? "vor einem Monat" : "vor $datediff Monaten";
			break;

		case "y":
			$datediff = floor($difference / 60 / 60 / 24 / 365);
			$res = ($datediff==1) ? "vor einem Jahr" : "vor $datediff Jahren";
			break;

		case "d":
			$datediff = floor($difference / 60 / 60 / 24);
			$res = ($datediff==1) ? "gestern" : "vor $datediff Tagen";
			break;
	
		case "ww":
			$datediff = floor($difference / 60 / 60 / 24 / 7);
			$res = ($datediff==1) ? "letzte Woche" : "vor $datediff Wochen";
			break;

		case "h":
			$datediff = floor($difference / 60 / 60);
			$res = ($datediff==1) ? "vor einer Stunde" : "vor $datediff Stunden";
			break;

		case "n":
			$datediff = floor($difference / 60);
			$res = ($datediff==1) ? "vor einer Minute" : "vor $datediff Minuten";
			break;

		case "s":
			$datediff = $difference;
			$res = ($datediff==1) ? "vor einer Sekunde" : "vor $datediff Sekunden";
			break;
	}
	return (($datediff > 0) ? $res : date('j. F Y H:i:s',$datefrom));
}

/**
 * aktuelle URL abfragen. (Hier hinschreiben, wofür das gebraucht wird, sobald ich das wieder rausfinde!)
 */
function curPageURL() {
 	$pageURL = 'http';
 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 	$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") {
 	 	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} else {
 	 	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 return $pageURL;
}

/**
 * Diese Funktion baut die Autorenkurzprofile auf der Redaktionsübersicht.
 * Parameter: BenutzerID, String für die Beschreibung, String für den Zeitraum
 */
function printAuthorProfile($id, $role, $date){
	//Datenbankabfragen zusammenbauen
	$parameters=array();
	//erstmal nur normale Artikel
	$parameters['post_type'] = array('post');
	//eines Autors
	$parameters['author'] = $id;
	//alle "auf einer Seite" (werden hier nicht angezeigt, nur gezählt)
	$parameters['nopaging'] = true;
	$myquery= new WP_Query($parameters);
    $posts=$myquery->posts;	
    //das gleiche noch mal für Comics
	$parameters['post_type'] = array('comic');    
	$myquery= new WP_Query($parameters);
	$comics=$myquery->posts;
	echo '<div class="gallery_element">';
	echo '<h2 class="smalltitle">';
	//voller Name
	echo get_the_author_meta('display_name', $id);
	//Email, wenn es eine StudentenPACK Adresse ist
	$email = get_the_author_meta('user_email',$id);
	if(preg_match('/@studentenpack.uni-luebeck.de/', $email)){
		echo '&nbsp;<a href="mailto:'.$email.'"><img src="'.get_bloginfo('template_directory').'/images/email16px.png" alt="email" /></a>';
	} else {
		//hier ist ein unsichtbares Dummy-Icon, damit sich die Textausrichtung nicht verschiebt, nur weil jemand keine Emailadresse hat...
		echo '<img src="'.get_bloginfo('template_directory').'/images/dummy16px.png" width="16px" height="16px" alt="" />';
	}
	echo '</h2>';
	echo '<p class="smalltext">'.$role.'</p>';
	echo '<p class="smalltext">'.$date.'</p>';
	if ((count($posts) == 0) && (count($comics) == 0)) {
		//Wer keinen Artikel hat, hat keinen Artikel
		echo '<p class="smalltext">'.get_the_author_meta('first_name', $id).' hat noch keinen Artikel geschrieben</p>';
	} else {
		//Anzahl Artikel und Comics ausgeben
		echo '<p class="smalltext">';
		echo '<a href="'.get_author_posts_url($id).'">';
		if (count($posts) > 0) {
			echo count($posts).' Artikel';
		}
		if ((count($posts) > 0) && (count($comics) > 0)){
			echo ' und ';
		}
		if (count($comics) > 0) {
			echo count($comics).' Comics';
		}
		echo' von '.get_the_author_meta('first_name', $id).'</a></p>';
	}
	echo '</div>';
}

/**
 * Ööhhh..kein Plan, das stand wahrscheinlich mal irgendwo im Supportforum zum Mediacredit Plugin, das sowieso total im Eimer ist...
 */
add_shortcode('caption', 'img_caption_shortcode_mediacredit');
function img_caption_shortcode_mediacredit($attr, $content = null) {
    // New-style shortcode with the caption inside the shortcode with the link and image tags.
    if ( ! isset( $attr['caption'] ) ) {
        if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
            $content = $matches[1];
            $attr['caption'] = trim( $matches[2] );
        }
    }

    // Allow plugins/themes to override the default caption template.
    $output = apply_filters('img_caption_shortcode', '', $attr, $content);
    if ( $output != '' )
        return $output;

    extract(shortcode_atts(array(
        'id'    => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) )
        return $content;

    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

    return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">'
    . do_shortcode( $content ) . '<p class="wp-caption-text">' . do_shortcode( $caption ) . '</p></div>'; 
}

/**
 * Suchergebnisse bekommen 20 Artikel auf eine Seite.
 */
add_filter('post_limits', 'postsperpage');
function postsperpage($limits) {
	if (is_search()) {
		global $wp_query;
		$wp_query->query_vars['posts_per_page'] = 20;
	}
	return $limits;
}

/**
 * standard query erweitern und so...
 * http://presscustomizr.com/snippet/three-techniques-to-alter-the-query-in-wordpress/
 */

function alter_query($query) {
	//gets the global query var object
	global $wp_query;

	if(!$query->is_page() && $query->is_main_query()) {
		//Comics einbeziehen
		$query-> set('post_type' ,array('comic','post'));
		if($query->is_home()) {
			//Die Kategorie Blog enthält Heftankündigungen etc und wird gesondert dargestellt
			$query-> set('cat',-104);
			//Diese Zahl modifizieren, falls was am Layout geändert wird und mehr oder weniger Platz ist
			$query-> set('posts_per_page',9);
		}
		//Archive sind Kategorieseiten, Autorenseiten etc. Dort alle Posts auf einer Seite anzeigen
		elseif (is_archive()) {
			$query-> set('nopaging', true);
			if(is_category('heftarchiv')) {
				//im Haupt-Heftarchiv nicht die Hefte in den Unterkategorien anzeigen
				$query->set('category__not_in', array(524, 896, 897, 898, 937, 948));
			}
		}


		//we remove the actions hooked on the '__after_loop' (post navigation)
		// remove_all_actions ( '__after_loop');
	}
}
add_action('pre_get_posts','alter_query');

/**
 * Irgendwas mit Kommentaren. Bestimmt wichtig... olol.
 */
function sidebar_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   		<div id="comment-<?php comment_ID(); ?>">
    		<div class="comment-author avatar">
        		<?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>
        	</div>
        	<div class="comment-body smalltext">
       		<p class="comment-text"><?php echo get_comment_author_link(); ?>: <?php echo get_comment_text() ?>
       			<?php if ($comment->comment_approved == '0') : ?>
           		<br />
         		<em><?php _e('Your comment is awaiting moderation.') ?></em>
      			<?php endif; ?>
       		</p>
      		<p class="comment-meta commentmetadata">
      			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?> 
      			| <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      		</p>
      		</div>
     	</div>
<?php
	//schließedes </li> wird automatisch ergänzt
}




?>
