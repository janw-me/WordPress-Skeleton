<?php

if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

global $wp_version;

class plus_core {
	
	// version
	var $version;

	// put all options in
	var $options = array();
	
	// put all video tags in 
	var $video = array();
	
	// plugin name
	var $pluginname;
	
	function plus_core() {
		$this->__construct();
	}
	
	function __construct() {
		// nothing to do
	}
	
	function videotargets() {		
		// define object targets and links
		$this->video['default']['target'] = sprintf('<a href="###EMBEDURL###" %s><span class="plus_previewimage" style="width:###PREVIEWWIDTH###px;"><img src="###IMAGE###" width="###PREVIEWWIDTH###" height="###PREVIEWHEIGHT###" alt="###TITLE###" /><span class="plus_playbutton" style="left: ###LEFT###px; top: ###TOP###px;"> ▶ </span></span></a><br />', $this->create_link_attr('video'));
		$this->video['default']['feed']   = '<img src="###IMAGE###" width="###PREVIEWWIDTH###" height="###PREVIEWHEIGHT###" alt="###TITLE###" />';
		$this->video['default']['link']   = "<a title=\"###VIDEOTITLE###\" href=\"###LINK### \">###PROVIDER### ###SEPERATOR######TITLE###</a>";	
		$this->video['default']['embed']  = '<iframe width="425" height="349" src="###EMBEDURL###" frameborder="0"></iframe>';
				
	/*	$this->video['video']['flash']['target'] = "<object id=\"flowplayer\" width=\"###WIDTH###\" height=\"###HEIGHT###\" data=\"" . get_option('siteurl') . "/wp-content/plugins/lightview-plus/flowplayer/flowplayer-3.1.1.swf\" type=\"application/x-shockwave-flash\"> <param name=\"movie\" value=\"" . get_option('siteurl') . "/wp-content/plugins/lightview-plus/flowplayer/flowplayer-3.1.1.swf\" /> <param name=\"allowfullscreen\" value=\"true\" /> <param name=\"flashvars\" value='config={\"clip\":\"###VIDEOID###\"}' /></object>"; 		
		$this->video['video']['quicktime']['target'] = "<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab\" width=\"" .  $this->get_option('video_width') . "\" height=\"" . 	$this->video['local']['quicktime']['height'] . "\"><param name=\"src\" value=\"".get_option('siteurl')."###VIDEOID###\" /><param name=\"autoplay\" value=\"false\" /><param name=\"pluginspage\" value=\"http://www.apple.com/quicktime/download/\" /><param name=\"controller\" value=\"true\" /><!--[if !IE]> <--><object data=\"".get_option('siteurl')."###VIDEOID###\" width=\"" . $this->get_option('video_width') . "\" height=\"" . 	$this->video['local']['quicktime']['height'] . "\" type=\"video/quicktime\"><param name=\"pluginurl\" value=\"http://www.apple.com/quicktime/download/\" /><param name=\"controller\" value=\"true\" /><param name=\"autoplay\" value=\"false\" /></object><!--> <![endif]--></object><br />";
		$this->video['video']['target'] = "<object classid=\"clsid:22D6f312-B0F6-11D0-94AB-0080C74C7E95\" codebase=\"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112\" width=\"".GENERAL_WIDTH."\" height=\"".VIDEO_HEIGHT."\" type=\"application/x-oleobject\"><param name=\"filename\" value=\"".get_option('siteurl')."###VIDEOID###\" /><param name=\"autostart\" value=\"false\" /><param name=\"showcontrols\" value=\"true\" /><!--[if !IE]> <--><object data=\"".get_option('siteurl')."###VIDEOID###\" width=\"".GENERAL_WIDTH."\" height=\"".VIDEO_HEIGHT."\" type=\"application/x-mplayer2\"><param name=\"pluginurl\" value=\"http://www.microsoft.com/Windows/MediaPlayer/\" /><param name=\"ShowControls\" value=\"true\" /><param name=\"ShowStatusBar\" value=\"true\" /><param name=\"ShowDisplay\" value=\"true\" /><param name=\"Autostart\" value=\"0\" /></object><!--> <![endif]--></object><br />";
		$this->video['video']['link'] = "<a title=\"Local Video\" href=\"".get_option('siteurl')."###VIDEOID###\">Download Video</a>"; */
	}
	
