<?php get_header(); ?>
<?php get_template_part("headerbar"); ?>
<?php 
if(is_paged()){
	ads('single_top');
}else{
	get_template_part("promoheader");
?>
	<script type="text/javascript">
		// set your twitter id
	    var user = '1MoreCastle';
	      
	    // using jquery built in get json method with twitter api, return only one result
	    jQuery.getJSON('http://twitter.com/statuses/user_timeline.json?screen_name=' + user + '&count=25&include_rts=false&exclude_replies=true&exclude_replies=true&callback=?', function(data)      {
	          
	        // result returned
	        var tweet = data[0].text;
	      
	        // process links and reply
	        tweet = tweet.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
	            return '<a href="'+url+'">'+url+'</a>';
	        }).replace(/B@([_a-z0-9]+)/ig, function(reply) {
	            return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
	        });
	      
	        // output the result
	        jQuery(".tweetbody").hide();
	        jQuery(".tweetbody").html(tweet);
	        jQuery(".tweetbody").fadeIn();
	    }); 
	</script>	
<?php
}
?>
<div class="clearfix">
	<div class="content">
		<section>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article>
					<?php
						$series = get_the_terms($post->ID, 'series');
							if($series != false){
								foreach($series as $ser){
									if($ser->name != ""){
										echo '<h2 class="series"><a href="'.get_bloginfo('url').'/series/'.$ser->slug.'/">'.$ser->name.'</a><span>See all articles in this series.</span></h2>';
										break;
									}
								}
							}
					 ?>
					<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
					<aside class="metabanner">
						<?php 
							$categories = get_the_category();
						?>
						<div class="<?php echo(strtolower($categories[0]->cat_name)); ?>">
							<span class="date">
								<?php echo get_the_date("M j, Y"); ?>
							</span>
							<span class="category">
								<?php 
								$categories = get_the_category();
								echo($categories[0]->cat_name); 
								?>
							</span>
						</div>
					</aside>
					<a href="<?php the_permalink(); ?>">
					<?php
						the_post_thumbnail('medium', array(
							'class' => 'masthead',
							
						));
					?>
					</a>
					<div class="body clearfix">
						<?php the_content('Read More <span>+</span>'); ?>
					</div>
					<?php get_template_part('share'); ?>
				</article>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</section>
		<?php if(function_exists('wp_pagenavi')) { ads('bottombanner'); wp_pagenavi(); } ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
