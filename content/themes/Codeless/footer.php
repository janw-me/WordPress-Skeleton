			</div> <!--/container_12-->
		</div><!--/content container-->
		<footer id="footer">
			<a href="#top" id="back-top"><span></span><?php _e('Back to Top', 'theme1958'); ?></a>
			<div class="container_12 clearfix">
				<div class="grid_12 clearfix">
					<?php get_sidebar('footer'); ?>
					<div id="copyright">
						<?php if(of_get_option('logo_url') != ''){ ?>
							<a href="<?php bloginfo('url'); ?>/" class="logo-footer"><img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
						<?php } else { ?>
							<a href="<?php bloginfo('url'); ?>/" class="logo-footer"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
						<?php } ?>
						<div id="footer-text">
							<?php 
								echo of_get_option('telefoon') . '<br />' . of_get_option('email') . '<br />' . of_get_option('adres');
							?>
						</div>
						<?php
							if ( ! isset( $social ) ) {
								$social = array(
									'googleplus' => of_get_option( 'social_googleplus' ),
									'facebook' => of_get_option( 'social_facebook' ),
									'twitter' => of_get_option( 'social_twitter' ),
									'linkedin' => of_get_option( 'social_linkedin' ),
									'youtube' => of_get_option( 'social_youtube' ),
									'slideshare' => of_get_option( 'social_slideshare' ),
								);
							}
						?>
						<ul class="social-share">
							<?php if ( !empty( $social['googleplus'] ) ): ?><li>
								<a href="<?php echo $social['googleplus'] ?>" class="sprite googleplus"><?php _e( 'Google+', L10n ) ?></a>
							</li><?php endif ?>
							<?php if ( !empty( $social['facebook'] ) ): ?><li>
								<a href="<?php echo $social['facebook'] ?>" class="sprite facebook"><?php _e( 'Facebook', L10n ) ?></a>
							</li><?php endif ?>
							<?php if ( !empty( $social['twitter'] ) ): ?><li>
								<a href="<?php echo $social['twitter'] ?>" class="sprite twitter" ><?php _e( 'Twitter', L10n ) ?></a>
							</li><?php endif ?>
							<?php if ( !empty( $social['linkedin'] ) ): ?><li>
								<a href="<?php echo $social['linkedin'] ?>" class="sprite linkedin" ><?php _e( 'Linkedin', L10n ) ?></a>
							</li><?php endif ?>
							<?php if ( !empty( $social['youtube'] ) ): ?><li>
								<a href="<?php echo $social['youtube'] ?>" class="sprite youtube" ><?php _e( 'Youtube', L10n ) ?></a>
							</li><?php endif ?>
							<?php if ( !empty( $social['slideshare'] ) ): ?><li>
								<a href="<?php echo $social['slideshare'] ?>" class="sprite slideshare" ><?php _e( 'SlideShare', L10n ) ?></a>
							</li><?php endif ?>
						</ul>
					</div><!--/copyright-->
				</div>
			</div><!--/container-->
		</footer>
	</div><!--/main-->
	<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work properly -->
	<?php if(of_get_option('ga_code')) { ?>
		<script type="text/javascript">
			<?php echo stripslashes(of_get_option('ga_code')); ?>
		</script>
		<!-- Show Google Analytics -->
	<?php } ?>
</body>
</html>