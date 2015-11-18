<?php

get_header();

?><main class="main"><?php

	if ( have_posts() ){

		while ( have_posts() ){
			the_post();
			get_template_part('templates/sections/featured-area-1/featured-area-1');
			get_template_part('templates/sections/blog-post-1/blog-post-1');
		}
		get_template_part('templates/sections/pagination-1/pagination-1');
	}else{
		get_template_part('templates/sections/search-404-1/search-404-1');
	}

?></main><?php

get_footer();