<?php
/**
 * Template Name: Fullwidth Page
 */ ?>

<?php get_header(); ?>
			<div id="content">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
						<?php if(has_post_thumbnail()) { ?>
							<figure class="featured-thumbnail">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							</figure>
						<?php }
						
						the_content(); ?>
						
						<div class="pagination">
							<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
						</div><!--.pagination-->
					</div><!-- / post-# .post-->
				<?php endwhile; ?>
			</div><!-- /content-->
<?php get_footer(); ?>
