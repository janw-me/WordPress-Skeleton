			</div> <!--/container_12-->
		</div><!--/content container-->
		<footer id="footer">
			<a href="#top" id="back-top"><span></span><?php _e('Back to Top', 'theme1958'); ?></a>
			<div class="container_12 clearfix">
				<div class="grid_12 clearfix">
					<div id="footer-widgets" class="clearfix">
						<div id="middle-footer-area" class="grid_6 alpha">
							<?php if ( ! dynamic_sidebar( 'Middle Footer Area' ) ) : ?>
								<!--Widgetized Footer-->
							<?php endif ?>
						</div>
						<div id="right-footer-area" class="grid_3 omega">
							<?php if ( ! dynamic_sidebar( 'Right Footer Area' ) ) : ?>
								<!--Widgetized Footer-->
							<?php endif ?>
						</div>
					</div>
					<div id="copyright">
						<div id="footer-text">
							<h2>Copyright</h2>
							<?php $myfooter_text = of_get_option('footer_text'); 
							
							if($myfooter_text){
								echo of_get_option('footer_text');
							} else { ?>
								<a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> 
								&copy; <?php echo date('Y'); ?> &bull; 
								<a href="<?php bloginfo('url'); ?>/privacy-policy/" title="Privacy Policy"><?php _e('Privacy&nbsp;Policy', 'theme1958'); ?></a>
							<?php }
							if( is_front_page() ) { ?>
							<!-- {%FOOTER_LINK} -->
							<?php } ?>
						</div> <!--/footer-text-->
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