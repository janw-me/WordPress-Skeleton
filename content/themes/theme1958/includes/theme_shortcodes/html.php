<?php
/**
 *
 * HTML Shortcodes
 *
 */

// Frames
function frame_shortcode($atts, $content = null) {
	$output = '<figure class="frame featured-thumbnail clearfix"><span class="img-box">';
	$output .= do_shortcode($content);
	$output .= '</span></figure><!-- .frame (end) -->';
	return $output;
}
add_shortcode('frame', 'frame_shortcode');

function frame_left_shortcode($atts, $content = null) {
	$output = '<figure class="frame featured-thumbnail fleft"><span class="img-box">';
	$output .= do_shortcode($content);
	$output .= '</span></figure><!-- .frame (end) -->';
	return $output;
}
add_shortcode('frame_left', 'frame_left_shortcode');

function frame_right_shortcode($atts, $content = null) {
	$output = '<figure class="frame featured-thumbnail fright"><span class="img-box">';
	$output .= do_shortcode($content);
	$output .= '</span></figure><!-- .frame (end) -->';
	return $output;
}
add_shortcode('frame_right', 'frame_right_shortcode');


// Button
function button_shortcode($atts, $content = null) {
	extract(shortcode_atts(
		array(
			'link' => 'http://www.google.com',
			'text' => 'Button Text',
			'size' => 'normal',
			'target' => '_self'
		), $atts));
	$output =  '<a href="'.$link.'" title="'.$text.'" class="button '.$size.'" target="'.$target.'">';
	$output .= $text;
	$output .= '</a><!-- .button (end) -->';
	return $output;
}
add_shortcode('button', 'button_shortcode');


// Map
function map_shortcode($atts, $content = null) {
	extract(shortcode_atts(
		array(
			'src' => '',
			'width' => '',
			'height' => ''
		), $atts));
	$output =  '<div class="google-map">';
	$output .= '<iframe src="'.$src.'" frameborder="0" width="'.$width.'" height="'.$height.'" marginwidth="0" marginheight="0" scrolling="no">';
	$output .= '</iframe>';
	$output .= '</div>';
	return $output;
}
add_shortcode('map', 'map_shortcode');


// Dropcaps
function dropcap_shortcode($atts, $content = null) {
	extract(shortcode_atts(
		array(
			'character' => '',
			'background' => '#f9b34e'
		), $atts));

	$output = '<div class="dropcap-container clearfix">';
	$output .= '<span class="dropcap" style="background-color:' . $background . '">' . $character . '</span>';
	$output .= '<div class="extra-wrap">';
	$output .= do_shortcode($content);
	$output .= '</div></div><!-- .dropcap (end) -->';
	return $output;
}
add_shortcode('dropcap', 'dropcap_shortcode');


// Horizontal Rule
function hr_shortcode($atts, $content = null) {
	$output = '<div class="hr"><!-- --></div>';
	return $output;
}
add_shortcode('hr', 'hr_shortcode');


// Small Horizontal Rule
function sm_hr_shortcode($atts, $content = null) {
	$output = '<div class="sm_hr"></div>';
	return $output;
}
add_shortcode('sm_hr', 'sm_hr_shortcode');


// Spacer
function spacer_shortcode($atts, $content = null) {
	$output = '<div class="spacer"><!-- --></div>';
	return $output;
}
add_shortcode('spacer', 'spacer_shortcode');


// Blockquote
function blockquote_shortcode($atts, $content = null) {
	$output = '<blockquote>';
	$output .= do_shortcode($content);
	$output .= '</blockquote><!-- blockquote (end) -->';
	return $output;
}
add_shortcode('blockquote', 'blockquote_shortcode');


// Clear
function shortcode_clear() {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'shortcode_clear');


// Timeline
function timeline_shortcode($atts, $content = null) {
	$content = remove_invalid_tags($content, array('p'));
	$timelineContent = do_shortcode($content);
	
	$output = '<ul class="timeline rlist">';
	$find = array();
	$replace = array();
	$find[] = '<br />';
	$find[] = '[event]';
	$find[] = '[/event]';
	$find[] = '[date]';
	$find[] = '[/date]';
	$replace[] = '';
	$replace[] = '<li>';
	$replace[] = '</div></li>';
	$replace[] = '<div class="date">';
	$replace[] = '</div><div class="extra-wrap">';
	$timelineContent = str_replace($find, $replace, $timelineContent);
	$output .= $timelineContent;
	$output .= '</ul><!-- box (end) -->';
	return $output;
}
add_shortcode('timeline', 'timeline_shortcode');

// Indent left
function indent_left_shortcode($atts, $content = null) {
	$output = '<div class="indent-left">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('indent_left', 'indent_left_shortcode');



// Box
function box_shortcode($atts, $content = null) {
	$content = remove_invalid_tags($content, array('p'));
	$boxContent = do_shortcode($content);
	
	$output = '<div class="box clearfix">';
	$find = array();
	$replace = array();
	$find[] = '<br />';
	$find[] = '[img]';
	$find[] = '[/img]';
	$find[] = '[text]';
	$find[] = '[/text]';
	$replace[] = '';
	$replace[] = '<figure class="featured-thumbnail fleft">';
	$replace[] = '</figure>';
	$replace[] = '<div class="extra-wrap">';
	$replace[] = '</div>';
	$boxContent = str_replace($find, $replace, $boxContent);
	$output .= $boxContent;
	$output .= '</div><!-- box (end) -->';
	return $output;
}
add_shortcode('box', 'box_shortcode');


?>