	/* 
		debug class
	 	Usage:
		$this->debug(array('This is a message' => 'for debugging purposes'));
		$this->debug('This is a message for debugging purposes');
	*/
	function debug($message) {
		if (WP_DEBUG === true) {
			if (is_array($message) || is_object($message)) {
				error_log(print_r($message, true));
			} else {
				error_log($message);
			}
		}
	}
	
	
	// get plugin name
	function _get_plugin_name() {
		$plugindirname = basename(dirname(dirname(__FILE__)));
		switch($plugindirname) {
			case 'topup-plus':
				$name = 'topup-plus';
				break;
			case 'fancybox-plus':
				$name = 'fancybox-plus';
				break;
			default:
			case 'lightview-plus':
				$name = 'lightview-plus';
				break;
		}
		return $name;
	}
	
	// create link attributes for the plugins
	// $content -> create attribute for video or image, default: image
	function create_link_attr($content = 'image') {
		switch($this->_get_plugin_name()) {
			case 'topup-plus':

				break;
			case 'fancybox-plus':
				if ($content == 'image') {
					$attr = sprintf('class="fancyboxgroup" rel="gallery-%s"', $GLOBALS['post']->ID);
				} elseif ($content == 'video') {
					$attr = 'title="###VIDEOTITLE###" class="fancybox###MEDIATYPE### {width: ###WIDTH###,height: ###HEIGHT###}"';
				}
				break;
			default:
			case 'lightview-plus':
				if ($content == 'image') {
					$attr = sprintf('class="lightview" data-lightview-group="group-%s" data-lightview-options="%s"', $GLOBALS['post']->ID, $this->get_data_lightview_options());
				} elseif ($content == 'video') {
					$attr = 'data-lightview-title="###VIDEOTITLE###" data-lightview-options="width: ###WIDTH###, height: ###HEIGHT###, '. $this->get_data_lightview_options() .'" class="lightview" data-lightview-type="###MEDIATYPE###"';
				}
				
				break;
		}
		return $attr;
	}
	
	// creates error and warn message
	function msg_error($value='') {
		echo '<div id="message" class="error"><p><strong>' . $value . '</strong></p></div>';
	}
	
	function msg_warn($value='') {
		echo '<div id="message" class="warn"><p><strong>' . $value . '</strong></p></div>';
	}
	
	
	function get_option($field) {
		if ( !$options = wp_cache_get($this->_get_plugin_name()) ) {
			$options = get_option($this->_get_plugin_name());
			wp_cache_set($this->_get_plugin_name(), $options);
		}
		
		return @$options[$field];
	}
	
	
	function update_option($field, $value) {
		$this->update_options(array($field => $value));
	}
	
	
	function update_options($data) {
		$options = array_merge((array)get_option($this->_get_plugin_name()), $data);
		update_option($this->_get_plugin_name(), $options);
		wp_cache_set($this->_get_plugin_name(), $options);
	}
	
	
	function init_plugin_options() {
		add_option($this->_get_plugin_name(), array(), '', 'no');
	}
	
		
	// backups javascript
	function backup_javascript($destination, $dirnames) {
		// check if $dirnames is an array
		if(!is_array($dirnames)) {
			return "No directory array given!";
		}
		
		if(!is_string($destination))
			return "No backup destination given";
		
		if(is_writable(dirname(__FILE__).'/../..')) {
			if(!is_dir($destination) ) {
				mkdir($destination, 0777);
			}
		} else {
			return "Can't create backup directory";
		}
		
		for($i=0; $i < count($dirnames); $i++) {
			// subfolder to copy
			$folder = $dirnames[$i];
			
			// source files with foldernames
			$source = dirname(__FILE__);
			$source .= "/../";
			$source .= $folder;

			// copy files
			$this->copy_recursive($source, $destination.'/'.$folder);
		}

		return true;
	}
	
