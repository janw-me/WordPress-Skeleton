<?php
/*
Plugin Name: Lightview Plus
Plugin URI: http://www.puzich.com/wordpress-plugins/lightview
Description: Seamless integration of Lightview (similar to Lightbox) to create a nice overlay to display images and videos without the need to change html. It allows youtube, vimeo and blip.tv videos to be shown in the overlay. Because Lightview by <a href="http://projects.nickstakenburg.com/lightview">Nick Stakenburg</a> isn't licensed under the terms of gpl, it isn't included. Read the installation instructions on <a href="http://www.puzich.com/wordpress-plugins/lightview-en">the plugin website</a>.
Author: Puzich
Author URI: http://www.puzich.com
Version: 3.1.3
Put in /wp-content/plugins/ of your Wordpress installation
*/

if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

global $wp_version;
define('LVPISWP30', version_compare($wp_version, '3.0', '>='));
define('LVPISWP31', version_compare($wp_version, '3.1', '>='));
define('LVPISWP32', version_compare($wp_version, '3.2', '>='));
define('LVPISWP33', version_compare($wp_version, '3.3', '>='));

require_once(dirname(__FILE__) . '/libs/core.php');

class lightview_plus extends plus_core {
	
	// core object
	var $core;
	
	// version
	var $version;
	
	// plugin name
	var $pluginname = 'Lightview Plus';

	// Nag Check Url
	var $chk_url = 'http://chk.puzich.com/';
	
	// backup dir and file
	var $bkp_folder_name = '.lightview.bkp';
	
	// lightview js files
	var $js_files = array('/js', '/js/lightview/lightview.js', '/js/excanvas/excanvas.js', '/css', '/css/lightview/lightview.css');
	
