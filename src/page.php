<?php get_header(); ?>
<div class="content">
	<?php if(have_posts()) : while(have_posts()) : the_post();?>
	<?php omc_get_ad('topcontent'); ?>
	<div class="post">
		<article class="page">
		<?php get_template_part('share'); ?>
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
		<?php omc_get_ad('bottomcontent'); ?>
	</div>
	<?php endwhile; else: ?>
	<div class="post">
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>