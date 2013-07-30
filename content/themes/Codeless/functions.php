<?php
const L10n = 'codeless';
add_image_size( 'medium-overview', 214, 161, true);

function thema_js_css(){
	wp_enqueue_style( 'Google-Fonts', 'http://fonts.googleapis.com/css?family=Lato:100,200,300,400,700' );
	wp_enqueue_script( 'codeless-js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), $ver, true );
	wp_enqueue_style( 'codeless-style', get_stylesheet_directory_uri() . '/css-less/style.less', array( 'Google-Fonts' ) );
	
	wp_dequeue_script('flexslider');
}
add_action( 'wp_enqueue_scripts', 'thema_js_css', 100 );
add_action( 'wp_enqueue_scripts', 'thema_js_css', 1 );

class WP_Core_Disable
{
	public $disable_comments = false;
	public $disable_pages = false;
	public $disable_posts = false;
	public $hide_extra = false;

	public function __construct( array $disable ) {
		if ( isset($disable['disable_comments']) ) $this->disable_comments = $disable['disable_comments'];
		if ( isset($disable['disable_pages']) ) $this->disable_pages = $disable['disable_pages'];
		if ( isset($disable['disable_posts']) ) $this->disable_posts = $disable['disable_posts'];
		if ( isset($disable['hide_extra']) ) $this->hide_extra = $disable['hide_extra'];

		add_action( 'admin_menu', array( $this, 'remove_admin_menus' ) );
		add_action( 'init', array( $this, 'remove_comment_support' ), 100 );
		add_action( 'init', array( $this, 'remove_posttypes' ), 100 );
		add_action( 'wp_before_admin_bar_render', array( $this, 'remove_admin_bar' ) );
		add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ) );
		$this->remove_posttypes();
	}

	function remove_admin_menus() {
		if ($this->disable_comments) {
			remove_menu_page( 'edit-comments.php' );
			remove_submenu_page( 'options-general.php', 'options-discussion.php' );
		}
		if ($this->disable_pages) {
			remove_menu_page( 'edit.php?post_type=page' );
		}
		if ($this->disable_posts) {
			remove_menu_page( 'edit.php' );
		}
		if ($this->hide_extra) {
			remove_menu_page( 'tools.php' );
		}
	}

	function remove_comment_support() {
		if ($this->disable_comments) {
			remove_post_type_support( 'post', 'comments' );
			remove_post_type_support( 'page', 'comments' );
		}
	}
	function remove_posttypes() {
		global $wp_post_types;
		if ($this->disable_pages) {
			if ( isset( $wp_post_types[ 'page' ] ) ) {
				unset( $wp_post_types[ 'pages' ] );
			}
		}
		if ($this->disable_posts) {
			if ( isset( $wp_post_types[ 'post' ] ) ) {
				unset( $wp_post_types[ 'post' ] );
			}
		}
		if ( isset( $wp_post_types[ 'testi' ] ) ) {
			unset( $wp_post_types[ 'testi' ] );
		}
		if ( isset( $wp_post_types[ 'faq' ] ) ) {
			unset( $wp_post_types[ 'faq' ] );
		}
		if ( isset( $wp_post_types[ 'team' ] ) ) {
			unset( $wp_post_types[ 'team' ] );
		}
		if ( isset( $wp_post_types[ 'slider' ] ) ) {
			unset( $wp_post_types[ 'slider' ] );
		}
		if ( isset( $wp_post_types[ 'services' ] ) ) {
			unset( $wp_post_types[ 'services' ] );
		}
	}

	/**
	 *
	 * @global WP_Admin_Bar $wp_admin_bar
	 */
	function remove_admin_bar() {
		global $wp_admin_bar;

		if ($this->disable_comments) {
			$wp_admin_bar->remove_menu( 'comments' );
		}
		if ($this->disable_pages) {
			$wp_admin_bar->remove_menu( 'new-page' );
		}
		if ($this->disable_posts) {
			$wp_admin_bar->remove_menu( 'new-post' );
		}
	}

	function remove_dashboard_widgets() {
		if ($this->disable_comments) {
			remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		}
		if ($this->disable_posts ) {
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'normal' );
		}
	}
}
new WP_Core_Disable(array(
	'disable_comments' => true,
	'disable_pages' => false,
	'disable_posts' => false,
	'hide_extra' => true
));

require_once('functions/posttype.services.php');

function remove_some_widgets(){
	unregister_sidebar( 'middle-footer-area' );
	unregister_sidebar( 'Right-footer-area' );
	unregister_sidebar( 'left-header-area' );
	unregister_sidebar( 'right-header-area' );
	unregister_sidebar( 'header-area' );
	unregister_sidebar( 'content-area1' );
	unregister_sidebar( 'content-area2' );
	unregister_sidebar( 'content-area3' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );

register_sidebar( array(
	'name' => __('Home Right Sidebar', L10n),
	'id' => 'home-sidebar-right',
	'before_widget' => '<aside id="%1$s" class="%2$s widget">',
	'after_widget' => '</aside>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>'
));
register_sidebar( array(
	'name' => __('Footer', L10n),
	'id' => 'footer',
	'before_widget' => '<li id="%1$s" class="%2$s widget">',
	'after_widget' => '</li>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>'
));

add_post_type_support( 'page', 'excerpt' );

/* Make Menu */
function register_my_menu() {
  register_nav_menu('portfolio-menu',__( 'Portfolio Menu' ));
}
add_action( 'init', 'register_my_menu' );