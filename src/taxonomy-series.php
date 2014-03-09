<?php get_header(); ?>
<div class="content list search">
	<div class="postcontainer title">
		<div class="post">
			<div>
				<span>Series</span>
				<h1><?php single_cat_title(); ?></h1>
				<div class="description">
					<?php 
						echo term_description();
					?>
				</div>
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