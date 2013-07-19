<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('.flexslider').flexslider({
			animation: "<?php echo of_get_option('sl_effect'); ?>",					//String: Select your animation type, "fade" or "slide"
			slideDirection: "<?php echo of_get_option('sl_direction_type'); ?>",	//String: Select the sliding direction, "horizontal" or "vertical"
			slideshow: <?php echo of_get_option('sl_slideshow'); ?>,				//Boolean: Animate slider automatically
			slideshowSpeed: <?php echo of_get_option('sl_pausetime'); ?>,			//Integer: Set the speed of the slideshow cycling, in milliseconds
			animationDuration: <?php echo of_get_option('sl_animation_speed'); ?>,	//Integer: Set the speed of animations, in milliseconds
			directionNav: <?php echo of_get_option('sl_dir_nav'); ?>,				//Boolean: Create navigation for previous/next navigation? (true/false)
			controlNav: <?php echo of_get_option('sl_control_nav'); ?>,				//Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			keyboardNav: <?php echo of_get_option('sl_keyboard'); ?>,				//Boolean: Allow slider navigating via keyboard left/right keys
			mousewheel: <?php echo of_get_option('sl_mousewheel'); ?>,				//Boolean: Allow slider navigating via mousewheel
			prevText: "Previous",													//String: Set the text for the "previous" directionNav item
			nextText: "Next",														//String: Set the text for the "next" directionNav item
			pausePlay: false,														//Boolean: Create pause/play dynamic element
			pauseText: 'Pause',														//String: Set the text for the "pause" pausePlay item
			playText: 'Play',														//String: Set the text for the "play" pausePlay item
			randomize: <?php echo of_get_option('sl_randomize'); ?>,				//Boolean: Randomize slide order
			slideToStart: 0,														//Integer: The slide that the slider should start on. Array notation (0 = first slide)
			animationLoop: true,													//Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
			pauseOnAction: true,													//Boolean: Pause the slideshow when interacting with control elements, highly recommended.
			pauseOnHover: false,													//Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
			controlsContainer: ".flexslider-container",								//Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
			start: function(){},													//Callback: function(slider) - Fires when the slider loads the first slide
			before: function(){},													//Callback: function(slider) - Fires asynchronously with each slider animation
			after: function(){},													//Callback: function(slider) - Fires after each slider animation completes
			end: function(){}														//Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
		});
	});
</script>

<div class="flexslider-holder">
	<div class="flexslider-container">
		<div class="flexslider">
			<ul class="slides rlist">
				<?php query_posts("post_type=slider&posts_per_page=-1&post_status=publish&order=ASC&orderby=menu_order");
				while ( have_posts() ) : the_post();
					$custom = get_post_custom($post->ID);
					$url = get_post_custom_values("my_slider_url");
					$caption = get_post_custom_values("my_slider_caption");
					$sl_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider-post-thumbnail');
			
					if(has_post_thumbnail( $the_ID)){
						echo "<li>";
						if($url!=""){
							echo "<a href='" . $url[0] . "'>";
							echo "<img src='";
							echo $sl_image_url[0];
							echo "' alt=''></a>";
							if($caption[0]) {
								echo "<div class='flex-caption'>";
									echo stripslashes(htmlspecialchars_decode($caption[0])); 
								echo "</div>";
							}
						}else{
							echo "<img src='";
							echo $sl_image_url[0];
							echo "' alt=''>";
							if($caption[0]) {
								echo "<div class='flex-caption'>";
									echo stripslashes(htmlspecialchars_decode($caption[0]));
								echo "</div>";
							}
						}
						echo "</li>";
					}
				endwhile; ?>
			</ul>
			<?php wp_reset_query();?>
		</div>
	</div>
</div>