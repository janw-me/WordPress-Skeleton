<?php
/**
 * Template Name: Home Page
 */ ?>

<?php get_header(); ?>
			<?php if( is_active_sidebar( 'content-area1' ) || is_active_sidebar( 'content-area2' ) || is_active_sidebar( 'content-area3' )) { ?>
				<div class="clearfix indent-bottom">
					<div class="grid_12 clearfix">
						<div class="content-area" id="content-area1">
							<?php if ( ! dynamic_sidebar( '1st Content Area' ) ) : ?>
								<!--Widgetized 'Before Content Area' for the home page-->
							<?php endif; ?>
						</div>
						<div class="content-area" id="content-area2">
							<?php if ( ! dynamic_sidebar( '2nd Content Area' ) ) : ?>
								<!--Widgetized 'Before Content Area' for the home page-->
							<?php endif; ?>
						</div>
						<div class="content-area last-child" id="content-area3">
							<?php if ( ! dynamic_sidebar( '3d Content Area' ) ) : ?>
								<!--Widgetized 'Before Content Area' for the home page-->
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } 
			if (have_posts()) : while (have_posts()) : the_post();
				the_content();
			endwhile; endif; ?>
<?php get_footer(); ?>