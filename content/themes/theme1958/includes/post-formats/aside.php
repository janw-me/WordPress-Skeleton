<article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
	<?php $post_meta = of_get_option('post_meta');
	if ($post_meta=='true' || $post_meta=='') $class=' post-meta-true';
	else $class =''; ?>
	<header class="entry-header<?php echo $class; ?>">
		<?php get_template_part('includes/post-formats/post-meta'); ?>
	</header>
		
	<div class="entry-content">
		<?php the_content('<span>Continue Reading</span>'); ?>
	</div> <!--END .entry-content -->
</article> <!--END .hentry-->