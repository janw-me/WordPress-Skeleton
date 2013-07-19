<article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
	<?php $url =  get_post_meta(get_the_ID(), 'tz_link_url', true); ?>
	<?php $post_meta = of_get_option('post_meta');
	if ($post_meta=='true' || $post_meta=='') $class=' post-meta-true';
	else $class =''; ?>
	<header class="entry-header<?php echo $class; ?>">
		<h6 class="entry-title">
			<a target="_blank" href="<?php echo $url; ?>" title="<?php _e('Permalink to:', 'framework');?> <?php echo $url; ?>"><span><?php the_title(); ?></span></a>
		</h6>
		<?php get_template_part('includes/post-formats/post-meta'); ?>
	</header>

	<div class="content">
		<?php the_content(''); ?>
	</div> <!--// .content -->
</article> <!--//.post-holder-->  