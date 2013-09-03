<!--BEGIN .hentry -->
<article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
	<?php $post_meta = of_get_option('post_meta');
	if ($post_meta=='true' || $post_meta=='') $class=' post-meta-true';
	else $class =''; ?>
	<header class="entry-header<?php echo $class; ?>">
		<?php if(!is_singular()) : ?>
			<h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'theme1958');?> <?php the_title(); ?>"><?php the_title(); ?></a></h6>
		<?php else :?>
			<h6 class="entry-title"><?php the_title(); ?></h6>
		<?php endif;
		
		get_template_part('includes/post-formats/post-meta'); ?>
	</header>
	
	<?php $random = theme1958_random(10); ?>

	<script type="text/javascript">
		jQuery(function(){
			jQuery('#gallery_post_<?php echo $random; ?>').slides({
				container: 'slides_container_gallery',
				effect: 'fade',
				crossfade: true,
				generateNextPrev: false
			});
			
		});
	</script>

	<div id="gallery_post_<?php echo $random ?>" class="gallery_post">
		<div class="slides_container_gallery">
			<?php $args = array(
				'orderby'		 => 'menu_order',
				'post_type'      => 'attachment',
				'post_parent'    => get_the_ID(),
				'post_mime_type' => 'image',
				'post_status'    => null,
				'numberposts'    => -1,
			);
			$attachments = get_posts($args);

			if ($attachments) : 
				foreach ($attachments as $attachment) : 
					$attachment_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
					$url = $attachment_url['0'];
					$image = aq_resize($url, 668, 403, true); ?>

					<div class="g_item">
						<img 
							alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"
							src="<?php echo $image ?>"
						>
					</div>
				<?php endforeach; 
			endif; ?>
		</div>
	</div> <!--END .slider -->

	<div class="entry-content">
		<?php the_content(''); ?>
	</div> <!--END .entry-content -->
</article> <!--END .hentry-->  