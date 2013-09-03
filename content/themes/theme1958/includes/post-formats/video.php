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
	<?php $embed = get_post_meta(get_the_ID(), 'tz_video_embed', TRUE); ?>
	
	<div class="video"><?php echo stripslashes(htmlspecialchars_decode($embed)); ?></div>
	<div class="entry-content">
		<?php the_content(''); ?>
	</div> <!--END .entry-content -->
</article> <!--END .hentry-->