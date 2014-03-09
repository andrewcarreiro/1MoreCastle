<?php get_header(); ?>
<div class="content list search">
	<div class="postcontainer title">
		<div class="post">
			<div>
				<span>Search Results for:</span>
				<h1>"<?php echo $_GET["s"]; ?>"</h1>
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