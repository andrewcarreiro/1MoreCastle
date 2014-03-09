<aside class="sharewidget">
	Share this<i></i>
	<div>
		<a title="Share with Twitter" target="_blank" href="http://twitter.com/share?url=<?php echo urlencode(get_permalink($post->ID)) ?>&text=<?php echo urlencode(get_the_title($post->ID));?>&via=1MoreCastle" class="twitter">Twitter</a>
		<a title="Share with Facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)) ?>&t=<?php echo urlencode(get_the_title($post->ID));?>" class="facebook">Facebook</a>
		<a title="Share on tumblr" target="_blank" href="http://www.tumblr.com/share?v=3&u=<?php echo urlencode(get_permalink($post->ID)) ?>&t=<?php echo urlencode(get_the_title($post->ID));?>" class="tumblr">Tumblr</a>
		<a title="Submit to Reddit" target="_blank" href="http://www.reddit.com/submit?url=<?php echo urlencode(get_permalink($post->ID)) ?>" class="reddit">Reddit</a>
		<a title="Email this article" target="_blank" href="mailto:?subject=<?php echo get_the_title($post->ID);?>&body=Check out <?php echo get_the_title($post->ID);?> on 1 More Castle:%0D%0A<?php echo urlencode(get_permalink($post->ID)); ?>" class="email">Email</a>
	</div>
</aside>