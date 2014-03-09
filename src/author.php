<?php get_header(); ?>
<div class="content list search">
	<div class="postcontainer title author">
		<div class="post">
			<div>
				<section class="byline">
					<?php echo(get_avatar(get_the_author_meta('ID'))); ?>
					<h1><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></h1>
					<p><?php the_author_meta('description'); ?></p>
				</section>
			</div>
		</div>
	</div>
	<?php get_template_part('index-loop'); ?>
	<?php if(function_exists('wp_pagenavi')): ?>
		<div class="pagenavicontainer">
			<?php wp_pagenavi(); ?>
		</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>