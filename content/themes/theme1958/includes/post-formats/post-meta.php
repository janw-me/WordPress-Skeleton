<?php $post_meta = of_get_option('post_meta');
if ($post_meta=='true' || $post_meta=='') { ?>
	<div class="post-meta">
		<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('d'); ?><br><?php the_time('M'); ?></time>
		<div class="clearfix">
			<div class="fleft">
				<?php _e('Posted by ', 'theme1958');
				the_author_posts_link() ?>
			</div>
			<div class="fright">
				<?php comments_popup_link('No comments', '1 Comment', '% Comment(s)', 'comments-link', 'Comments are closed'); ?>
			</div>
		</div>
	</div><!--.post-meta-->
<?php } ?>