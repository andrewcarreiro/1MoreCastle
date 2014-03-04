<?php get_header(); ?>
<div class="content">
	<?php if(have_posts()) : while(have_posts()) : the_post();?>
	<div class="post">
		<?php
			the_post_thumbnail('large', array(
				'class' => 'postheader'		
			));
		?>
		<article>
			<div class="postcontent">
				<?php
					$series = get_the_terms($post->ID, 'series');
					if($series != false){
						foreach($series as $ser){
							if($ser->name != ""){
								echo '<h2 class="series"><a href="'.get_bloginfo('url').'/series/'.$ser->slug.'/">'.$ser->name.'</a></h2>';
								break;
							}
						}
					}
				?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</article>
		<?php if(strlen(get_the_author_meta('first_name')) > 0):?>
			<section class="byline">
				<?php echo(get_avatar(get_the_author_meta('ID'))); ?>
				<h4><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></h4>
				<p><?php the_author_meta('description'); ?></p>
				<a href="<?php echo(home_url().'/authors/'.get_the_author_meta('nicename')); ?>">See all posts by <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a>
			</section>
		<?php endif; ?>
		<section class="related series">
			<h6>Read more of [SERIES NAME]</h6>
			<div>
				<div>
					<a href="#"><img src="images/test-inner-post.jpg"/></a>
					This would be the title of the post.
				</div>
			</div>
			<div>
				<div>
					<a href="#"><img src="images/test-inner-post.jpg"/></a>
					This would be the title of the post.
				</div>
			</div>
			<div>
				<div>
					<a href="#"><img src="images/test-inner-post.jpg"/></a>
					This would be the title of the post.
				</div>
			</div>
		</section>
		<section class="related site">
			<h6>Similar articles</h6>
			<div>
				<div>
					<a href="#"><img src="images/test-inner-post.jpg"/></a>
					This would be the title of the post.
				</div>
			</div>
			<div>
				<div>
					<a href="#"><img src="images/test-inner-post.jpg"/></a>
					This would be the title of the post.
				</div>
			</div>
			<div>
				<div>
					<a href="#"><img src="images/test-inner-post.jpg"/></a>
					This would be the title of the post.
				</div>
			</div>
		</section>
		<?php if($series != false): 
			$postsInSeries = get_terms(
				$series,
				array(
					'exclude' => $post->ID,
					
				)
			);
		?>
			<aside class="moreInSeries">
				<h3>Read more <?php  ?></h3>
				
			</aside>
		<?php endif ?>
		<aside class="comments-template">
			<?php comments_template(); ?>
		</aside>
	</div>
	<?php endwhile; else: ?>
	<div class="post">
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>