<article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
	<?php $post_meta = of_get_option('post_meta');
	if ($post_meta=='true' || $post_meta=='') $class=' post-meta-true';
	else $class =''; ?>
	<header class="entry-header<?php echo $class; ?>">
		<?php if(!is_singular()) : ?>
			<h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'theme1958');?> <?php the_title(); ?>"><?php the_title(); ?></a></h6>
		<?php else :?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif;
		//get_template_part('includes/post-formats/post-meta'); ?>
	</header>
	
	<div class="clearfix">
		<?php get_template_part('includes/post-formats/post-thumb'); 
		
		if(!is_singular()) : ?>
			<div class="post-content extra-wrap">
				<?php $post_excerpt = of_get_option('post_excerpt');
				if ($post_excerpt=='true' || $post_excerpt=='') { ?>
					<div class="excerpt">
						<?php
						$excerpt = get_the_excerpt();
	
						if (has_excerpt()) {
							the_excerpt();
						} else {
							echo my_string_limit_words($excerpt,80);
						} ?>
					</div>
				<?php } ?>
				<?php
				$content = get_the_content();
				echo '<p>' . my_string_limit_words($content,80) . '</p>';
				?>
				<a href="<?php the_permalink() ?>" class="read-more"><?php _e('Read more', 'theme1958'); ?></a>
			</div>
		<?php else :?>
			<div class="content">
				<?php the_content(''); ?>
			</div> <!--// .content -->
			<footer class="post-footer">
				<?php the_tags('Tags: ', ' ', ''); ?>
			</footer>
		<?php endif; ?>
	</div>
</article>