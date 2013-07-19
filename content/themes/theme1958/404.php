<?php get_header(); ?>
			<div id="content">
				<div id="error404" class="clearfix">
					<div class="error404-num grid_7">404</div>
					<div class="grid_5">
						<hgroup>
							<h2><?php echo __('Sorry!', 'theme1958'); ?></h2>
							<h4><?php echo __('Page Not Found', 'theme1958'); ?></h4>
						</hgroup>
						<h6><?php echo __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'theme1958'); ?></h6>
						<p><?php echo __('Please try using our search box below to look for information on the internet.', 'theme1958'); ?></p>
						<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
					</div>
				</div><!--#error404 .post-->
			</div><!--#content-->
<?php get_footer(); ?>