	var $adminPanel;
	
	
	// be compatible to php4
	function lightview_plus() {
		$this->__construct();
	} 
	
	
	function __construct() {

		// install default options
		register_activation_hook(__FILE__, array(&$this, 'install'));
		
		// update options (exists since wp 3.1)
		if(function_exists('register_update_hook')) {
			register_update_hook(__FILE__, array(&$this, 'install'));
		}

		// uninstall features
		register_deactivation_hook(__FILE__, array(&$this, 'uninstall'));
				
		//load language
		if (function_exists('load_plugin_textdomain'))
			load_plugin_textdomain( $this->_get_plugin_name(), false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
			
		// set video targets
		$this->videotargets();
		
		// set version
		$this->version = $this->get_version();
		
		// more setup links
		add_filter('plugin_row_meta', array(&$this, 'register_plugin_links'), 10, 2);
		
		// nagscreen at plugins page
		add_action('after_plugin_row', array(&$this, 'plugin_version_nag'));
		
		// show notice if JS files are not in place
		add_action('admin_notices', array(&$this, 'jsFail'));
			
		// add wp-filter
		add_filter('the_content', array(&$this, 'change_content'), 150);
		
		// add wp-action
		// use wp_enqueue_scripts from WP2.8 and above
		add_action('wp_enqueue_scripts', array(&$this, 'enqueueJS'));
		add_action('wp_enqueue_scripts', array(&$this, 'enqueueCSS'));
		/*if (function_exists('wp_enqueue_scripts')) {
			add_action('wp_enqueue_scripts', array(&$this, 'enqueueJS'));
			add_action('wp_enqueue_scripts', array(&$this, 'enqueueCSS'));
		} else {
			//add_action('wp_head', array(&$this, 'add_header'));
		}*/
		
		// update default settings
		add_action('admin_init', array(&$this, 'init'));
		
		// add settings menu
		//add_action('admin_init', array(&$this, 'AdminHeader'));
		add_action('admin_menu', array(&$this, 'AdminMenu'));
		
		//add wp-shortcodes
		if($this->get_option('load_gallery') && LVPISWP28 == true)
			add_filter('attachment_link', array(&$this, 'direct_image_urls_for_galleries'), 10, 2);
					
		// add MCE Editor Button
		if($this->get_option('show_video')) {
			add_action('init', array(&$this, 'mceinit'));
			add_action('admin_print_scripts', array(&$this, 'mce_header'));
		}
		
	}
	
	
	function register_plugin_links($links, $file) {
		$base = plugin_basename(__FILE__);
		if ($file == $base) {
			$links[] = '<a href="options-general.php?page=' . $base .'">' . __('Settings', $this->_get_plugin_name()) . '</a>';
			$links[] = '<a href="http://www.puzich.com/wordpress-plugins/lightview">' . __('Support', $this->_get_plugin_name()) . '</a>';
			$links[] = 'Donate: <a href="http://www.puzich.com/go/donate/">' . __('PayPal', $this->_get_plugin_name()) . '</a>, ';
			$links[] = '<a href="http://www.puzich.com/go/wishlist/">' . __('Amazon Wishlist', $this->_get_plugin_name()) . '</a>';
		}

		return $links;
	}
	

	// nagscreen at plugins page, based on the code of cformsII by Oliver Seidel
	function plugin_version_nag($plugin) {
		if (preg_match('/lightview-plus/i', $plugin)) {
			$checkfile = $this->chk_url . 'lightview-plus.' . $this->version . '.chk';
			$this->plugin_version_get($checkfile, $this->version);
		}
	}
	
	
	function plugin_version_get($checkfile, $version, $tr=false) {
		$vcheck = wp_remote_fopen($checkfile);
		
		if($vcheck) {
			$status = explode('@', $vcheck);
			$theVersion = $status[1];
			$theMessage = $status[3];
			
			if( $theMessage ) {
				if($tr == true)
					echo '</tr><tr>';
			
				if(version_compare($theVersion, $version) == 0) {
					$msg = __("Notice for:", $this->_get_plugin_name());
				} else {
					$msg = __("Update-Notice for:", $this->_get_plugin_name());
				}
				
				$msg .= ' <strong> Version '.$theVersion.'</strong><br />'.$theMessage;
				echo '<td colspan="5" class="plugin-update" style="line-height:1.2em;">'.$msg.'</td>';
			}
            
				if (version_compare($theVersion, $version) == 1) {
					$checkfile = $this->chk_url . 'lightview-plus.' . $theVersion . '.chk';
					$this->plugin_version_get($checkfile, $theVersion, true);
				}
        }
    }


	// Returns the plugin version
	function get_version() {
		if(!function_exists('get_plugin_data')) {
			if(file_exists(ABSPATH . 'wp-admin/includes/plugin.php')) {
				require_once(ABSPATH . 'wp-admin/includes/plugin.php'); //2.3+
			} elseif (file_exists(ABSPATH . 'wp-admin/admin-functions.php')) {
				require_once(ABSPATH . 'wp-admin/admin-functions.php'); //2.1
			} else { 
				return "ERROR: couldn't get version";
			}
		}
		$data = get_plugin_data(__FILE__, false, false);
		
		return $data['Version'];
	}
	
	// initilize the plugin. Everytime the admin page will load, the admin_init hook is fired
	// because after an update, the register_(de)activation_hook isn't fired anymore
	function init() {
		// compare options version and plugin version. If different, an updated was made
		if(version_compare($this->get_option('version'), $this->version, '<' ) ) {
			//add default options
			$default = array(
						'version'				=> $this->version,
						'last_backup'			=> 0,
						'load_from_google' 		=> 0,
						'load_gallery' 			=> 1,
						'show_video' 			=> 1,
						'video_replace_embedcode'		=> 1,
						'backup_lightview' 		=> 1,
						'video_showlink' 		=> 1,
						'video_smallink' 		=> 1,
						'video_preview_width'	=> 300,
						'video_width' 			=> 500,
						'video_separator' 		=> '- ',
						'video_showinfeed' 		=> 1,
						'video_yt_nocookie'		=> 0,
						'video_debug' 			=> 0,
						'lv_skin'				=> 'dark',
						'lv_background'			=> 0,
						'lv_background_color'	=> '#ffffff',
						'lv_background_opacity'	=> 1,
						'lv_border'				=> 0,
						'lv_border_color'		=> '#ffffff',
						'lv_border_size'		=> 8,
						'lv_border_opacity'		=> 1,
						'lv_radius_size'		=> 5,
						'lv_radius_position'	=> 'background',
						'lv_controls_type'		=> 'relative', 
						'lv_overlay'			=> 0,
						'lv_overlay_color'		=> '#202020',
						'lv_overlay_opacity'	=> 0.85,
						'lv_padding'			=> 10,
						'lv_shadow'				=> 1,
						'lv_shadow_blur'		=> 3,
						'lv_shadow_color'		=> '#000000',
						'lv_shadow_opacity'		=>	0.08
						);
			
			// set default values, if they doesn't exist
			foreach ($default as $k => $v) {
				$i = $this->get_option($k);
				if(is_null($i)) {
					$this->update_option($k, $v);
				}
			}
			
			// delete video cache data
			$this->delete_video_cache();		
		}
		
		// restore lightview javascript, if backup exists and not already installed
		$source = dirname(__FILE__) . '/../' . $this->bkp_folder_name;
		if (!$this->check_files($this->js_files)) {				
			$this->restore_javascript($source);
		}
				
		// backup lightview, if it exists and last backup ist older than one week
		if( $this->get_option('backup_lightview') && $this->check_files($this->js_files) && $this->get_option('last_backup') *60*60*24*7 < time() ) {
			$dirnames = array('css', 'js');
			$dest = dirname(__FILE__) . '/../' . $this->bkp_folder_name;
			$return = $this->backup_javascript($dest, $dirnames);
			if (!$return) {
				echo $return;
			}
			// update last backup time
			$this->update_option('last_backup', time());
		}
		
	}
	

	function install() {
		// init options
		$this->init_plugin_options();
		
		// delete backup folder
		/* if( is_writable($source) )
			$this->delete_recursive($source); */
		
		return true;
	}
	
	
	function uninstall() {
		
		// backup lightview, if it exists
		if( $this->get_option('backup_lightview') && $this->check_files($this->js_files)) {
			$dirnames = array('css', 'js');
			$dest = dirname(__FILE__) . '/../' . $this->bkp_folder_name;
			$return = $this->backup_javascript($dest, $dirnames);
			if (!$return) {
				echo $return;
			}
		}
		
		return true;	
	}
	
	// add lightview and libraries
	function enqueueJS() {
		// load javascript librarys from google
		if ($this->get_option('load_from_google')) {
			wp_deregister_script('jquery');
			wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js', false, '1.7', false);
			// add flash support by including SWFObject
			wp_deregister_script('swfobject');
			wp_enqueue_script('swfobject', 'http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js', false, '2.2', false);
		} else {
			wp_enqueue_script('swfobject');
		}
		
		// added excanvas for IE ( only for < IE 9 needed, but currently not possible with WP)
		global $is_IE;
		if ($is_IE) {
			wp_enqueue_script('excanvas', plugins_url('/lightview-plus/js/excanvas/excanvas.js'), array('jquery'), $this->version, false);
		}
		
		if( file_exists(dirname(__FILE__).'/js/spinners/spinners.js')) {
			wp_enqueue_script('lightview_spinners', plugins_url('/lightview-plus/js/spinners/spinners.js'), array('jquery'), $this->version, false);
		} else {
			wp_enqueue_script('lightview_spinners', plugins_url('/lightview-plus/js/spinners/spinners.min.js'), array('jquery'), $this->version, false);
		}
		wp_enqueue_script('lightview', plugins_url('/lightview-plus/js/lightview/lightview.js'), array('jquery', 'lightview_spinners'), $this->version, false);
	}
	
	// add css
	function enqueueCSS() {
		wp_enqueue_style('lightview', plugins_url('/lightview-plus/css/lightview/lightview.css'), false, $this->version, 'screen');
		wp_enqueue_style('lightview_plus', plugins_url('/lightview-plus/style.css'), false, $this->version, 'screen');		
	}
	
	function jsFail($value='') {
		// echo error if lightview js / css isn't copied to plugin dir	
		if(!$this->check_files($this->js_files)) {
			$this->msg_error(__('Lightview Javascript and/or CSS isn\'t copied to the plugin directory. See <a href="http://www.puzich.com/wordpress-plugins/lightview-en">installation instructions for further details</a>. If you have installed an version prior 3.0 of lightview. Please download and copy the new lightview 3.0 or higher in the lightview plus directory. <a href="http://projects.nickstakenburg.com/lightview/download">Please download the new version of lightview here</a>. To get rid of this message, delete all the directories /images, /css and /js in the plugin directory and copy the new lightview into the plugin directory!', $this->_get_plugin_name()));
		}
	}
	
	function AdminMenu() {
		$page = add_options_page('Lightview Plus Options', '<img src="' . @plugins_url('lightview-plus/img/icon.png') . '" width="10" height="10" alt="Lightview Plus - Icon" /> ' . 'Lightview Plus', 'manage_options', $this->_get_plugin_name().'/'.basename(__FILE__), array(&$this, 'OptionsMenu'));	
		add_action('admin_print_styles-' . $page, array($this, 'AdminHeader'));
	}
	
	
	function AdminHeader() {
		wp_enqueue_script('plus_script', plugins_url($this->_get_plugin_name().'/admin.js'), array('jquery'), $this->version);
		wp_enqueue_script('mColorPicker', plugins_url($this->_get_plugin_name().'/mColorPicker.js'), array('jquery'), $this->version);
		wp_enqueue_style('plus_style', plugins_url($this->_get_plugin_name().'/admin.css'), false, $this->version, 'screen');
	}
	
	function show_help($text) {
		echo sprintf('[<a href="" class="tiptip_right" title="%s">?</a>]', $text);
	}
	
	
	// prints all lightview special options
	function get_data_lightview_options() {
		$options = array();
		
		if($this->get_option('lv_background')) {
			array_push($options, sprintf('background: { color: \'%s\', opacity: %1.2F }', $this->get_option('lv_background_color'), $this->get_option('lv_background_opacity')));
		}
		array_push($options, sprintf('skin: \'%s\'', $this->get_option('lv_skin')));
		
		if($this->get_option('lv_border')) {
			array_push($options, sprintf('border: { color: \'%s\', opacity: %1.2F, size: %d }', $this->get_option('lv_border_color'), $this->get_option('lv_border_opacity'), $this->get_option('lv_border_size')));
		}
		array_push($options, sprintf('controls: \'%s\'', $this->get_option('lv_controls_type')));
		array_push($options, sprintf('padding: \'%d\'', $this->get_option('lv_padding')));
		
		if($this->get_option('lv_overlay')) {
			array_push($options, sprintf('overlay: { background: \'%s\', opacity: %1.2F, close: true }', $this->get_option('lv_overlay_color'), $this->get_option('lv_overlay_opacity')));
			array_push($options, sprintf('radius: { size: %d, position: \'%s\' }', $this->get_option('lv_radius_size'), $this->get_option('lv_radius_position')));
		}
		
		if($this->get_option('lv_shadow')) {
			array_push($options, sprintf('shadow: { color: \'%s\', opacity: %1.2F, blur: %d }', $this->get_option('lv_shadow_color'), $this->get_option('lv_shadow_opacity'), $this->get_option('lv_shadow_blur')));
		} else {
			array_push($options, 'shadow: false');
		}
		
		return join(', ', $options);	
	}

	function OptionsMenu() {

		if (!empty($_POST)) {
			// for security
			check_admin_referer('lightview-plus/'.basename(__FILE__));
			
			$options = array(
							'load_from_google'		=> (bool)(!empty($_POST['load_from_google'])),
							'load_gallery'			=> (bool)(!empty($_POST['load_gallery'])),
							'backup_lightview'		=> (bool)(!empty($_POST['backup_lightview'])),
							'show_video'			=> (bool)(!empty($_POST['show_video'])),
							'video_replace_embedcode'	=> (bool)(!empty($_POST['video_replace_embedcode'])),
							'video_showlink'		=> (bool)(!empty($_POST['video_showlink'])),
							'video_smallink'		=> (bool)(!empty($_POST['video_smallink'])),
							'video_separator'		=> (string)$_POST['video_separator'],
							'video_showinfeed'		=> (bool)(!empty($_POST['video_showinfeed'])),
							'video_yt_nocookie'		=> (bool)(!empty($_POST['video_yt_nocookie'])),
							'video_debug'			=> (bool)(!empty($_POST['video_debug'])),
							'lv_skin'				=> (string)$_POST['lv_skin'],
							'lv_background'			=> (bool)(!empty($_POST['lv_background'])),
							'lv_background_color'	=> (string)$_POST['lv_background_color'],
							'lv_border'				=> (bool)(!empty($_POST['lv_border'])),
							'lv_border_color'		=> (string)$_POST['lv_border_color'],
							'lv_controls_type'		=> (string)$_POST['lv_controls_type'], 
							'lv_overlay'			=> (bool)(!empty($_POST['lv_overlay'])),
							'lv_overlay_color'		=> (string)$_POST['lv_overlay_color'],
							'lv_radius_position' 	=> (string)$_POST['lv_radius_position'],
							'lv_shadow'				=> (bool)(!empty($_POST['lv_shadow'])),
							'lv_shadow_color'		=> (string)$_POST['lv_shadow_color'],
						);
							
												
			if(!empty($_POST['video_preview_width'])) {
				$options['video_preview_width'] = (int)$_POST['video_preview_width'];
			}
			
			if(!empty($_POST['video_width'])) {
				$options['video_width'] = (int)$_POST['video_width'];
			}
			
			if(!empty($_POST['lv_background_opacity'])) {
				$options['lv_background_opacity'] = (float)$_POST['lv_background_opacity'];
			}
			
			if(!empty($_POST['lv_border_size'])) {
				$options['lv_border_size'] = (int)$_POST['lv_border_size'];
			}
			
			if(!empty($_POST['lv_border_opacity'])) {
				$options['lv_border_opacity'] = (float)$_POST['lv_border_opacity'];
			}
			
			if(!empty($_POST['lv_overlay_opacity'])) {
				$options['lv_overlay_opacity'] = (float)$_POST['lv_overlay_opacity'];
			}
			
			if(!empty($_POST['lv_padding'])) {
				$options['lv_padding'] = (int)$_POST['lv_padding'];
}			if(!empty($_POST['lv_radius_size'])) {
				$options['lv_radius_size'] = (int)$_POST['lv_radius_size'];
			}
			
			if(!empty($_POST['lv_shadow_blur'])) {
				$options['lv_shadow_blur'] = (int)$_POST['lv_shadow_blur'];
			}
			
			if(!empty($_POST['lv_shadow_opacity'])) {
				$options['lv_shadow_opacity'] = (float)$_POST['lv_shadow_opacity'];
			}
			
			$this->update_options($options); ?>
			
			<div id="message" class="updated fade"><p>
			<strong><?php esc_html_e('Settings saved.') ?></strong>
			</p></div>
<?php	}	?>
		<div class="wrap"><h2>Lightview Plus</h2>
		<form method="post" action="">
		<?php wp_nonce_field($this->_get_plugin_name() . '/' . basename(__FILE__)); ?>
		
		<div id="poststuff">
			<div class="postbox">
				<h3><?php esc_html_e('Settings') ?></h3>
				<div class="inside">
					<ul><li><div>
						<input type="checkbox" name="load_from_google" id="load_from_google" value="1" <?php checked($this->get_option('load_from_google'), 1) ?> />
						<label for="load_from_google"><?php esc_html_e('Load jQuery Library from Google', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php $this->show_help(__('Choose if you want to load jQuery from Google and get it always in the newest version. Otherwise the local version of jQuery will load', $this->_get_plugin_name())); ?>
					</div></li></ul>		
					
					<ul><li><div>
						<input type="checkbox" name="load_gallery" id="load_gallery" value="1" <?php checked($this->get_option('load_gallery'), 1) ?> />
						<label for="load_gallery"><?php esc_html_e('Activate Lightview for [gallery]?', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php $this->show_help(__('If activated, it shows the wordpress gallery with Lightview', $this->_get_plugin_name())); ?>
					</div></li></ul>
					
					<ul><li><div>
						<input type="checkbox" name="backup_lightview" id="backup_lightview" value="1" <?php checked($this->get_option('backup_lightview'), 1) ?> />
						<label for="backup_lightview"><?php esc_html_e('Backup Lightview Javascript during Update', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php $this->show_help(__('Backups the lightview javascript files for upgrade-reasons. After uprading to a new lightview-plus version, it is needless to copy the javascript files back in the plugin directory', $this->_get_plugin_name())); ?>
					</div></li></ul>
				
					<ul><li><div>
						<input type="checkbox" name="show_video" id="show_video" value="1" <?php checked($this->get_option('show_video'), 1) ?> />
						<label for="show_video"><?php esc_html_e('Activate Lightview for Videos', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php $this->show_help(__('Implements the video function. ATTENTION: It only works, if you do not have the embedded video plugin activated', $this->_get_plugin_name())); ?>
					</div>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<input type="checkbox" name="video_showlink" id="video_showlink" value="1" <?php checked($this->get_option('video_showlink'), 1) ?> />
							<label for="video_showlink"><?php esc_html_e('Show Links under videos', $this->_get_plugin_name()) ?></label>
							&nbsp;<?php $this->show_help(__('Show a link to the original site of the video', $this->_get_plugin_name())); ?>
						</div>
							<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
								<input type="checkbox" name="video_smallink" id="video_smallink" value="1" <?php checked($this->get_option('video_smallink'), 1) ?> />
								<label for="video_smallink"><?php esc_html_e('Show a small Link under the Video', $this->_get_plugin_name()) ?></label>
								&nbsp;<?php $this->show_help(__('The video link will be shown smaller', $this->_get_plugin_name())); ?>
							</div></li></ul>
						</li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<label for="video_separator"><?php esc_html_e('Separator', $this->_get_plugin_name()) ?>
							&nbsp;<?php $this->show_help(__('Defines the separator between the service (eg. YouTube) and your comment', $this->_get_plugin_name())); ?></label>
							<input type="text" name="video_separator" id="video_separator" value="<?php echo esc_attr($this->get_option('video_separator')); ?>" class="small-text code" />
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<label for="video_preview_width"><?php esc_html_e('Video Preview Width (in px)', $this->_get_plugin_name()) ?>
								&nbsp;<?php $this->show_help(__('Choose the width of the preview images for the videos', $this->_get_plugin_name())); ?></label>
							<input type="text" name="video_preview_width" id="video_preview_width" value="<?php echo esc_attr($this->get_option('video_preview_width')); ?>" class="small-text code" />
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<label for="video_width"><?php esc_html_e('Video Width (in px)', $this->_get_plugin_name()) ?>
								&nbsp;<?php $this->show_help(__('You can choose, what width the video and image have', $this->_get_plugin_name())); ?></label>
							<input type="text" name="video_width" id="video_width" value="<?php echo esc_attr($this->get_option('video_width')); ?>" class="small-text code" />
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<input type="checkbox" name="video_replace_embedcode" id="video_replace_embedcode" value="1" <?php checked($this->get_option('video_replace_embedcode'), 1) ?> />
							<label for="video_replace_embedcode"><?php esc_html_e('Show all videos with the embed codes with lightview', $this->_get_plugin_name()) ?></label>
							&nbsp;<?php $this->show_help(__('Replaces the embed code of vimeo and youtube videos to show them with lightview', $this->_get_plugin_name())); ?>						
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<input type="checkbox" name="video_yt_nocookie" id="video_yt_nocookie" value="1" <?php checked($this->get_option('video_yt_nocookie'), 1) ?> />
							<label for="video_yt_nocookie"><?php esc_html_e('Show all YouTube videos and load them without setting a cookie', $this->_get_plugin_name()) ?></label>
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<input type="checkbox" name="video_showinfeed" id="video_showinfeed" value="1" <?php checked($this->get_option('video_showinfeed'), 1) ?> />
							<label for="video_showinfeed"><?php esc_html_e('Show video in feed', $this->_get_plugin_name()) ?></label>
								&nbsp;<?php $this->show_help(__('Shows the video in the feed. Otherwise the preview image of the video is shown, with a link to your website.', $this->_get_plugin_name())); ?>
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('show_video') ? '' : 'inact') ?>"><li><div>
							<input type="checkbox" name="video_debug" id="video_debug" value="1" <?php checked($this->get_option('video_debug'), 1) ?> />
							<label for="video_debug"><?php esc_html_e('Show Video Debug Infos', $this->_get_plugin_name()) ?></label>
							&nbsp;<?php $this->show_help(__('Shows video informations, like embed url or image url of the video. Only for debug!', $this->_get_plugin_name())); ?>						
						</div></li></ul>
					</li></ul>
					
					<!-- skin -->
					<ul><li><div>
						<label for="lv_skin"><?php esc_html_e('Skin for Lightview', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Choose the Skin of Lightview.', $this->_get_plugin_name())); ?></label>
						<select name="lv_skin" size="1">
							<option value="dark" <?php selected($this->get_option('lv_skin'), "dark") ?> class="small-text code">dark</option>
							<option value="light" <?php selected($this->get_option('lv_skin'), "light") ?> class="small-text code">light</option>
							<option value="mac" <?php selected($this->get_option('lv_skin'), "mac") ?> class="small-text code">mac</option>
						</select>
					</div></li></ul>
					
					<!-- background -->
					<ul><li><div>
						<input type="checkbox" name="lv_background" id="lv_background" value="1" <?php checked($this->get_option('lv_background'), 1) ?> />
						<label for="lv_background"><?php esc_html_e('Customize background', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php //$this->show_help(__('Implements the video function. ATTENTION: It only works, if you do not have the embedded video plugin activated', $this->_get_plugin_name())); ?>
					</div>
					<ul class="shift <?php echo ($this->get_option('lv_background') ? '' : 'inact') ?>"><li><div>
						<label for="lv_background_color"><?php esc_html_e('Background Color', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Select the color of the background', $this->_get_plugin_name())); ?></label>
						<input type="color" data-hex="true" name="lv_background_color" id="lv_background_color" value="<?php echo esc_attr($this->get_option('lv_background_color')); ?>" class="text code" />
					</div></li></ul>
					<ul class="shift <?php echo ($this->get_option('lv_background') ? '' : 'inact') ?>"><il><div>
						<label for="lv_background_opacity"><?php esc_html_e('Background Opacity', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Choose, how much the background will shine through', $this->_get_plugin_name())); ?></label>
						<select name="lv_background_opacity" size="1">
							<?php for($i=0; $i <= 1.05; $i = $i+0.05) { ?>
							<option value="<?php echo $i ?>" <?php selected($this->get_option('lv_background_opacity'), $i) ?> class="small-text code"><?php echo $i ?></option>
							<?php } ?>
						</select>
					</div></li></ul>
					</li></ul>
					
					<!-- border -->
					<ul><li><div>
						<input type="checkbox" name="lv_border" id="lv_border" value="1" <?php checked($this->get_option('lv_border'), 1) ?> />
						<label for="lv_border"><?php esc_html_e('Customize border', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php //$this->show_help(__('Implements the video function. ATTENTION: It only works, if you do not have the embedded video plugin activated', $this->_get_plugin_name())); ?>
					</div>
					<ul class="shift <?php echo ($this->get_option('lv_border') ? '' : 'inact') ?>"><li><div>
						<label for="lv_border_color"><?php esc_html_e('Border Color', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Select the color of the border around lightview', $this->_get_plugin_name())); ?></label>
						<input type="color" data-hex="true" name="lv_border_color" id="lv_border_color" value="<?php echo esc_attr($this->get_option('lv_border_color')); ?>" class="text code" />
					</div></li></ul>
					<ul class="shift <?php echo ($this->get_option('lv_border') ? '' : 'inact') ?>"><li><div>
						<label for="lv_border_size"><?php esc_html_e('Border Size', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Select how thick the border will be in pixel', $this->_get_plugin_name())); ?></label>
						<select name="lv_border_size" size="1">
							<?php for($i=0; $i < 11; $i++) { ?>
							<option value="<?php echo $i ?>" <?php selected($this->get_option('lv_border_size'), $i) ?> class="small-text code"><?php echo $i ?></option>
							<?php } ?>
						</select>
					</div></li></ul>
					<ul class="shift <?php echo ($this->get_option('lv_border') ? '' : 'inact') ?>"><il><div>
						<label for="lv_border_opacity"><?php esc_html_e('Border Opacity', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Choose, how much the background will shine through the border', $this->_get_plugin_name())); ?></label>
						<select name="lv_border_opacity" size="1">
							<?php for($i=0; $i <= 1.05; $i = $i+0.05) { ?>
							<option value="<?php echo $i ?>" <?php selected($this->get_option('lv_border_opacity'), $i) ?> class="small-text code"><?php echo $i ?></option>
							<?php } ?>
						</select>
					</div></il></ul>
					<ul class="shift <?php echo ($this->get_option('lv_border') ? '' : 'inact') ?>"><il><div>
						<label for="lv_radius_size"><?php esc_html_e('Radius of the border', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Sets the radius of the border', $this->_get_plugin_name())); ?></label>
						<select name="lv_radius_size" size="1">
							<?php for($i=0; $i < 11; $i++) { ?>
							<option value="<?php echo $i ?>" <?php selected($this->get_option('lv_radius_size'), $i) ?> class="small-text code"><?php echo $i ?></option>
							<?php } ?>
						</select>
					</div></li></ul>
					<ul class="shift <?php echo ($this->get_option('lv_border') ? '' : 'inact') ?>"><li><div>
						<label for="lv_radius_position"><?php esc_html_e('Sets the position of the radius', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('The position of the radius can be set by using an object. Possible values are background and border.', $this->_get_plugin_name())); ?></label>
						<select name="lv_radius_position" size="1">
							<option value="border" <?php selected($this->get_option('lv_radius_position'), "border") ?> class="small-text code">border</option>
							<option value="background" <?php selected($this->get_option('lv_radius_position'), "background") ?> class="small-text code">background</option>
						</select>
					</div></li></ul>
					</li></ul>
					
					<!-- controls -->
					<ul><li><div>
						<label for="lv_controls_type"><?php esc_html_e('Sets position and options of the controls', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Sets position of the controls. The default is relative which positions the controls relative to the window, top sets the controls fixed at the top of the screen', $this->_get_plugin_name())); ?></label>
						<select name="lv_controls_type" size="1">
							<option value="top" <?php selected($this->get_option('lv_controls_type'), "top") ?> class="small-text code">top</option>
							<option value="relative" <?php selected($this->get_option('lv_controls_type'), "relative") ?> class="small-text code">relative</option>
						</select>
					</div></li></ul>
					
					<!-- padding -->
					<ul><li><div>
						<label for="lv_padding"><?php esc_html_e('Padding', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('The padding around the content within the window. Often set to 0 when the content should be the only thing visible.', $this->_get_plugin_name())); ?></label>
						<select name="lv_padding" size="1">
							<?php for($i=0; $i < 11; $i++) { ?>
								<option value="<?php echo $i ?>" <?php selected($this->get_option('lv_padding'), $i) ?> class="small-text code"><?php echo $i ?></option>
							<?php } ?>
						</select>
					</div></li></ul>
					
					<!-- overlay -->
					<ul><li><div>
						<input type="checkbox" name="lv_overlay" id="lv_overlay" value="1" <?php checked($this->get_option('lv_overlay'), 1) ?> />
						<label for="lv_overlay"><?php esc_html_e('Customize overlay', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php //$this->show_help(__('Implements the video function. ATTENTION: It only works, if you do not have the embedded video plugin activated', $this->_get_plugin_name())); ?>
					</div>
					<ul class="shift <?php echo ($this->get_option('lv_overlay') ? '' : 'inact') ?>"><li><div>
						<label for="lv_overlay_color"><?php esc_html_e('Sets the color of the overlay', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Sets the color of the overlay', $this->_get_plugin_name())); ?></label>
						<input type="color" data-hex="true" name="lv_overlay_color" id="lv_overlay_color" value="<?php echo esc_attr($this->get_option('lv_overlay_color')); ?>" class="text code" />
					</div></li></ul>
					<ul class="shift <?php echo ($this->get_option('lv_overlay') ? '' : 'inact') ?>"><il><div>
						<label for="lv_overlay_opacity"><?php esc_html_e('Sets the opacity of the overlay', $this->_get_plugin_name()) ?>
						&nbsp;<?php $this->show_help(__('Sets the opacity of the overlay', $this->_get_plugin_name())); ?></label>
						<select name="lv_overlay_opacity" size="1">
							<?php for($i=0; $i <= 1.05; $i = $i+0.05) { ?>
							<option value="<?php echo $i ?>" <?php selected($this->get_option('lv_overlay_opacity'), $i) ?> class="small-text code"><?php echo $i ?></option>
							<?php } ?>
						</select>
					</div></il></ul>
					</li></ul>
					
					<!-- shadow -->
					<ul><li><div>
						<input type="checkbox" name="lv_shadow" id="lv_shadow" value="1" <?php checked($this->get_option('lv_shadow'), 1) ?> />
						<label for="lv_shadow"><?php esc_html_e('Activate shadow around the window', $this->_get_plugin_name()) ?></label>
						&nbsp;<?php $this->show_help(__('Defines if you want a shadow around the lightview window', $this->_get_plugin_name())); ?>
					</div>
						<ul class="shift <?php echo ($this->get_option('lv_shadow') ? '' : 'inact') ?>"><li><div>
							<label for="lv_shadow_color"><?php esc_html_e('Shadow color', $this->_get_plugin_name()) ?>
							&nbsp;<?php $this->show_help(__('Set the shadow underneath the window', $this->_get_plugin_name())); ?></label>
							<input type="color" data-hex="true" name="lv_shadow_color" id="lv_shadow_color" value="<?php echo esc_attr($this->get_option('lv_shadow_color')); ?>" class="text code" />
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('lv_shadow') ? '' : 'inact') ?>"><li><div>
							<label for="lv_shadow_blur"><?php esc_html_e('Shadow blur', $this->_get_plugin_name()) ?>
							&nbsp;<?php $this->show_help(__('Style the shadow', $this->_get_plugin_name())); ?></label>
							<select name="lv_shadow_blur" size="1">
								<?php for($i=0; $i < 11; $i++) { ?>
								<option value="<?php echo $i ?>" <?php selected($this->get_option('lv_shadow_blur'), $i) ?> class="small-text code"><?php echo $i ?></option>
								<?php } ?>
							</select>
						</div></li></ul>
						<ul class="shift <?php echo ($this->get_option('lv_shadow') ? '' : 'inact') ?>"><li><div>
							<label for="lv_shadow_opacity"><?php esc_html_e('Shadow Opacity', $this->_get_plugin_name()) ?>
							&nbsp;<?php $this->show_help(__('Choose opacity of the shadow', $this->_get_plugin_name())); ?></label>
							<select name="lv_shadow_opacity" size="1">
								<?php for($i=0; $i <= 1.05; $i = $i+0.05) { ?>
								<option value="<?php echo $i ?>" <?php selected($this->get_option('lv_shadow_opacity'), $i) ?> class="small-text code"><?php echo $i ?></option>
								<?php } ?>
							</select>
						</div></li></ul>
					</li></ul>
					
				</div>
			<p><input type="submit" name="lightview_plus_submit" class="button-primary" value="<?php esc_html_e('Save Changes') ?>" /></p>
			</div>
			</form>
			
			<div id="poststuff">
				<div class="postbox">
					<h3><?php esc_html_e('Donation', $this->_get_plugin_name()) ?></h3>
					<div class="inside">
						<ul><li><div>
							<?php _e('Lightview Plus has required a great deal of time and effort to develop. If it\'s been useful to you then you can support this development by making a small donation. This will act as an incentive for me to carry on developing it, providing countless hours of support, and including any enhancements that are suggested. If you don\'t have a clue how much you want to spend, the average of the last donations were €8. But every other amount is welcome. Please note, that PayPal takes for every transaction round about €0.50. So every donation below €1 is only a donation to PayPal ;-) Further you have the options to have a look at my amazon wishlist.', $this->_get_plugin_name()); ?><br />
							<center><a href="http://www.puzich.com/go/donate"><img src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/lightview-plus/img/donate.gif" /> <?php _e('Donate via PayPal!', 'lightviewplus'); ?></a> or <a href="http://www.puzich.com/go/wishlist/"><?php _e('make a gift with Amazon', $this->_get_plugin_name()) ?></a></center>
						</div></li></ul>
					</div>
				</div>
			
			<p><small>Video Icon from <a href="http://www.famfamfam.com">famfamfam </a>. Special thanks to Jovelstefan and his plugin <a href="http://wordpress.org/extend/plugins/embedded-video-with-link/">Embedded Video with Link</a>, which inspired me.</small></p>
			
			
		</div>
		</div>
	<?php
	}
	
	function mcebutton($buttons) {
		array_push($buttons, "|", "lightviewplus");
		return $buttons;
	}
	

	function mceplugin($ext_plu) {
		if (is_array($ext_plu) == false) {
			$ext_plu = array();
		}
		
		$url = get_option('siteurl')."/wp-content/plugins/lightview-plus/editor_plugin.js";
		$result = array_merge($ext_plu, array('lightviewplus' => $url));
		return $result;
	}
	

	function mceinit() {
		if (function_exists('load_plugin_textdomain')) load_plugin_textdomain( $this->_get_plugin_name(), false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
		if ( 'true' == get_user_option('rich_editing') ) {
			add_filter('mce_external_plugins', array(&$this, 'mceplugin'), 0);
			add_filter("mce_buttons", array(&$this, 'mcebutton'), 0);
		}
	}
	

	function mce_header() {
		echo "<script type='text/javascript' src='".get_option('siteurl')."/wp-content/plugins/lightview-plus/lightview-plus.js'></script>\n";
	}
	
	
	function direct_image_urls_for_galleries( $link, $id ) {
		if ( is_admin() ) return $link;

		$mimetypes = array( 'image/jpeg', 'image/png', 'image/gif' );

		$post = get_post( $id );

		if ( in_array( $post->post_mime_type, $mimetypes ) )
			return wp_get_attachment_url( $id );
		else
			return $link;
	}

}

//initalize class
if (class_exists('lightview_plus'))
	$lightview_plus = new lightview_plus();
	
/* 
   if function simplexml_load_string is not compiled into php
   use simplexml.class.php
*/
if(!function_exists("simplexml_load_string")) {
	require_once('libs/simplexml.class.php');
	
	function simplexml_load_string($file) {
		$sx = new simplexml;
		return $sx->xml_load_string($file);
	}
}
?>
