<?php get_header(); ?>
<div class="content">
	<?php if(have_posts()) : while(have_posts()) : the_post();?>
	<?php omc_get_ad('topcontent'); ?>
	<div class="post">
		<?php
			the_post_thumbnail('large', array(
				'class' => 'postheader'		
			));
		?>
		<?php get_template_part('share'); ?>
		<article>
			<div class="postcontent">
				<?php
					$series = get_the_terms($post->ID, 'series');
					$seriesSlug = false;
					$seriesTitle = false;
					if($series != false){
						foreach($series as $ser){
							if($ser->name != ""){
								$seriesSlug = $ser->slug;
								$seriesTitle = $ser->name;
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
			
		<?php previous_post_link(
			'<section class="nextlink"><span>Next up</span>%link</section>',
			"%title"
		); ?>


		<?php if(strlen(get_the_author_meta('first_name')) > 0):?>
			<section class="byline">
				<?php echo(get_avatar(get_the_author_meta('ID'))); ?>
				<h4><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></h4>
				<p><?php the_author_meta('description'); ?></p>
				<a href="<?php echo(home_url().'/authors/'.get_the_author_meta('nicename')); ?>">See all posts by <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a>
			</section>
		<?php endif; ?>

		<?php if($seriesSlug != false): 
			$moreInSeries = omc_get_posts_from_series($post->ID, $seriesSlug);
			if($moreInSeries != false):
		?>
			<section class="related series">
				<h6>Read more of <strong><?php echo($seriesTitle); ?></strong></h6>
				<?php 
					$i=0;
					while ( $moreInSeries->have_posts() ): $moreInSeries->the_post();
				?>
					<div>
						<div>
							<a href="<?php the_permalink(); ?>">
								<?php $bgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID),'small'); ?>
								<div style="background-image:url(<?php echo $bgurl ?>)"></div>
								<span><?php the_title(); ?></span>
							</a>
							
						</div>
					</div>
				<?php 
					$i++;
					if($i > 3){
						break;
					}
					endwhile; 
				?>
			</section>
		<?php endif; endif; ?>
		<?php omc_get_ad('bottomcontent'); ?>
		

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