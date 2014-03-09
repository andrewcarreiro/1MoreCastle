<?php if(have_posts()) : while(have_posts()) : the_post();?>
<div class="postcontainer">
	<div class="post">
		<a href="<?php the_permalink(); ?>">
		<?php
			the_post_thumbnail('large', array(
				'class' => 'postheader'		
			));
		?>
		</a>
		<article>
			<div class="postcontent">
				<?php
					$series = get_the_terms($post->ID, 'series');
					$seriesTitle = false;
					if($series != false){
						foreach($series as $ser){
							if($ser->name != ""){
								$seriesTitle = $ser->name;
								echo '<h2 class="series"><a href="'.get_bloginfo('url').'/series/'.$ser->slug.'/">'.$seriesTitle.'</a></h2>';

								break;
							}
						}
					}
				?>
				<h1><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h1>
				<?php the_content('Read More'); ?>
			</div>
		</article>
	</div>
</div>
<?php endwhile; else: ?>
<div class="post">
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
</div>
<?php endif; ?>