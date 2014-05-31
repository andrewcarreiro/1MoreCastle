<?php $noAd = true; ?>
<?php get_header(); ?>
<div class="content">
	<?php omc_get_ad('topcontent'); ?>
	<div class="post">
		<article class="store">
			<div class="postcontent">
				<?php woocommerce_content(); ?>
			</div>
		</article>
		<?php omc_get_ad('bottomcontent'); ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>