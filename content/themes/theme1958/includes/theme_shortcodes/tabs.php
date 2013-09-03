<?php
/**
 * Tabs
 *
 */

function tabs_shortcode($atts, $content = null) {
	$output = '<div class="tabs">';
	$output .= '<div class="tab-menu">';
	$output .= '<ul class="rlist">';

	//Create unique ID for this tab set
	$id = rand();

	//Build tab menu
	$numTabs = count($atts);

	for($i = 1; $i <= $numTabs; $i++){
		$output .= '<li><a href="#tab-'.$id.'-'.$i.'">'.$atts['tab'.$i].'</a></li>';
	}

	$output .= '</ul>';
	$output .= '<div class="clear"></div>';
	$output .= '</div><!-- .tab-menu (end) -->';
	$output .= '<div class="tab-wrapper">';

	//Build content of tabs
	$i = 1;
	$tabContent = do_shortcode($content);
	$find = array();
	$replace = array();
	
	foreach($atts as $key => $value){
		$find[] = '['.$key.']';
		$find[] = '[/'.$key.']';
		$replace[] = '<div id="tab-'.$id.'-'.$i.'" class="tab">';
		$replace[] = '</div><!-- .tab (end) -->';
			$i++;
	}
	
	$tabContent = str_replace($find, $replace, $tabContent);
	$output .= $tabContent;
	$output .= '</div><!-- .tab-wrapper (end) -->';
	$output .= '</div><!-- .tabs (end) -->';
	return $output;
}
add_shortcode('tabs', 'tabs_shortcode');
?>