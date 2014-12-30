<?php 
/*
Plugin Name: StudentenPACK Posttypes
Plugin URI: http://www.studentenpack.uni-luebeck.de/
Version: 1.0
Description: Posttypes für die StudentenPACK Homepage
Author: Philipp Bohnenstengel
Author URI: http://www.phibography.de/
*/

/**
 * Dieses Plugin legt individuelle zusätzliche Post Types für das WordPress CMS an.
 * Derzeit gibt es nur Comics
 */
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'comic',
		array(
			'labels' => array(
				'name' => __( 'Comics' ),
				'singular_name' => __( 'Comic' )
			),
		'public' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'comments','author'),
		'taxonomies' => array('category', 'post_tag')
		)
	);
	flush_rewrite_rules();
}
?>