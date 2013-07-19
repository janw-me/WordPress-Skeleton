<?php
add_image_size( 'medium-overview', 214, 161, true );

function thema_js_css(){
	wp_enqueue_style( 'Google-Fonts', 'http://fonts.googleapis.com/css?family=Lato:100,200,300,400,700' );
	wp_enqueue_script( 'codeless-js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
	wp_enqueue_style( 'codeless-style', get_stylesheet_directory_uri() . '/css-less/style.less', array( 'Google-Fonts' ) );
}
add_action( 'wp_enqueue_scripts', 'thema_js_css' );

