<?php
function register_post_type_services() {

	$post_type_single = _x('Service', 'posttype single name global used', L10n);
	$post_type_plural = _x('Services', 'posttype plural name global used', L10n);

	$labels = array(
		'name' => $post_type_single,
		'singular_name' => $post_type_single,
		'add_new' => _x( 'Add New', 'Service', L10n ),
		'add_new_item' => sprintf( __( 'Add New %s', L10n ), $post_type_single ),
		'edit_item' => sprintf( __( 'Edit %s', L10n ), $post_type_single ),
		'new_item' => sprintf( __( 'New %s', L10n ), $post_type_single ),
		'all_items' => sprintf( __( 'All %s', L10n ), $post_type_plural ),
		'view_item' => sprintf( __( 'View %s', L10n ), $post_type_single ),
		'search_items' => sprintf( __( 'Search %s', L10n ), $post_type_plural ),
		'not_found' => sprintf( __( 'No %s found', L10n ), $post_type_plural ),
		'not_found_in_trash' => sprintf( __( 'No %s found in trash', L10n ), $post_type_plural ),
		'parent_item_colon' => '',
		'menu_name' => _x( 'Services', 'menu items', L10n ),
	);

	register_post_type( 'service', array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'with_front' => 'true', 'slug' => 'service' ),
		'supports' => array( 'title', 'editor', 'thumbnail' )
	)
	);
}
add_action( 'init', 'register_post_type_services' );

function meta_box_services() {
	if ( !file_exists( WP_CONTENT_DIR . '/mu-plugins' . '/meta-box-class/my-meta-box-class.php' ) )
		return;

	$prefix = 'ba_';

	require_once WP_CONTENT_DIR . '/mu-plugins' . '/meta-box-class/my-meta-box-class.php';

	$config_publicaties = array(
		'id' => 'services_meta_box',
		'title' => __( 'Additional data', L10n ),
		'pages' => array( 'service' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array( ),
		'local_images' => false,
		'use_with_theme' => WP_CONTENT_URL . '/mu-plugins/meta-box-class'
	);

	$my_meta_publicaties = new AT_Meta_Box( $config_publicaties );
	$my_meta_publicaties->addTextarea( $prefix . 'textarea_samenvatting', array( 'name' => __( 'Summary', L10n ) ) );
	$my_meta_publicaties->Finish();
}
add_action( 'admin_init', 'meta_box_services' );