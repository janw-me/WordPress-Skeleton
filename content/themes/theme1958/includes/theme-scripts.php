<?php
/*	Register and load javascript
/*-----------------------------------------------------------------------------------*/
function my_script() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_bloginfo('template_url').'/js/jquery-1.7.2.min.js', false, '1.7.2');
		wp_enqueue_script('jquery');
	
		wp_enqueue_script('modernizr', get_bloginfo('template_url').'/js/modernizr.js', array('jquery'), '2.0.6');
		wp_enqueue_script('superfish', get_bloginfo('template_url').'/js/superfish.js', array('jquery'), '1.4.8');
		wp_enqueue_script('easing', get_bloginfo('template_url').'/js/jquery.easing.1.3.js', array('jquery'), '1.3');
		wp_enqueue_script('prettyPhoto', get_bloginfo('template_url').'/js/jquery.prettyPhoto.js', array('jquery'), '3.1.3');
		wp_enqueue_script('flexslider', get_bloginfo('template_url').'/js/jquery.flexslider.js', array('jquery'), '1.8');
		wp_enqueue_script('tools', get_bloginfo('template_url').'/js/jquery.tools.min.js', array('jquery'), '1.2.6');
		wp_enqueue_script('mobilemenu', get_bloginfo('template_url').'/js/jquery.mobilemenu.js', array('jquery'), '1.0');
		wp_enqueue_script('elastislide', get_bloginfo('template_url').'/js/jquery.elastislide.js', array('jquery'), '1.0');
		wp_enqueue_script('loader', get_bloginfo('template_url').'/js/jquery.loader.js', array('jquery'), '1.0');
		wp_enqueue_script('swfobject', get_bloginfo('url').'/wp-includes/js/swfobject.js', array('jquery'), '2.2');
		wp_enqueue_script('slides', get_bloginfo('template_url').'/js/slides.jquery.js', array('jquery'), '1.1.9');
		wp_enqueue_script('twitter', get_bloginfo('template_url').'/js/jquery.twitter.js', array('jquery'), '1.0');
		wp_enqueue_script('flickr', get_bloginfo('template_url').'/js/jquery.flickrush.js', array('jquery'), '1.0');
		wp_enqueue_script('touch', get_bloginfo('template_url').'/js/touchTouch.jquery.js', array('jquery'), '1.0');
		wp_enqueue_script('si_files', get_bloginfo('template_url').'/js/si.files.js', array('jquery'), '1.0');
		wp_enqueue_script('audiojs', get_bloginfo('template_url').'/js/audiojs/audio.js', array('jquery'), '1.0');
		wp_enqueue_script('custom', get_bloginfo('template_url').'/js/custom.js', array('jquery'), '1.0');
		wp_enqueue_script('touchscreen', get_bloginfo('template_url').'/js/jquery.touchscreen.js', array('jquery'), '1.0');
	}
}
add_action('init', 'my_script');


/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

function tz_admin_js($hook) {
	if ($hook == 'post.php' || $hook == 'post-new.php') {
		wp_register_script('tz-admin', get_template_directory_uri() . '/js/jquery.custom.admin.js', 'jquery');
		wp_enqueue_script('tz-admin');
	}
}
add_action('admin_enqueue_scripts','tz_admin_js',10,1);
?>