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