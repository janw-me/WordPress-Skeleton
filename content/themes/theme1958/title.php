<div class="header-title">
	<?php if(is_home()){ ?>
		<?php $blog_text = of_get_option('blog_text');
		if($blog_text){?>
			<h2><?php echo of_get_option('blog_text'); ?></h2>
		<?php } else { ?>
			<h2><?php _e('Blog','theme1958');?></h2>
		<?php }
	} else {
		if (have_posts()) : while (have_posts()) : the_post();
			$pagetitle = get_post_custom_values("page-title");
			$pagedesc = get_post_custom_values("page-desc");
			if($pagetitle == ""){ ?>
				<h2><?php the_title(); ?></h2>
			<?php } else { ?>
				<h2><?php echo $pagetitle[0]; ?></h2>
			<?php }
			if($pagedesc != ""){ ?>
				<div class="page-desc"><?php echo $pagedesc[0];?></div>
			<?php }
		endwhile; endif;
		wp_reset_query();
	} ?>
</div>