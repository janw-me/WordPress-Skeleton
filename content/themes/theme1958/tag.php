<?php get_header(); ?>
			<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<h2><?php printf( __( 'Tag Archives: %s' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h2>
				<!-- displays the tag's description from the Wordpress admin -->
				<?php echo tag_description(); 
				
				if (have_posts()) : while (have_posts()) : the_post(); 
		
					// The following determines what the post format is and shows the correct file accordingly
					$format = get_post_format();
					get_template_part( 'includes/post-formats/'.$format );
				
					if($format == '')
					get_template_part( 'includes/post-formats/standard' );
				
				endwhile; else: ?>
					<div class="no-results">
						<p><strong><?php echo __('There has been an error.', 'theme1958'); ?></strong></p>
						<p><?php _e('We apologize for any inconvenience, please', 'theme1958'); ?> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'theme1958'); ?></a> <?php _e('or use the search form below.', 'theme1958'); ?></p>
						<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
					</div><!--no-results-->
				<?php endif;
				get_template_part('includes/post-formats/post-nav'); ?>
			</div><!--/content-->
			<?php get_sidebar(); ?>
<?php get_footer(); ?>