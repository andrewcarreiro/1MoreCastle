<header class="logo">
	<div>
		<h1>1 More Castle</h1>
		<img src="<?php bloginfo('template_url');?>/images/banner.png" alt="1 More Castle" usemap="#bannermap"/>
		<map name="bannermap">
			<area shape="poly" href="<?php bloginfo('url'); ?>" coords="5,0 154,0 153,154 5,179"/>
		</map>
	</div>
</header>
<header class="topbar">
	<div class="clearfix">
		<a href="#top"></a>
		<div class="clearfix">
			<nav>
				<!--Categories Navigation-->
				<h3><span>Categories</span></h3>
				<div>
					<?php
					 	$categories = get_categories();
						foreach($categories as $category){
							echo('<a href="'.get_category_link($category->term_id).'">'.$category->name.'</a>');
						}
					 ?>
				</div>
			</nav>
			<?php /*
			<nav>
				<!--Platforms Navigation-->
				<h3><span>Platforms</span></h3>
				<div>
					<a href="#">Test 1</a>
					<a href="#">Test 2</a>
					<a href="#">Test 3</a>
				</div>
			</nav> 
			*/ ?>
			<?php get_search_form(); ?>
		</div>
	</div>
</header>
<div class="bggradient"></div>
<div class="main">