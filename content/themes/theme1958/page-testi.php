<?php
/**
 * Template Name: Testimonials
 */?>

<?php get_header(); ?>
			<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h2><?php the_title(); ?></h2>
					<div id="page-content"><?php the_content(); ?></div>
				<?php endwhile; endif;
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('post_type=testi&showposts=4&paged='.$paged);

				if (have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); 
					$custom = get_post_custom($post->ID);
					$testiname = $custom["my_testi_caption"][0];
					$testiurl = $custom["my_testi_url"][0];
					$testiinfo = $custom["my_testi_info"][0];
					?>
					
					<article id="post-<?php the_ID(); ?>" class="testimonial post-holder">
						<div class="post-content">
							<blockquote>
								<?php if(has_post_thumbnail()) {
									$thumb = get_post_thumbnail_id();
									$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
									$image = aq_resize( $img_url, 120, 120, true ); //resize & crop img
									?>
									<figure class="featured-thumbnail fleft">
										<span class="img-box"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>"></span>
									</figure>
								<?php }?>
								<div><?php the_content(); ?></div>
							</blockquote>
							<div class="name-testi">
								<?php if($testiname) { ?>
									<span class="user"><?php echo $testiname; ?></span>
								<?php }
								if($testiinfo) { ?>
									<span class="info"><?php echo $testiinfo; ?></span>
								<?php }
								if($testiurl) { ?>
									<a href="<?php echo $testiurl; ?>"><?php echo $testiurl; ?></a>
								<?php } ?>
							</div>
						</div>
					</article>
				<?php endwhile; else: ?>
					<div class="no-results">
						<p><strong><?php echo __('There has been an error.', 'theme1958'); ?></strong></p>
						<p><?php _e('We apologize for any inconvenience, please', 'theme1958'); ?> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'theme1958'); ?></a> <?php _e('or use the search form below.', 'theme1958'); ?></p>
						<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
					</div><!-- /no-results-->
				<?php endif;
				
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav class="oldernewer">
						<div class="older">
							<?php next_posts_link( __('&laquo; Older Testimonials', 'theme1958')) ?>
						</div>
						<div class="newer">
							<?php previous_posts_link(__('Newer Testimonials &raquo;', 'theme1958')) ?>
						</div>
					</nav><!--/oldernewer-->
				<?php endif; 
				
				$wp_query = null; $wp_query = $temp;?>
			</div>
			<?php get_sidebar(); ?>
<?php get_footer(); ?>