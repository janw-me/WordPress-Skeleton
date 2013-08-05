<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>><![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes();?>><!--<![endif]-->
<head>
	<title>
		<?php if ( is_category() ) {
			echo __('Category Archive for &quot;', 'theme1958'); single_cat_title(); echo __('&quot; | ', 'theme1958'); bloginfo( 'name' );
		} elseif ( is_tag() ) {
			echo __('Tag Archive for &quot;', 'theme1958'); single_tag_title(); echo __('&quot; | ', 'theme1958'); bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(''); echo __(' Archive | ', 'theme1958'); bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo __('Search for &quot;', 'theme1958').wp_specialchars($s).__('&quot; | ', 'theme1958'); bloginfo( 'name' );
		} elseif ( is_home() || is_front_page()) {
			bloginfo( 'name' ); 
			if (get_bloginfo( 'description')) { echo ' | '; bloginfo( 'description' ); }
		} elseif ( is_404() ) {
			echo __('Error 404 Not Found | ', 'theme1958'); bloginfo( 'name' );
		} elseif ( is_single() ) {
			wp_title('');
		} else {
			echo wp_title( ' | ', false, right ); bloginfo( 'name' );
		} ?>
	</title>
	<meta name="description" content="<?php wp_title(); echo ' | '; bloginfo( 'description' ); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if(of_get_option('favicon') != ''){ ?>
		<link rel="icon" href="<?php echo of_get_option('favicon', "" ); ?>" type="image/x-icon">
	<?php } else { ?>
		<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon">
	<?php } ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>">
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/normalize.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/skeleton.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css">
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/touchTouch.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/768.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/480.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/320.css">
	<link href='//fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
	
	<!-- Custom CSS -->
	<?php if(of_get_option('custom_css') != ''){?>
		<style>
			<?php echo of_get_option('custom_css' ) ?>
		</style>
	<?php }?>

	<style type="text/css">
		<?php $links_styling = of_get_option('links_color'); 
			if($links_styling) {
				echo 'a, .rlist li a{color:'.$links_styling.'}';
			}
		?>
	</style>

	<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
	
	<?php /* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>
	<!--[if lt IE 8]>
		<div style=' clear: both; text-align:center; position: relative;'>
			<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode">
				<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="">
			</a>
		</div>
	<![endif]-->
	<!--[if lt IE 9]>
		<style type="text/css">
			.button,
			.flex-control-nav li a,
			.dropcap {behavior:url(<?php bloginfo('stylesheet_directory'); ?>/PIE.php); position:relative;}
			
			input[type="submit"], input[type="reset"] {behavior:url(<?php bloginfo('stylesheet_directory'); ?>/PIE.php); position:relative;}
			
			.post-meta time {behavior:url(<?php bloginfo('stylesheet_directory'); ?>/PIE.php);}
		</style>
	<![endif]-->

	<script type="text/javascript">
		// initialise plugins
			jQuery(function(){
				// main navigation init
				jQuery('ul.sf-menu').superfish({
					delay:			<?php echo of_get_option('sf_delay'); ?>, 		// one second delay on mouseout 
					animation:		{opacity:'<?php echo of_get_option('sf_f_animation'); ?>'<?php if (of_get_option('sf_sl_animation')=='show') { ?>,height:'<?php echo of_get_option('sf_sl_animation'); ?>'<?php } ?>}, // fade-in and slide-down animation
					speed:			'<?php echo of_get_option('sf_speed'); ?>',		// faster animation speed 
					autoArrows:		<?php echo of_get_option('sf_arrows'); ?>,		// generation of arrow mark-up (for submenu) 
					dropShadows:	false
				});
			});
	</script>
	
	<script type="text/javascript">
		jQuery(function(){
			var ismobile = navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i)
			if(ismobile){
				jQuery('.sf-menu').sftouchscreen({});
			}
		})
	</script>


</head>

<body <?php body_class(); ?>>
	<div id="main"><!-- this encompasses the entire Web site -->
		<header id="header">
			<div class="container_12 clearfix">
				<div class="grid_12">
					
					<div class="clearfix indent-bottom">
						<div class="grid_7 alpha">
							<div class="logo">
								<?php if(of_get_option('logo_type') == 'text_logo'){
									if( is_front_page() || is_home() || is_404() ) {?>
										<h1 class="txt-logo"><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h1>
									<?php } else { ?>
										<h1 class="txt-logo"><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h1>
									<?php }
								} else {
									if(of_get_option('logo_url') != ''){ ?>
										<h1 class="img-logo"><a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a></h1>
									<?php } else { ?>
										<h1 class="img-logo"><a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a></h1>
									<?php }
								}?>
								<div class="tagline"><?php bloginfo('description'); ?></div>
							</div> <!-- /logo-->
						</div>
						<div class="blue-header-blocks">
							<div class="blue-header-block">
								<?php echo of_get_option('telefoon'); ?>
							</div>
							<div class="blue-header-block">
								<?php echo of_get_option('email'); ?>
							</div>
							<div class="blue-header-block">
								<?php echo of_get_option('adres'); ?>
							</div>
						</div>
						<?php if(is_front_page()): ?>
							<div class="home_header_text_title">
								<?php echo of_get_option('home_header_text_title'); ?>
							</div>
							<div class="home_header_text">
								<?php echo of_get_option('home_header_text'); ?>
							</div>
							<a href="<?php echo of_get_option('home_header_link_url'); ?>" class="home_header_text_link"><?php echo of_get_option('home_header_link_text'); ?></a>
						<?php endif; ?>
					</div> <!--/clearfix-->
					<nav class="primary">
							<?php wp_nav_menu( array(
								'container'			=> 'ul', 
								'menu_class'		=> 'sf-menu clearfix', 
								'menu_id'			=> 'topnav',
								'depth'				=> 0,
								'theme_location'	=> 'header_menu' 
							)); ?>
						</nav><!--/primary-->
					
					
				</div> <!--/grid_12-->
			</div><!--/container_12-->
		</header>
		<?php
		if(is_front_page()):
		$args = array(
			'sort_order' => 'ASC',
			'post_type' => 'service',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'orderby' => 'date'
		);
		$r = new WP_Query($args);
			if ($r->have_posts()) :
			?><div class="services"><ul class="container_12"><?php
			while ( $r->have_posts() ) : $r->the_post(); ?>
				<li>
					<h2><?php the_title(); ?></h2>
					<p>
						<?php echo get_post_meta($post->ID, 'ba_textarea_samenvatting', true); ?>
					</p>
					<a href="<?php the_permalink() ?>" class="read-more" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php _e('Read more', L10n); ?></a>
				</li>
			<?php endwhile; ?>
		</ul></div>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		<?php endif; ?>
		<div class="primary_content_wrap clearfix">
			<div class="container_12 ">