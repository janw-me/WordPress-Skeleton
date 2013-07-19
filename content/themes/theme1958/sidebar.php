			<aside id="sidebar" class="grid_3 last-col">
				<?php if ( ! dynamic_sidebar( 'Sidebar' )) : ?>
					<div id="sidebar-search" class="widget">
						<h2><?php echo __('Search', 'theme1958'); ?></h2>
						<?php get_search_form(); ?> <!-- outputs the default Wordpress search form-->
					</div>

					<div id="sidebar-nav" class="widget menu">
						<h2><?php echo __('Navigation', 'theme1958'); ?></h2>
						<?php wp_nav_menu( array('menu' => 'Sidebar Menu' )); ?> <!-- editable within the Wordpress backend -->
					</div>

					<div id="sidebar-archives" class="widget">
						<h2><?php echo __('Archives', 'theme1958'); ?></h2>
						<ul class="archive-list">
							<?php wp_get_archives( 'type=monthly' ); ?>
						</ul>
					</div>
				
					<div id="sidebar-meta" class="widget">
						<h2><?php echo __('Meta', 'theme1958'); ?></h2>
						<ul class="meta-list">
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</div>
				<?php endif; ?>
			</aside><!--sidebar-->