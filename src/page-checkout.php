<?php get_header(); ?>
<div class="content">
	<?php if(have_posts()) : while(have_posts()) : the_post();?>
	<?php omc_get_ad('topcontent'); ?>
	<div class="post">
		<article class="store page checkout">
			<div class="postcontent">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</article>
		<?php omc_get_ad('bottomcontent'); ?>
	</div>
	<?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>