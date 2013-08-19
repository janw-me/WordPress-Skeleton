<?php get_header(); ?>
	<div class="header-title">
		<h2>
			<?php
				_e('Practical examples', L10n);
				echo ": ";
				$post_terms = wp_get_post_terms($post->ID, 'portfolio_category');
				echo $post_terms[0]->name;
			?>
		</h2>
	</div>
	<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
		<h2>
			
		</h2>
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
			// The following determines what the post format is and shows the correct file accordingly
			$format = get_post_format();
			get_template_part( 'includes/post-formats/'.$format );
			
			if($format == '')
			get_template_part( 'includes/post-formats/standard' );
		endwhile; else: ?>
			<div class="no-results">
				<p><strong><?php echo __('There has been an error.', L10n); ?></strong></p>
				<p><?php _e('We apologize for any inconvenience, please', L10n); ?> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', L10n); ?></a> <?php _e('or use the search form below.', 'theme1958'); ?></p>
				<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
			</div><!--no-results-->
		<?php endif;
		get_template_part('includes/post-formats/post-nav'); ?>
	</div><!--#content-->
	<?php get_template_part('categorie'); ?>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>