<?php if(have_posts()) : while(have_posts()) : the_post();
	wp_redirect($post->guid);
endwhile;endif; ?>