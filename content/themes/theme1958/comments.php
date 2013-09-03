<?php
/**
 * @package WordPress
 * @subpackage theme1958
 */

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php echo __('This post is password protected. Enter the password to view comments.', 'theme1958'); ?></p>
	<?php return;
} ?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h2 class="space" id="comments">
		<?php _e('Comments', 'theme1958'); ?>
	</h2>

	<ol class="commentlist rlist">
		<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
	</ol>

<?php else : // this is displayed if there are no comments so far 
	if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
		<p class="nocomments"><?php echo __('No Comments Yet.', 'theme1958'); ?></p>
	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php echo __('Comments are closed.', 'theme1958'); ?></p>
	<?php endif;
endif;

if ( comments_open() ) : ?>
	<div id="respond">
		<h2><?php comment_form_title( _e('Leave a reply','theme1958')); ?></h2>
		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<p><?php _e('You must be', 'theme1958'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in', 'theme1958'); ?></a> <?php _e('to post a comment.', 'theme1958'); ?></p>
		<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( is_user_logged_in() ) : ?>
					<p><?php _e('Logged in as', 'theme1958'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'theme1958'); ?>"><?php _e('Log out &rsaquo;', 'theme1958'); ?></a></p>
				<?php else : ?>
					<p class="field">
						<input type="text" name="author" id="author" value="<?php _e('Name*', 'theme1958'); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> onfocus="if(this.value =='<?php _e('Name*', 'theme1958'); ?>' ) this.value=''" onblur="if(this.value=='') this.value='<?php _e('Name*', 'theme1958'); ?>'">
					</p>
					<p class="field">
						<input type="text" name="email" id="email" value="<?php _e('Email (will not be published)*', 'theme1958'); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> onfocus="if(this.value =='<?php _e('Email (will not be published)*', 'theme1958'); ?>' ) this.value=''" onblur="if(this.value=='') this.value='<?php _e('Email (will not be published)*', 'theme1958'); ?>'">
					</p>
					<p class="field">
						<input type="text" name="url" id="url" value="<?php _e('Website*', 'theme1958'); ?>" size="22" tabindex="3" onfocus="if(this.value =='<?php _e('Website*', 'theme1958'); ?>' ) this.value=''" onblur="if(this.value=='') this.value='<?php _e('Website*', 'theme1958'); ?>'">
					</p>
				<?php endif; ?>
				<p>
					<label for="comment"></label>
					<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" onfocus="if(this.value =='<?php _e('Your comment*', 'theme1958'); ?>' ) this.value=''" onblur="if(this.value=='') this.value='<?php _e('Your comment*', 'theme1958'); ?>'"><?php _e('Your comment*', 'theme1958'); ?></textarea>
				</p>
				<p>
					<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'theme1958'); ?>">
					<?php comment_id_fields(); ?>
				</p>
				<?php do_action('comment_form', $post->ID); ?>
			</form>
		<?php endif; // If registration required and not logged in ?>
	</div>
<?php endif; // if you delete this the sky will fall on your head ?>