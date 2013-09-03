<?php
/**
 * Template Name: Archives
 */
?>

<?php get_header(); ?>
			<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<div class="post-content">
							<?php the_content('<span>Continue Reading</span>');
							wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'theme1958').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

							<div class="archive-lists">
								<h4><?php _e('Last 30 Posts', 'theme1958') ?></h4>
								<ul>
									<?php $archive_30 = get_posts('numberposts=30');
									foreach($archive_30 as $post) : ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
									<?php endforeach; ?>
								</ul>

								<h4><?php _e('Archives by Month:', 'theme1958') ?></h4>
								<ul>
									<?php wp_get_archives('type=monthly'); ?>
								</ul>

								<h4><?php _e('Archives by Subject:', 'theme1958') ?></h4>
								<ul>
									<?php wp_list_categories( 'title_li=' ); ?>
								</ul>
							</div><!-- /archive-lists -->
						</div> <!-- /post-content -->
					</div>
				<?php endwhile; endif; ?>
			</div><!--/content-->
			<?php get_sidebar(); ?>
<?php get_footer(); ?>