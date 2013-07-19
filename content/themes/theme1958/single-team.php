<?php get_header(); ?>
			<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post();
					$custom = get_post_custom($post->ID);
					$teampos = $custom["my_team_pos"][0];
					$teaminfo = $custom["my_team_info"][0];
					?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
						<article class="single-post">
							<div class="header-title">
								<h2><?php the_title(); ?></h2>
								<?php if($teampos) { ?>
									<div class="page-desc"><?php echo $teampos; ?></div>
								<?php } ?>
							</div>
							<?php if(has_post_thumbnail()) {
								$thumb = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url( $thumb,'thumbnail'); //get img URL
								$image = aq_resize( $img_url, 208, 243, true ); //resize & crop img
								?>
								<figure class="featured-thumbnail fleft">
									<span class="img-box"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>"></span>
								</figure>
							<?php } ?>
							<div class="post-content">
								<?php the_content(); ?>
								<div class="page-desc"><?php echo $teaminfo; ?></div>
							</div><!--.post-content-->
						</article>
					</div><!-- #post-## -->
				<?php endwhile; /* end loop */ ?>
			</div><!--/content-->
			<?php get_sidebar(); ?>
<?php get_footer(); ?>