<?php get_header(); ?>
			<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="indent-right">
					<?php if (have_posts()) : while (have_posts()) : the_post(); 
						// The following determines what the post format is and shows the correct file accordingly
						$format = get_post_format();
						get_template_part( 'includes/post-formats/'.$format );
						
						if($format == '') get_template_part( 'includes/post-formats/standard' ); 
						
						get_template_part( 'includes/post-formats/related-posts' );
						
						comments_template('', true);
					endwhile; endif; ?>
				</div>
			</div><!--#content-->
			<?php get_sidebar(); ?>
<?php get_footer(); ?>