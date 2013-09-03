<?php
/**
 * Template Name: Portfolio 2 columns
 */ ?>

<?php get_header(); ?>
			<div id="content" class="grid_12">
				<?php include_once (TEMPLATEPATH . '/title.php');
				global $more;
				$more = 0;
				$values = get_post_custom_values("category-include");
				$cat=$values[0];
				$catinclude = 'portfolio_category='. $cat ;
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query("post_type=portfolio&". $catinclude ."&paged=".$paged.'&showposts=8');
				
				if ( ! have_posts() ) : ?>
					<div id="post-0" class="post error404 not-found">
						<h2 class="entry-title"><?php _e( 'Not Found', 'theme1958' ); ?></h2>
						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'theme1958' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- /entry-content -->
					</div><!-- /post-0 -->
				<?php endif; ?>
				<div id="gallery" class="two_columns">
					<ul class="portfolio clearfix rlist">
						<?php $i=1;
						if ( have_posts() ) while ( have_posts() ) : the_post(); 
							if(($i%2) == 0){ $addclass = "nomargin";}
							
							$custom = get_post_custom($post->ID);
							$lightbox = $custom["lightbox-url"][0];
							?>
							<li class="<?php echo $addclass; ?>">
								<?php $thumb = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
								$image = aq_resize( $img_url, 448, 288, true ); //resize & crop img
			
								//mediaType init
								$mediaType = get_post_meta($post->ID, 'tz_portfolio_type', true);
								
								//check thumb and media type
								if(has_post_thumbnail($post->ID) && $mediaType != 'Video' && $mediaType != 'Audio' && ( of_get_option('g_gallery_lightbox_id') == 'no')){ ?>
									<figure class="featured-thumbnail">
										<span class="img-box">
											<a class="image-wrap touch-item" href="<?php echo $img_url;?>" title="<?php the_title();?>">
												<img src="<?php echo $image ?>" alt="<?php the_title(); ?>">
												<span class="zoom-icon"></span>
											</a>
										</span>
									</figure>

									<?php $thumbid = 0;
									$thumbid = get_post_thumbnail_id($post->ID);
				
									$images = get_children( array(
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'post_type' => 'attachment',
										'post_parent' => $post->ID,
										'post_mime_type' => 'image',
										'post_status' => null,
										'numberposts' => -1
									));

									/* $images is now a object that contains all images (related to post id 1) and their information ordered like the gallery interface. */
									if ( $images ) { 
										//looping through the images
										foreach ( $images as $attachment_id => $attachment ) {
											if( $attachment->ID == $thumbid ) continue;
											$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
											$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
											$image_title = $attachment->post_title;
											?>
											<a class="touch-item" href="<?php echo $image_attributes[0]; ?>" title="<?php the_title(); ?>" alt="<?php echo $alt; ?>" style="display:none;">
												<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo $alt; ?>">
											</a>
										<?php }
									}
								} else { ?>
									<figure class="featured-thumbnail">
										<span class="img-box">
											<a class="image-wrap" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
												<img src="<?php echo $image ?>" alt="<?php the_title(); ?>">
											</a>
										</span>
									</figure>
								<?php } ?>

								<div class="folio-desc">
									<h6><a href="<?php the_permalink(); ?>"><?php $title = the_title('','',FALSE); echo substr($title, 0, 40); ?></a></h6>
									<div class="excerpt"><?php $excerpt = get_the_excerpt(); echo my_string_limit_words($excerpt,28);?></div>
								</div>
							</li>
							<?php $i++;
							$addclass = "";
						endwhile; ?>
					</ul>
				</div>

				<?php get_template_part('includes/post-formats/post-nav'); ?> <!-- Posts Navigation -->
				<?php $wp_query = null; $wp_query = $temp;?>
			</div><!-- /content -->
<?php get_footer(); ?>