<aside class="promo">
	<?php
		//get dose options
		$options = get_option('onemorecastle_theme_options');
		
		//green
		$category = get_the_category($options['promo_box1']);
		$greencat = $category[0]->cat_name;
		$greentitle = get_the_title($options['promo_box1']);
		$greenlink = get_permalink($options['promo_box1']);
		
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($options['promo_box1']), 'large' );
		$greenimage = $thumb['0'];
		
		//yellow
		$category = get_the_category($options['promo_box2']);
		$yellowcat = $category[0]->cat_name;
		$yellowtitle = get_the_title($options['promo_box2']);
		$yellowlink = get_permalink($options['promo_box2']);
		
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($options['promo_box2']), 'thumbnail' );
		$yellowimage = $thumb['0'];
		
		//blue
		$category = get_the_category($options['promo_box3']);
		$bluecat = $category[0]->cat_name;
		$bluetitle = get_the_title($options['promo_box3']);
		$bluelink = get_permalink($options['promo_box3']);
		
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($options['promo_box3']), 'thumbnail' );
		$blueimage = $thumb['0'];
	?>
	<div class="bg clearfix">
		<div class="left">
			<img src="<?php echo $greenimage; ?>"/>
		</div>
		<div class="right">
			<div>
				<img src="<?php echo $yellowimage; ?>"/>
			</div>
			<div>
				<img src="<?php echo $blueimage; ?>"/>
			</div>
		</div>
	</div>
	<div class="text clearfix">
		<a href="<?php echo $greenlink ?>" class="left">
			<h3><?php echo $greencat; ?></h3>
			<p><?php echo $greentitle; ?></p>
		</a>
		<div class="right">
			<a href="<?php echo $yellowlink ?>">
				<h3><?php echo $yellowcat; ?></h3>
				<p><?php echo $yellowtitle; ?></p>
			</a>
			<a href="<?php echo $bluelink ?>">
				<h3><?php echo $bluecat; ?></h3>
				<p><?php echo $bluetitle; ?></p>
			</a>
		</div>
	</div>
	<div class="livebar clearfix">
		<div class="tweet">
			<span class="bird"></span>
			<span class="says">
				@1MoreCastle says:
			</span>
			<span class="tweetbodyparent">
				<span class="tweetbody">
					
				</span>
			</span>
		</div>
		<div class="connect clearfix">
			<span>Connect:</span>
			<a href="http://feeds.feedburner.com/1MoreCastle" target="_blank" class="rss">RSS Feed</a>
			<a href="http://www.twitter.com/1MoreCastle" target="_blank" class="twitter">Twitter</a>
			<a href="http://www.facebook.com/1MoreCastle" target="_blank" class="facebook">Facebook</a>
		</div>
	</div>
</aside>