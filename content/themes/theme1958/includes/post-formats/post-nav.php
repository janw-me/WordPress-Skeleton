<?php if(function_exists('pagination')) :
	pagination($additional_loop->max_num_pages);
else :
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="oldernewer">
			<div class="older">
				<?php next_posts_link( __('&laquo; Older Entries', 'theme1958')) ?>
			</div><!--.older-->
			<div class="newer">
				<?php previous_posts_link(__('Newer Entries &raquo;', 'theme1958')) ?>
			</div><!--.newer-->
		</nav><!--.oldernewer-->
	<?php endif;
endif; ?> <!-- Posts navigation -->