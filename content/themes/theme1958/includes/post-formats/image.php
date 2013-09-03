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
	<?php if (has_post_thumbnail() ):
		$lightbox = get_post_meta(get_the_ID(), 'tz_image_lightbox', TRUE); 

		if($lightbox == 'yes') {$lightbox = TRUE;}
		else {$lightbox = FALSE;}

		$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' );  ?>

		<div class="post-thumb clearfix">
			<?php $thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$image = aq_resize( $img_url, 668, 403, true ); //resize & crop img

			if($lightbox) : ?>
				<figure class="image-post-format">
					<a class="image-wrap" rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php echo $src[0]; ?>">
						<img src="<?php echo $image ?>" alt="<?php the_title(); ?>">
						<span class="zoom-icon"></span>
					</a>
				</figure>
				<div class="clear"></div>
				<span class="overlay">
					<span class="arrow"></span>
				</span>
			<?php else: ?>
				<figure class="image-post-format">
					<img src="<?php echo $image ?>" alt="<?php the_title(); ?>">
				</figure>
				<div class="clear"></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	
	<div class="entry-content">
		<?php the_content(''); ?>
	</div> <!--END .entry-content -->
</article> <!--// .post-holder-->  