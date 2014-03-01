<footer>
	<div class="clearfix">
		<div>
			<h3>Around the Site</h3>
			<div class="sortable clearfix">
				 <?php
				 	$categories = get_categories();
					foreach($categories as $category){
						echo('<a href="'.get_category_link($category->term_id).'">'.$category->name.'</a>');
					}
				 ?>
			</div>
		</div>
		
		<div><?php /*
			<h3>Browse By Platform</h3>
			<div class="sortable">
				 <a href="#">NES</a><a href="#">SNES</a><a href="#">N64</a>
			</div>
		 */	?>
		</div>
		<div class="getintouch">
			<h3>Get In Touch</h3>
			<div>
				<a class="email" href="mailto:admin@1morecastle.com"><span></span>Email</a>
				<a class="twitter" href="https://twitter.com/1morecastle" target="_blank"><span></span>Twitter</a>
				<a class="facebook" href="http://www.facebook.com/1MoreCastle" target="_blank"><span></span>Facebook</a>
				<a class="contact" href="<?php bloginfo('url'); ?>/contact-us/"><span></span>Contact Us Form</a>
			</div>
		</div>
		<div>
			<h3>About The Site</h3>
			<div>
				<ul>
					<?php
						wp_nav_menu(array(
						'theme_location'=>'footer_menu'
					));
					?>
				</ul>
			</div>
		</div>
	</div>
</footer>
</div>
<?php wp_footer();?>
</body>
</html>