	// restores javascript
	function restore_javascript($source) {	
		if(!is_string($source))
			return false;
		
		if(is_writable(dirname(__FILE__)) && is_dir($source)) {
			$this->copy_recursive($source, dirname(__FILE__).'/../');
		}

		return true;
	}
	
	// copy -R
	function copy_recursive($source, $dest) {
		// Simple copy for a file
		if (is_file($source)) {
			$c = copy($source, $dest);
			chmod($dest, 0777);
			return $c;
		}
		
		// Make destination directory
		if (!is_dir($dest)) {
			$oldumask = umask(0);
			mkdir($dest, 0777);
			umask($oldumask);
		}
		
		// Loop through the folder
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
		// Skip pointers
			if ($entry == "." || $entry == "..") {
				continue;
			}

			// Deep copy directories
			if ($dest !== "$source/$entry") {
				$this->copy_recursive("$source/$entry", "$dest/$entry");
			}
		}
		
		// Clean up
		$dir->close();
		
		return true;
	}
	
	// rm -R
	function delete_recursive($dirname)	{ 
		// recursive function to delete
		// all subdirectories and contents:
		if(is_dir($dirname)) $dir_handle=opendir($dirname);
		
		while($file=readdir($dir_handle)) {
			if( $file != "." && $file != ".." ) {
				if(!is_dir($dirname."/".$file)) {
					unlink ($dirname."/".$file);
				} else {
					$this->delete_recursive($dirname."/".$file);
				}
			}
		}

		closedir($dir_handle);
		rmdir($dirname);
		
		return true;
	}
	
	// checks the existance of an array with files in the filesystem
	function check_files($files) {
		if(!is_array($files))
			return false;
			
		for($i=0; $i < count($files); $i++) {
			if(!is_dir(dirname(__FILE__).'/../'.$files[$i])) {
				if(!file_exists(dirname(__FILE__).'/../'.$files[$i])) {
					return false;
				}
			}
		}
		return true;
	}

	function change_content($content) {
		
		// makes a set of pictures to a gallery
		// taken from add-lightbox-title plugin! Gracias!
		$pattern['image'][0]		= "/(<a)([^\>]*?) href=('|\")([A-Za-z0-9\?=,%\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)>(.*?)<\/a>/i";
		$replacement['image'][0]	= '$1 href=$3$4$5$6$2$7>$8</a>';
		// [0] <a xyz href="...(.bmp|.gif|.jpg|.jpeg|.png)" zyx>yx</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz zyx>yx</a>
		$pattern['image'][1]		= "/(<a href=)('|\")([A-Za-z0-9\?=,%\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)(>)(.*?)(<\/a>)/i";
		$replacement['image'][1]	= '$1$2$3$4$5 '. $this->create_link_attr('image') .'$6$7$8$9';
		// [1] <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz zyx>yx</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" class="lightview" rel="gallery[POST-ID]" xyz zyx>yx</a>
		$pattern['image'][2]		= "/(<a href=)('|\")([A-Za-z0-9\?=,%\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\") rel=('|\")gallery([^\>]*?)('|\")([^\>]*?) rel=('|\")(gallery)([^\>]*?)('|\")([^\>]*?)(>)(.*?)(<\/a>)/i";
		$replacement['image'][2]	= '$1$2$3$4$5$9 rel=$10$11$12$13$14$15$16$17';
		// [2] <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" rel="gallery[POST-ID]" xyz rel="(gallery)yxz" zyx>yx</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz rel="(gallery)yxz" zyx>yx</a>  !!!
		$pattern['image'][3]		= "/(<a href=)('|\")([A-Za-z0-9\?=,%\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)(>)(.*?) title=('|\")(.*?)('|\")(.*?)(<\/a>)/i";	
		if($this->_get_plugin_name() == 'lightview-plus') {
			$replacement['image'][3]	= '$1$2$3$4$5$6 data-lightview-title=$9$10$11$7$8 title=$9$10$11$12$13';
		} else {
			$replacement['image'][3]	= '$1$2$3$4$5$6 title=$9$10$11$7$8 title=$9$10$11$12$13';
		}
		// [3] <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz>yx title=yxz xy</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz title=yxz>yx title=yxz xy</a>
		$pattern['image'][4]		= "/(<a href=)('|\")([A-Za-z0-9\?=,%\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?) title=([^\>]*?) title=([^\>]*?)(>)(.*?)(<\/a>)/i";
		$replacement['image'][4]	= '$1$2$3$4$5$6 title=$7$9$10$11';
		// [4] <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz title=zxy xzy title=yxz>yx</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz title=zxy xzy>yx</a>
		$content = preg_replace($pattern['image'], $replacement['image'], $content);
		
		// replaces the video embed code with my plus shortcode, if needed
		if($this->get_option('show_video') && $this->get_option('video_replace_embedcode')) {
			// old youtube pattern with flash
			$embed_pattern[0] = '#<object[^>]+>.+?http://www.(youtube|youtube-nocookie).com/v/([A-Za-z0-9\-_]+).+?</object>#';
			$embed_replace[0] = '[youtube \2 nolink]';
			// new youtube pattern with iframe
			// <iframe width="560" height="315" src="http://www.youtube.com/embed/FQeLcd-Cj84" frameborder="0" allowfullscreen></iframe>
			$embed_pattern[1] = '#<iframe.+?http://www.(youtube|youtube-nocookie).com/embed/([A-Za-z0-9\-_]+).+?></iframe>#';
			$embed_replace[1] = '[youtube \2 nolink]';
			// old vimeo embed code with flash
			// <object width="400" height="225"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=35715156&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=ffffff&amp;fullscreen=1&amp;autoplay=1&amp;loop=0" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=35715156&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=ffffff&amp;fullscreen=1&amp;autoplay=1&amp;loop=0" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="400" height="225"></embed></object><p><a href="http://vimeo.com/35715156">Abraj: The two towers of Dubai</a> from <a href="http://vimeo.com/philipbloom">Philip Bloom</a> on <a href="http://vimeo.com">Vimeo</a>.</p>
			$embed_pattern[2] = '#<object.+?>.+?http:\/\/vimeo.com\/moogaloop.swf\?clip_id=([0-9]+).+?</object>#';
			$embed_replace[2] = '[vimeo \1 nolink]';
			// new vimeo embed code with iframe
			// <iframe src="http://player.vimeo.com/video/35715156?color=ffffff&amp;autoplay=1" width="400" height="225" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><p><a href="http://vimeo.com/35715156">Abraj: The two towers of Dubai</a> from <a href="http://vimeo.com/philipbloom">Philip Bloom</a> on <a href="http://vimeo.com">Vimeo</a>.</p>
			$embed_pattern[3] = '#<iframe.+?http://player.vimeo.com/video/([0-9]+).+?></iframe>#';
			$embed_replace[3] = '[vimeo \1 nolink]';
			
			$content = preg_replace($embed_pattern, $embed_replace, $content);
		}
		
		
		// RegEx for Videos
		$pattern['video'][1] = "/\[(youtube|youtubehq|vimeo|bliptv|video) ([[:graph:]]+) (nolink)\]/";
		$pattern['video'][2] = "/\[(youtube|youtubehq|vimeo|bliptv|video) ([[:graph:]]+) ([[:print:]]+)\]/";
		$pattern['video'][3] = "/\[(youtube|youtubehq|vimeo|bliptv|video) ([[:graph:]]+)\]/";
		
		// does the video thing
		if($this->get_option('show_video')) {
			$content = preg_replace_callback($pattern['video'][1], array(&$this, 'video_callback'), $content);			
			$content = preg_replace_callback($pattern['video'][2], array(&$this, 'video_callback'), $content);
			$content = preg_replace_callback($pattern['video'][3], array(&$this, 'video_callback'), $content);
		}
	
		return $content;
	}
	
	// video callback logic
	function video_callback($match) {
		$output = '';
		// insert plugin link
		if ( is_feed() ) {
			// show video in feed or preview
			if($this->get_option('video_showinfeed')) {
				$output .= $this->video['default']['embed'];
			} else {
				$output .= $this->video['default']['feed'];
				$output .= "<br />";
				$output .= __('There is a video that cannot be displayed in this feed. ', $this->_get_plugin_name()).'<a href="'.get_permalink().'">'.__('Visit the blog entry to see the video.',$this->_get_plugin_name()).'</a>';
			}
		} else {
			switch ($match[1]) {
				case "youtube": 
				case "youtubehq": 
					if ($this->is_mobile() == true) {
						$output .= $this->video['default']['embed'];
					} else {
						$output .= $this->video['default']['target']; 
					}
					break;
				case "vimeo":
					if ($this->is_mobile() == true) { 
						$output .= $this->video['default']['embed'];
					} else { 
						$output .= $this->video['default']['target'];
					}
					break;
				case "bliptv": $output .= $this->video['default']['target']; break;
				default: 
					break;
			}
			
			if ($this->get_option('video_showlink') == true) {
				if ($match[3] != "nolink" ) {
					if ($this->get_option('video_smallink')) 
						$output .= "<small>";
					
					switch ($match[1]) {
						case "youtube": $output .= $this->video['default']['link']; break;
						case "youtubehq": $output .= $this->video['default']['link']; break;
						case "vimeo": $output .= $this->video['default']['link']; break;
						case "bliptv": $output .= $this->video['default']['link']; break;
						default: break;
					}
					
					if ($this->get_option('video_smallink')) 
						$output .= "</small>";
				}
			}
		} 
		
		// postprocessing
		// first replace video_separator
		$output = str_replace("###SEPERATOR###", $this->get_option('video_separator'), $output);
		
		// replace video IDs and text	
		if ($match[3] != "nolink") {
			$output = str_replace("###TITLE###", esc_html($match[3]), $output);
		} else {
			$output = str_replace("###TITLE###", '', $output);
		}
		$output = str_replace("###VIDEOID###", $match[2], $output);
		
		
		// replace palceholder with videodata
		$videodata = $this->get_cached_videodata($match[1], $match[2]);
		
		// got no errors? Show video!
		if($videodata['available'] == true) {
			$output = str_replace("###IMAGE###", $videodata['thumbnail'], $output); // Thumbnail
			$output = str_replace("###EMBEDURL###", $videodata['embedurl'], $output); // Embed URL
			$output = str_replace("###LINK###", $videodata['link'], $output); // Link
			$output = str_replace("###VIDEOTITLE###", $videodata['title'], $output); // Video Title
			$output = str_replace("###PROVIDER###", $videodata['provider'], $output);
			if(!empty($videodata['mediatype'])) {
				$output = str_replace("###MEDIATYPE###", $videodata['mediatype'], $output);
			} else {
				$output = str_replace("###MEDIATYPE###", 'flash', $output);
			}
				
			if(!empty($videodata['height']) && !empty($videodata['width'])) {
				$output = str_replace("###WIDTH###", $this->get_option('video_width'), $output); // Width
				$output = str_replace("###HEIGHT###", floor($this->get_option('video_width') / $videodata['width'] * $videodata['height']), $output); // Height
				$output = str_replace("###PREVIEWWIDTH###", $this->get_option('video_preview_width'), $output); // Preview Width
				$output = str_replace("###PREVIEWHEIGHT###", floor($this->get_option('video_preview_width') / $videodata['width'] * $videodata['height']), $output); // Preview Height
				$output = str_replace("###LEFT###", floor($this->get_option('video_preview_width') / 2) - 50, $output); // left
				$output = str_replace("###TOP###", floor(($this->get_option('video_preview_width') / $videodata['width'] * $videodata['height']) / 2) - 25, $output); // top
			}
		
			// add HTML comment
			$output .= "\n<!-- generated by WordPress Plugin $this->pluginname $this->version -->\n";
		
		} else {
		
			// got errors during receiving videodata? Show nice placeholder
			$output = sprintf('<img src="'. @plugins_url(basename(dirname(dirname(__FILE__))) . '/img/novideo.png') .'" width="%s" height="%s" alt="'. __('Video not available', $this->_get_plugin_name()) .'" /><br />',
								$this->get_option('video_preview_width'),
								floor($this->get_option('video_preview_width') / 640 * 360)
							);
		}	
		
		// show debug informations under the videos
		if($this->get_option('video_debug') == true ) {
			$debug = sprintf('<div style="background-color:#FFC0CB; border:1px solid silver; color:#110000; margin:0 0 1.5em; overflow:auto; padding: 3px;">
								<strong>Provider:</strong> %s <br />
								<strong>Title:</strong> %s <br />
								<strong>Thumbnail URL:</strong> %s <br />
								<strong>Embed URL:</strong> %s <br />
								<strong>Link:</strong> %s <br />
								<strong>Width:</strong> %s px<br />
								<strong>Height:</strong> %s px<br />
								<strong>Got data @:</strong> %s<br />
							</div>',
							$videodata['provider'],
							$videodata['title'],
							$videodata['thumbnail'],
							$videodata['embedurl'],
							$videodata['link'],
							$videodata['width'],
							$videodata['height'],
							date('d.n.Y H:i:s', $videodata['timestamp'])
							);
							
			$output .= $debug;
		}
		
		return $output;
	}
	
	// get the video data out of the cache
	function get_cached_videodata($service, $id) {
		$videodata = get_post_meta($GLOBALS['post']->ID, '_plusvideocache', true);
		
		// if no cached data available or data is older than 24 hours, refresh/get data from video provider
		if(empty($videodata[$service][$id]) || $videodata[$service][$id]['timestamp'] + (60 * 60 * 24) < time() ) {
			$videodata[$service][$id] = $this->get_videodata($service, $id);
			update_post_meta($GLOBALS['post']->ID, '_plusvideocache', $videodata);
		}
		
		return $videodata[$service][$id];		
	}
	
	// puts the video data into cache
	function get_videodata($service, $id) {
		switch($service) {
			case "youtube":
			case "youtubehq":
				$api      = sprintf('http://gdata.youtube.com/feeds/api/videos/%s', $id);
				$xml      = @simplexml_load_string(wp_remote_fopen($api));
				
				if (is_object($xml)) {
					$media    = $xml->children('http://search.yahoo.com/mrss/');
					
					if($media->group->thumbnail) {
						$attribs  = $media->group->thumbnail[0]->attributes();
					
						$output['available']    = true;
						$output['provider']     = 'YouTube';
						//$output['mediatype']	= 'flash';
						$output['mediatype']	= 'iframe';
						$output['title']	    = addslashes((string)$media->group->title);
						$output['embedurl']	    = sprintf('http://www.youtube.com/embed/%s', $id);
						// Show YouTube videos without setting a cookie
						if( !$this->get_option('video_yt_nocookie') )
							$output['embedurl']	    = sprintf('http://www.youtube.com/embed/%s', $id);
							
						//$output['thumbnail']    = sprintf('http://i.ytimg.com/vi/%s/0.jpg', $id);
						$output['thumbnail']    = (string) $attribs['url'];
						$output['width']        = (int) $attribs['width'];
						$output['height']       = (int) $attribs['height'];
						$output['link']         = sprintf('http://www.youtube.com/watch?v=%s', $id);
					
						// add autoplay, if it isn't a feed or a mobile device
						if( !$this->is_mobile() || !is_feed() )
							$output['embedurl'] = sprintf('%s?autoplay=1', $output['embedurl']);
					
						// add HD Video (now, always on)
						//if($service == 'youtubehq')
							$output['embedurl'] = sprintf('%s&amp;hd=1', $output['embedurl']);
					} else {
						$output['available'] = false;
					}
					
				} else {
					$output['available'] = false;
				}
				$output['timestamp'] = time();
				
				break;
			case "vimeo":
				// check if $id is numeric
				if(!is_numeric($id)) {
					$output['available'] = false;
					return $output;
				}
					
				// Get preview image from vimeo
				$api    = sprintf('http://vimeo.com/api/v2/video/%s.xml', $id);
				$video  = @simplexml_load_string(wp_remote_fopen($api));
				
				$outout = array();
				$output['available']    = true;
				$output['provider']     = 'Vimeo';
				$output['title']        = addslashes((string) $video->video->title);
				$output['embedurl']	    = (string) sprintf('http://player.vimeo.com/video/%s', $id);
				$output['mediatype']	= 'iframe';
				$output['thumbnail']    = (string) $video->video->thumbnail_large;
				$output['width']        = (int) $video->video->width;
				$output['height']       = (int) $video->video->height;
				$output['link']         = sprintf('http://www.vimeo.com/%s', $id);
				$output['timestamp'] = time();
				
				// add autoplay
				if( !$this->is_mobile() || !is_feed() )
					$output['embedurl'] = sprintf('%s?autoplay=1', $output['embedurl']);
				
				// check response
				if(empty($output) || empty($output['width']) || empty($output['height']) || empty($output['thumbnail']) ) {
					$output['available'] = false;
					return $output;
				}
				
				break;
			case "bliptv":
				// require SimplePie
				require_once(ABSPATH . WPINC . '/feed.php');
				$api = sprintf('http://www.blip.tv/file/%s?skin=rss', $id);
				$namespace['media'] = 'http://search.yahoo.com/mrss/';
				$namespace['blip']  = 'http://blip.tv/dtd/blip/1.0';
				
				// fetch feed
				$rss = fetch_feed($api);
					
				if(is_wp_error($rss)) {
					$output['available'] == false;
					return $output;
				}
				
				// get items
				$item = $rss->get_item();
				
				// get media items
				$mediaGroup     = $item->get_item_tags($namespace['media'], 'group');
				$mediaContent   = $mediaGroup[0]['child'][$namespace['media']]['content'];
				
				// get blip items
				$blipThumbnail = $item->get_item_tags($namespace['blip'], 'thumbnail_src');
				$blipEmbedURL  = $item->get_item_tags($namespace['blip'], 'embedUrl');
					
				$output['available']    = true;
				$output['provider']     = 'Blip.TV';
				$output['title']        = addslashes((string) $rss->get_title());
				$output['embedurl']     = (string) $blipEmbedURL[0]['data'];
				$output['mediatype']	= 'flash';
				$output['thumbnail']    = (string) sprintf('http://a.images.blip.tv/%s', $blipThumbnail[0]['data']);
				$output['height']       = (int) $mediaContent[count($mediaContent)-1]['attribs']['']['height'];
				$output['width']        = (int) $mediaContent[count($mediaContent)-1]['attribs']['']['width'];
				$output['link']         = (string) $item->get_link();
				$output['timestamp'] = time();
				
				// add autoplay
				if( !$this->is_mobile() || !is_feed() )
					$output['embedurl'] = sprintf('%s?autoStart=true', $output['embedurl']);
				
				// check response
				if(empty($output)) {
					$output['available'] = false;
					return $output;
				}
				
					
				break;
			case "video":
				break;
			default: break;
		}
				
		return $output;
	}
	
	function delete_video_cache() {
		$args = array( 'post_type' => 'post', 'numberposts' => -1, 'post_status' => null, 'meta_key' => '_plusvideocache' );
		$all_posts = get_posts($args);
		
		foreach( $all_posts as $postinfo) {
			delete_post_meta($postinfo->ID, '_plusvideocache');
		}
	}

	function is_mobile() {
		$uas = array ( 'iPhone', 'iPod', 'iPad', 'Android');

		foreach ( $uas as $useragent ) {
			$pattern = sprintf('/%s/', $useragent);
			if ( (bool) preg_match($pattern, $_SERVER['HTTP_USER_AGENT'])) {
				return true;
			} 
		}
		return false;
	}

}

?>
