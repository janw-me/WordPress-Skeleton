<?php
// =============================== My Social Networks Widget ====================================== //
class My_SocialNetworksWidget extends WP_Widget {

	function My_SocialNetworksWidget() {
		$widget_ops = array('classname' => 'social_networks_widget', 'description' => __('Link to your social networks.'));
		$this->WP_Widget('social_networks', __('My - Social Networks'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$networks['Technorati']['link'] = $instance['technorati'];
		$networks['Facebook']['link'] = $instance['facebook'];
		$networks['Twitter']['link'] = $instance['twitter'];
		$networks['Flickr']['link'] = $instance['flickr'];
		$networks['Tumblr']['link'] = $instance['tumblr'];
		$networks['Feed']['link'] = $instance['feed'];
		
		
		$networks['Technorati']['label'] = $instance['technorati_label'];
		$networks['Facebook']['label'] = $instance['facebook_label'];
		$networks['Twitter']['label'] = $instance['twitter_label'];
		$networks['Flickr']['label'] = $instance['flickr_label'];
		$networks['Tumblr']['label'] = $instance['tumblr_label'];
		$networks['Feed']['label'] = $instance['feed_label'];


		$display = $instance['display'];

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		
		$class='';
		if ($display =="icons") $class= ' icons';
		if ($display == "labels") $class= ' labels'; ?>
		
		<ul class="social-networks clearfix rlist<?php echo $class;?>">
			<?php foreach(array("Technorati", "Facebook", "Twitter", "Flickr", "Tumblr", "Feed") as $network) :
				if (!empty($networks[$network]['link'])) : ?>
					<li>
						<a rel="external" title="<?php echo strtolower($network); ?>" href="<?php echo $networks[$network]['link']; ?>" class="<?php echo strtolower($network);?>">
							<?php if (($display == "labels") or ($display == "both")) {
								if (($networks[$network]['label'])!=="") { echo $networks[$network]['label']; }
								else { echo $network; }
							} ?>
						</a>
					</li>
				<?php endif;
			endforeach; ?>
		</ul>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['technorati'] = $new_instance['technorati'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['tumblr'] = $new_instance['tumblr'];
		$instance['feed'] = $new_instance['feed'];
		
		
		$instance['technorati_label'] = $new_instance['technorati_label'];
		$instance['facebook_label'] = $new_instance['facebook_label'];
		$instance['twitter_label'] = $new_instance['twitter_label'];
		$instance['flickr_label'] = $new_instance['flickr_label'];
		$instance['tumblr_label'] = $new_instance['tumblr_label'];
		$instance['feed_label'] = $new_instance['feed_label'];


		$instance['display'] = $new_instance['display'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		
		$technorati = $instance['technorati'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$flickr = $instance['flickr'];
		$tumblr = $instance['tumblr'];
		$feed = $instance['feed'];
		
		
		$technorati_label = $instance['technorati_label'];
		$facebook_label = $instance['facebook_label'];
		$twitter_label = $instance['twitter_label'];
		$flickr_label = $instance['flickr_label'];
		$tumblr_label = $instance['tumblr_label'];
		$feed_label = $instance['feed_label'];
		
		$display = $instance['display'];

		$text = format_to_edit($instance['text']); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>

		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Technorati'); ?>:</legend>
			<p>
				<label for="<?php echo $this->get_field_id('technorati'); ?>"><?php _e('Technorati URL:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('technorati'); ?>" name="<?php echo $this->get_field_name('technorati'); ?>" type="text" value="<?php echo esc_attr($technorati); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('technorati_label'); ?>"><?php _e('Technorati label:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('technorati_label'); ?>" name="<?php echo $this->get_field_name('technorati_label'); ?>" type="text" value="<?php echo esc_attr($technorati_label); ?>">
			</p>
		</fieldset>
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Facebook'); ?>:</legend>
			<p>
				<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('facebook_label'); ?>"><?php _e('Facebook label:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('facebook_label'); ?>" name="<?php echo $this->get_field_name('facebook_label'); ?>" type="text" value="<?php echo esc_attr($facebook_label); ?>">
			</p>
		</fieldset>

		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Twitter'); ?>:</legend>	
			<p>
				<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('twitter_label'); ?>"><?php _e('Twitter label:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" name="<?php echo $this->get_field_name('twitter_label'); ?>" type="text" value="<?php echo esc_attr($twitter_label); ?>">
			</p>
		</fieldset>	
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Flickr'); ?>:</legend>
			<p>
				<label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo esc_attr($flickr); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('flickr_label'); ?>"><?php _e('Flickr label:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('flickr_label'); ?>" name="<?php echo $this->get_field_name('flickr_label'); ?>" type="text" value="<?php echo esc_attr($flickr_label); ?>">
			</p>
		</fieldset>
		
		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('Tumblr'); ?>:</legend>
			<p>
				<label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('tumblr_label'); ?>"><?php _e('Tumblr label:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('tumblr_label'); ?>" name="<?php echo $this->get_field_name('tumblr_label'); ?>" type="text" value="<?php echo esc_attr($tumblr_label); ?>">
			</p>
		</fieldset>

		<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php _e('RSS feed'); ?>:</legend>
			<p>
				<label for="<?php echo $this->get_field_id('feed'); ?>"><?php _e('RSS feed:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('feed'); ?>" name="<?php echo $this->get_field_name('feed'); ?>" type="text" value="<?php echo esc_attr($feed); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('feed_label'); ?>"><?php _e('RSS label:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('feed_label'); ?>" name="<?php echo $this->get_field_name('feed_label'); ?>" type="text" value="<?php echo esc_attr($feed_label); ?>">
			</p>
		</fieldset>

		<p>Display:</p>
		<label for="<?php echo $this->get_field_id('icons'); ?>">
			<input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="icons" id="<?php echo $this->get_field_id('icons'); ?>" <?php checked($display, "icons"); ?>></input> Icons</label>
		<label for="<?php echo $this->get_field_id('labels'); ?>">
			<input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="labels" id="<?php echo $this->get_field_id('labels'); ?>" <?php checked($display, "labels"); ?>></input> Labels
		</label>
		<label for="<?php echo $this->get_field_id('both'); ?>">
			<input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="both" id="<?php echo $this->get_field_id('both'); ?>" <?php checked($display, "both"); ?>></input> Both
		</label>
	<?php }
}
add_action('widgets_init', create_function('', 'return register_widget("My_SocialNetworksWidget");')); ?>