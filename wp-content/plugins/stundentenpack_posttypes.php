add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'comic',
		array(
			'labels' => array(
				'name' => __( 'Comics' ),
				'singular_name' => __( 'Comic' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
}