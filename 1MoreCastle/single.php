<?php get_header(); ?>
<?php get_template_part("headerbar"); ?>
<?php ads('single_top'); ?>
<div class="clearfix">
	<div class="content">
	<section class="single">
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
				<h2><?php the_title(); ?></h2>
				<?php
					the_post_thumbnail('medium', array(
						'class' => 'masthead',
						
					));
				?>
				<div class="body">
					<?php the_content('Read More <span>+</span>'); ?>
					<div class="clear"></div>
					<?php if(strlen(get_the_author_meta('first_name')) > 0):?>
						<section class="byline">
							<?php echo(get_avatar(get_the_author_meta('ID'))); ?>
							<h4><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></h4>
							<p><?php the_author_meta('description'); ?></p>
						</section>
					<?php endif; ?>
				</div>
				<?php get_template_part('share'); ?>
			</article>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</section>

	<?php /*
	beh. Started doing this, but I'll need to revisit it.
	<?php if($series != false): 
		$args = array(
			'series'=>$ser->name,
			'post_status' => 'publish',
			'posts_per_page' => 3
			);
		$seriesQuery = null;
		$seriesQuery = new WP_Query($args);
		if($seriesQuery -> have_posts()):
	?>
			<aside class="moreInSeries">
				<h3>Read more <?php echo $ser->name; ?></h3>
				<?php 
					while($seriesQuery->have_posts()):
				?>

				<?php
					endwhile;
				?>
			</aside>
		<?php endif ?>
	<?php endif ?>

	*/ ?>
	<?php ads('bottombanner'); ?>
	<div class=”comments-template”>
		<?php comments_template(); ?>
	</div>
	</div>
	<?php get_sidebar("single"); ?>
</div>
<?php get_footer(); ?>
