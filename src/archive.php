<?php get_header(); ?>
<div class="content list search">
	<?php get_template_part('index-loop'); ?>
	<?php omc_get_ad('bottomcontent'); ?>
	<?php if(function_exists('wp_pagenavi')): ?>
		<div class="pagenavicontainer">
			<?php wp_pagenavi(); ?>
		</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>