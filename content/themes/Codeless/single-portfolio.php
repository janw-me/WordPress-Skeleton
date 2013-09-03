<?php get_header(); ?>
	<div class="header-title">
		<h2>
			<?php 
			$post_terms = wp_get_post_terms($post->ID, 'portfolio_category');
			echo $post_terms[0]->name;
			?>
		</h2>
	</div>
	<div id="content" class="grid_9 right">
		<div class="page-header">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
		<?php // get the media elements
		$mediaType = get_post_meta($post->ID, 'tz_portfolio_type', true); ?>
	
		<div id="primary" class="hfeed <?php echo $mediaType; ?>">
			<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<?php if(has_post_thumbnail()): ?>
					<div class="clearfix">
						<div class="alpha omega">
							<?php switch( $mediaType ) {
								case "Image": ?>
									<figure class="image-holder featured-thumbnail <?php echo $mediaType; ?>"><span class="img-box"><?php the_post_thumbnail(array(614,594)); ?></span></figure>
									<?php break;
								case "Slideshow": ?>
									<figure class="image-holder featured-thumbnail <?php echo $mediaType; ?>"><span class="img-box"><?php tz_gallery($post->ID, 'portfolio-main');?></span></figure>
									<?php break;
								case "Grid Gallery":
									tz_grid_gallery($post->ID, 'portfolio-main');
									break;
								case "Video": ?>
									<figure class="image-holder featured-thumbnail <?php echo $mediaType; ?>"><span class="img-box"><?php $embed = get_post_meta($post->ID, 'tz_portfolio_embed_code', true);
									echo "<span class='video-holder'>";
									echo stripslashes(htmlspecialchars_decode($embed));
									echo "</span>";?></span></figure>
									<?php break;
								case "Audio":
									tz_audio($post->ID);
									break;
								default:
									break;
							} ?>
						</div>
					</div>
					<?php 
					endif; 
					$portfolioClient = get_post_meta($post->ID, 'tz_portfolio_client', true);
					$portfolioDate = get_post_meta($post->ID, 'tz_portfolio_date', true); 
					$portfolioInfo = get_post_meta($post->ID, 'tz_portfolio_info', true); 
					$portfolioURL = get_post_meta($post->ID, 'tz_portfolio_url', true); 
					if(!empty($portfolioClient) && !empty($portfolioDate) && !empty($portfolioInfo) && !empty($portfolioURL)):
					?>
					<div class="entry-content last">
						<div class="entry-meta">
							<?php // get the meta information and display if supplied
							

							if (!empty($portfolioClient) || !empty($portfolioDate) || !empty($portfolioInfo) || !empty($portfolioURL)){
								echo '<ul class="portfolio-meta-list rlist">';
							}

							if( !empty($portfolioClient) ) {
								echo '<li>';
								echo '<strong class="portfolio-meta-key">' . __('Client:', 'framework') . '</strong>';
								echo '<span>' . $portfolioClient . '</span>';
								echo '</li>';
							}

							if( !empty($portfolioDate) ) {
								echo '<li>';
								echo '<strong class="portfolio-meta-key">' . __('Date:', 'framework') . '</strong>';
								echo '<span>' . $portfolioDate . '</span>';
								echo '</li>';
							}
							
							if( !empty($portfolioInfo) ) {
								echo '<li>';
								echo '<strong class="portfolio-meta-key">' . __('Info:', 'framework') . '</strong>';
								echo '<span>' . $portfolioInfo . '</span>';
								echo '</li>';
							}

							if (!empty($portfolioClient) || !empty($portfolioDate) || !empty($portfolioInfo) || !empty($portfolioURL)){
								echo '</ul>';
							}
							
							if( !empty($portfolioURL) ) {
								echo "<a href='$portfolioURL'>" . __('Launch Project', 'framework') . "</a>";
							}
							?>
						</div> <!-- /entry-meta -->
						<?php endif; ?>
						<?php the_content(); ?>
					<!-- /entry-content -->
					<nav class="oldernewer single-oldernewer">
						<?php if( get_previous_post() ) : ?>
							<div class="older"><?php previous_post_link('%link', __('Previous', L10n)) ?></div>
						<?php endif; ?>
						<?php if( get_next_post() ) : ?>
							<div class="newer"><?php next_post_link('%link', __('Next', L10n)) ?></div>
							<?php endif; ?>
					</nav> <!-- /oldernewer .single-oldernewer -->
				</div>
			<?php endwhile; endif; ?>
		</div> <!--/primary .hfeed-->
	</div> <!--/content-->
	<?php get_template_part('categorie'); ?>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>