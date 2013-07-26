<?php get_header(); ?>
	<div class="header-title">
		<h2>Praktijkvoorbeelden</h2>
	</div>
	<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
		<h2>
			<?php if ( is_day() ) : /* if the daily archive is loaded */ 
				printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() );
			elseif ( is_month() ) : /* if the montly archive is loaded */
				printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') );
			elseif ( is_year() ) : /* if the yearly archive is loaded */
				printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') ); 
			else : /* if anything else is loaded, ex. if the tags or categories template is missing this page will load */
				_e('Blog Archives', 'theme1958');
			endif; ?>
		</h2>
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
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
	</div><!--#content-->
	<?php get_template_part('categorie'); ?>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>