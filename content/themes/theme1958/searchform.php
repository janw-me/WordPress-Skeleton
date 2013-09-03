<form method="get" id="searchform" action="<?php bloginfo('home'); ?>">
	<input type="text" class="searching" value="<?php the_search_query(); ?>" name="s" id="s">
	<input class="submit" type="submit" value="<?php _e('Search', 'theme1958'); ?>">
</form>