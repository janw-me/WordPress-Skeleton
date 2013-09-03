<?php get_header(); ?>
			<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
						<article class="post-holder">
							<h2><?php the_title(); ?></h2>
							<?php if(has_post_thumbnail()) {?>
								<figure class="featured-thumbnail">
									<a href="<?php the_permalink();?>">the_post_thumbnail();</a>
								</figure>
							<?php } ?>
							<div id="page-content">
								<?php the_content(); ?>
								<div class="pagination">
									<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
								</div><!--/pagination-->
							</div><!--/pageContent -->
						</article>
					</div><!--/post-# .post-->
				<?php endwhile; ?>
			</div><!--#content-->
			<?php get_sidebar(); ?>
<?php get_footer(); ?>
