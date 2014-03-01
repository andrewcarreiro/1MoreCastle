<?php get_header(); ?>
<?php get_template_part("headerbar"); ?>
<?php ads('single_top'); ?>
<div class="clearfix">
	<div class="content">
	<section>
		<h1 class="archive-title">Category: <?php single_cat_title(); ?></h1>
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
				<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
				<a href="<?php the_permalink(); ?>">
				<?php
					the_post_thumbnail('medium', array(
						'class' => 'masthead',
						
					));
				?>
				</a>
				<div class="body">
					<?php the_content('Read More <span>+</span>'); ?>
				</div>
				<?php get_template_part('share'); ?>
			</article>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</section>
	<?php if(function_exists('wp_pagenavi')) { ads('bottombanner'); wp_pagenavi(); } ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
