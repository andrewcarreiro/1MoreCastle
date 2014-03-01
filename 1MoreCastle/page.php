<?php get_header(); ?>
<?php get_template_part("headerbar"); ?>
<?php ads('single_top'); ?>
<div class="clearfix">
	<div class="content">
	<section>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article>
				<h2><?php the_title(); ?></h2>
				<div class="body">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</section>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
