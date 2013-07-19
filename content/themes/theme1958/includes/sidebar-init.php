<?php
function elegance_widgets_init() {
	// Left Header Area
	// Location: at the upper left corner of pages
	register_sidebar(array(
		'name'				=> 'Left Header Area',
		'id' 				=> 'left-header-area',
		'description'		=> __( 'Located at the upper left corner of pages.'),
		'before_widget'		=> '<div id="%1$s" class="widget-header">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
	// Right Header Area
	// Location: at the upper right corner of pages
	register_sidebar(array(
		'name'				=> 'Right Header Area',
		'id' 				=> 'right-header-area',
		'description'		=> __( 'Located at the upper right corner of pages.'),
		'before_widget'		=> '<div id="%1$s" class="widget-header">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
	// Header Widget
	// Location: right after logo
	register_sidebar(array(
		'name'				=> 'Header',
		'id' 				=> 'header-area',
		'description'		=> __( 'Located right after logo.'),
		'before_widget'		=> '<div id="%1$s" class="widget-header">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
	// 1st Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'				=> '1st Content Area',
		'id' 				=> 'content-area1',
		'description'		=> __( 'Located at the top of the content.'),
		'before_widget'		=> '<div id="%1$s">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
	// 2nd Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'				=> '2nd Content Area',
		'id' 				=> 'content-area2',
		'description'		=> __( 'Located at the top of the content.'),
		'before_widget'		=> '<div id="%1$s">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
	// 3d Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'				=> '3d Content Area',
		'id' 				=> 'content-area3',
		'description'		=> __( 'Located at the top of the content.'),
		'before_widget'		=> '<div id="%1$s">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'				=> 'Sidebar',
		'id' 				=> 'main-sidebar',
		'description'		=> __( 'Located at the right side of pages.'),
		'before_widget'		=> '<div id="%1$s" class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
	// Middle Footer Area
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'				=> 'Middle Footer Area',
		'id' 				=> 'middle-footer-area',
		'description'		=> __( 'Located right after copyright.'),
		'before_widget'		=> '<div id="%1$s">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
	// Right Footer Area
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'				=> 'Right Footer Area',
		'id' 				=> 'Right-footer-area',
		'description'		=> __( 'Located right after Middle Footer Area.'),
		'before_widget'		=> '<div id="%1$s">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after_title'		=> '</h2>',
	));
}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elegance_widgets_init' ); ?>