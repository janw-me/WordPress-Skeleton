<?php if(has_post_thumbnail()) { ?>
	<figure class="featured-thumbnail fleft">
		<span class="img-box"><?php the_post_thumbnail('medium-overview'); ?></span>
	</figure>
<?php }