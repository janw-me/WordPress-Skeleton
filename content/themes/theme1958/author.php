<?php get_header(); ?>
			<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<?php if(isset($_GET['author_name'])) :
					$curauth = get_userdatabylogin($author_name);
				else :
					$curauth = get_userdata(intval($author));
				endif; ?>
				<div class="author-info">
					<h2><?php _e('About:', 'theme1958'); ?> <?php echo $curauth->display_name; ?></h2>
					<div class="clearfix">
						<div class="avatar">
							<?php if(function_exists('get_avatar')) { echo get_avatar( $curauth->user_email, $size = '120' ); } /* Displays the Gravatar based on the author's email address. Visit Gravatar.com for info on Gravatars */ ?>
						</div>
					
						<?php if($curauth->description !="") { /* Displays the author's description from their Wordpress profile */ ?>
							<div class="autor-desc"><?php echo $curauth->description; ?></div>
						<?php } ?>
					</div>
				</div><!--.author-->
				<div id="recent-author-posts">
					<h2><?php _e('Recent Posts by', 'theme1958'); ?> <?php echo $curauth->display_name; ?></h2>
					<?php if (have_posts()) : while (have_posts()) : the_post(); 
						// The following determines what the post format is and shows the correct file accordingly
						$format = get_post_format();
						get_template_part( 'includes/post-formats/'.$format );
						
						if($format == '')
						get_template_part( 'includes/post-formats/standard' );
					endwhile; else: ?>
						<div class="no-results">
							<p><strong><?php echo __('No post yet.', 'theme1958'); ?></strong></p>
						</div><!--no-results-->
					<?php endif; ?>
				</div><!--#recentPosts-->

				<?php get_template_part('includes/post-formats/post-nav'); ?>

				<div id="recent-author-comments">
					<h2><?php _e('Recent Comments by', 'theme1958'); ?> <?php echo $curauth->display_name; ?></h2>
					<?php $number=5; // number of recent comments to display
					$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' and comment_author_email='$curauth->user_email' ORDER BY comment_date_gmt DESC LIMIT $number"); ?>
					<ul>
						<?php if ( $comments ) : foreach ( (array) $comments as $comment) :
							echo '<li class="recentcomments">' . sprintf(__('%1$s on %2$s'), get_comment_date(), '<a href="'. get_comment_link($comment->comment_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
						endforeach; else: ?>
							<p><?php _e('No comments by', 'theme1958'); ?> <?php echo $curauth->display_name; ?> <?php _e('yet.', 'theme1958'); ?></p>
						<?php endif; ?>
					</ul>
				</div><!--#recentAuthorComments-->
			</div><!--#content-->
			<?php get_sidebar(); ?>
<?php get_footer(); ?>