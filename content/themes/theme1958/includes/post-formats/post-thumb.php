<?php if(!is_singular()) : 
	$post_image_size = of_get_option('post_image_size');
	if($post_image_size=='' || $post_image_size=='normal'){
		if(has_post_thumbnail()) { ?>
			<figure class="featured-thumbnail fleft">
				<span class="img-box"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></span>
			</figure>
		<?php } 
	} else {
		if(has_post_thumbnail()) {
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$image = aq_resize( $img_url, 668, 403, true ); //resize & crop img ?>
			<figure class="featured-thumbnail large">
				<span class="img-box"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>"></a></span>
			</figure>
			<div class="clear"></div>
		<?php }
	}
else :
	$single_image_size = of_get_option('single_image_size');
	if($single_image_size=='' || $single_image_size=='normal'){
		if(has_post_thumbnail()) { ?>
			<figure class="featured-thumbnail fleft">
				<span class="img-box"><?php the_post_thumbnail(); ?></span>
			</figure>
		<?php }
	} else {
		if(has_post_thumbnail()) {
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$image = aq_resize( $img_url, 668, 403, true ); //resize & crop img ?>
			<figure class="featured-thumbnail large">
				<span class="img-box"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>"></span>
			</figure>
			<div class="clear"></div>
		<?php } 
	}
endif; ?>