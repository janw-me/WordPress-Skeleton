<?php
/*
  Plugin Name: WordPress Slider add Button
  Description: A simple slider plugin
  Version: 0.1
  Author: Marissen
 */
class sab
{
	function __construct(){
		add_action('media_buttons', array($this, 'add_slider_button'), 20);
		add_action('admin_footer',  array($this, 'add_mce_popup'));
	}
	
	public static function add_slider_button(){
	    $is_post_edit_page = in_array(RG_CURRENT_PAGE, array('post.php', 'page.php', 'page-new.php', 'post-new.php'));
	    if(!$is_post_edit_page)
	        return;
	
	    // do a version check for the new 3.5 UI
	    $version    = get_bloginfo('version');
	
	    if ($version < 3.5) {
	        // show button for v 3.4 and below
	        $image_btn = GFCommon::get_base_url() . "/images/slider-button.png";
	        echo '<a href="#TB_inline?width=480&inlineId=select_gravity_slider" class="thickbox" id="add_gslider" title="' . __("Add slider", 'gravitysliders') . '"><img src="'.$image_btn.'" alt="' . __("Add slider", 'gravitysliders') . '" /></a>';
	    } else {
	        // display button matching new UI
	        echo '<style>.gslider_media_icon{
	                background:url(' . GFCommon::get_base_url() . '/images/gravity-admin-icon.png) no-repeat top left;
	                display: inline-block;
	                height: 16px;
	                margin: 0 2px 0 0;
	                vertical-align: text-top;
	                width: 16px;
	                }
	                .wp-core-ui a.gslider_media_link{
	                 padding-left: 0.4em;
	                }
	             </style>
	              <a href="#TB_inline?width=480&inlineId=select_gravity_slider" class="thickbox button gslider_media_link" id="add_gslider" title="' . __("Add slider", 'gravitysliders') . '"><span class="gslider_media_icon "></span> ' . __("Add slider", "gravitysliders") . '</a>';
	    }
	}
	
	//Action target that displays the popup to insert a slider to a post/page
	public static function add_mce_popup(){
	    ?>
	    <script>
	        function Insertslider(){
	            var slider_id = jQuery("#add_slider_id").val();
	            if(slider_id == ""){
	                alert("<?php _e("Please select a slider", "gravitysliders") ?>");
	                return;
	            }
	
	            var slider_name = jQuery("#add_slider_id option[value='" + slider_id + "']").text().replace(/[\[\]]/g, '');
	            var display_title = jQuery("#display_title").is(":checked");
	            var display_description = jQuery("#display_description").is(":checked");
	            var ajax = jQuery("#gslider_ajax").is(":checked");
	            var title_qs = !display_title ? " title=\"false\"" : "";
	            var description_qs = !display_description ? " description=\"false\"" : "";
	            var ajax_qs = ajax ? " ajax=\"true\"" : "";
	
	            window.send_to_editor("[slider slug=\"" + slider_id + "\"]");
	        }
	    </script>
	
	    <div id="select_gravity_slider" style="display:none;">
	        <div class="wrap">
	            <div>
	                <div style="padding:15px 15px 0 15px;">
	                    <h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;"><?php _e("Insert A slider", "gravitysliders"); ?></h3>
	                    <span>
	                        <?php _e("Select a slider below to add it to your post or page.", "gravitysliders"); ?>
	                    </span>
	                </div>
	                <div style="padding:15px 15px 0 15px;">
	                	<?php
							$taxonomy = 'collection';
							$tax_terms = get_terms($taxonomy);
						?>
						<select id="add_slider_id">
							<option value="">  <?php _e("Select a slider", "gravitysliders"); ?>  </option>
							<?php
								foreach ($tax_terms as $tax_term) {
									?>
									<option value="<?php echo esc_html($tax_term->slug) ?>"><?php echo esc_html($tax_term->name) ?></option>
									<?php
								}
							?>
						</select><br/>
	                    <div style="padding:8px 0 0 0; font-size:11px; font-style:italic; color:#5A5A5A"><?php _e("Can't find your slider? Make sure it is active.", "gravitysliders"); ?></div>
	                </div>
	                <div style="padding:15px;">
	                    <input type="button" class="button-primary" value="Insert slider" onclick="Insertslider();"/>&nbsp;&nbsp;&nbsp;
	                <a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;"><?php _e("Cancel", "gravitysliders"); ?></a>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php
	}
}

new sab();

function slider_func( $atts ) {
	extract( shortcode_atts( array(
		'slug' => '',
	), $atts ) );
	if($slug == ""){
		return false;
	}
	return get_the_flexslider_box(null, $slug, false);
}
add_shortcode( 'slider', 'slider_func' );
