<article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
	<?php $post_meta = of_get_option('post_meta');
	if ($post_meta=='true' || $post_meta=='') $class=' post-meta-true';
	else $class =''; ?>
	<header class="entry-header<?php echo $class; ?>">
		<?php if(is_singular()) : ?>
			<h6 class="entry-title"><?php the_title(); ?></h6>
		<?php endif; 
		get_template_part('includes/post-formats/post-meta'); ?>
	</header>
	
	<?php $quote =  get_post_meta(get_the_ID(), 'tz_quote', true); ?>
	<div class="quote-wrap clearfix">
		<blockquote>
			<?php echo $quote; ?>
		</blockquote>
	</div>
	<div class="post-content">
		<?php the_content(''); ?>
	</div> <!--// .post-content -->
	<?php get_template_part('includes/post-meta'); ?>
</article> <!--//.post-holder-->  