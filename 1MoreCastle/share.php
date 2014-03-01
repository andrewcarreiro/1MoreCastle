<aside class="sharewidget clearfix">
	<div class="clearfix">
		<a title="Share with Twitter" target="_blank" href="http://twitter.com/share?url=<?php echo urlencode(get_permalink($post->ID)) ?>&text=<?php echo urlencode(get_the_title($post->ID));?>&via=1MoreCastle" class="twitter">Share with Twitter</a>
		<a title="Share with Facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)) ?>&t=<?php echo urlencode(get_the_title($post->ID));?>" class="facebook">Share with Facebook</a>
		<a title="Share on tumblr" target="_blank" href="http://www.tumblr.com/share?v=3&u=<?php echo urlencode(get_permalink($post->ID)) ?>&t=<?php echo urlencode(get_the_title($post->ID));?>" class="tumblr">Share on Tumblr</a>
		<a title="Submit to Reddit" target="_blank" href="http://www.reddit.com/submit?url=<?php echo urlencode(get_permalink($post->ID)) ?>" class="reddit">Submit to Reddit</a>
		<a title="Pin this on Pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)) ?>&media=<?php
			$imagelink = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
			echo urlencode($imagelink[0]);
			?>&description=<?php echo urlencode(get_the_title($post->ID));?>" class="pinterest">Pin this on Pinterest</a>
		<a title="Email this article" target="_blank" href="mailto:?subject=<?php echo urlencode(get_the_title($post->ID));?>&body=Check out <?php echo urlencode(get_the_title($post->ID));?> on 1 More Castle:%0D%0A<?php echo urlencode(get_permalink($post->ID)); ?>" class="email">Email this article</a>
	</div>
	<?php if(is_single() == false): ?> 
	<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" class="more-link">Read More <span>+</span></a>
	<?php endif; ?>
</aside>