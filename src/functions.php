<?php

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


//register user-editable menus
	register_nav_menus(array(
		'featured_items' => 'Featured items',
		'main_nav_custom1' => 'Custom Main Nav 1',
		'main_nav_custom2' => 'Custom Main Nav 2',
		'main_nav_custom3' => 'Custom Main Nav 3',
		'featured_series' => 'Featured Series'
	));


//MENU FUNCTIONS
	//Series
		//list all series
		function omc_getAllSeries(){
			$allSeries = get_terms(
				'series',
				array(
					'orderby' => 'name'
				)
			);

			foreach($allSeries as $series){
				echo("<li><a href='".home_url()."/series/".$series->slug."'>".$series->name."</a></li>");
			}
		}
		
	//Authors
		//list all users with permission level "contributor"
		function omc_getAllAuthors(){
			$admins = get_users(
				array(
					'orderby' => 'post_count',
					'order'   => 'DESC',
					'role'	  => 'administrator',
					'exclude' => array(1)
				)
			);

			$editors = get_users(
				array(
					'orderby' => 'post_count',
					'order'   => 'DESC',
					'role'	  => 'editor'
				)
			);

			$contributors = get_users(
				array(
					'orderby' => 'post_count',
					'order'   => 'DESC',
					'role'	  => 'contributor',
					'exclude' => array(14)
				)
			);

			$allAuthors = array_merge($admins,$editors,$contributors);

			foreach($allAuthors as $author){
				//var_dump($author);
				$firstname = get_the_author_meta('first_name',$author->ID);
				$lastname = get_the_author_meta('last_name',$author->ID);
				echo("<li><a href='".home_url()."/author/".$author->data->user_nicename."'>".$firstname." ".$lastname."</a></li>");
			}
		}
	//Categories
		//browse by category
		function omc_getNavCategories(){
			$allCategories = get_categories();
			foreach($allCategories as $category){
				echo("<li><a href='".home_url()."/category/".$category->slug."'>".$category->name."</a></li>");
			}
		}
	//helper function
		function omc_get_menu_object($menuName){
			$loc = get_nav_menu_locations();
			return wp_get_nav_menu_object( $loc[ $menuName ] ); 
		}
		function omc_get_menu_items($menuName){
			$menu = omc_get_menu_object($menuName);
			return wp_get_nav_menu_items($menu);
		}
		function omc_get_menu_title($menuName){
			$menu = omc_get_menu_object($menuName);
			return $menu->name;
		}


		function omc_getNavCustom($id){
			$allWho = omc_get_menu_items('main_nav_custom'.$id);
			if($allWho == false){
				return;
			}
			foreach($allWho as $who){
				$title = strlen($who->post_title) != 0 ? $who->post_title : $who->title;
				echo("<li><a href='".$who->url."'>".$title."</a></li>");
			}
		}


//Featured items function
	function omc_featured_items(){
		$allFeaturedItems = omc_get_menu_items('featured_items');
		if($allFeaturedItems == false){
			return;
		}
		for($i=0; $i<3; $i++){

			$thepost   = get_post( $allFeaturedItems[$i]->object_id );
			$link 	   = $allFeaturedItems[$i]->url;

			$bgimg 	   = wp_get_attachment_image_src( get_post_thumbnail_id( $thepost->ID ) );
			$bgimg     = $bgimg[0];
			$gametitle = null;
			$posttitle = strlen($thepost->post_title) != 0 ? $thepost->post_title : $thepost->title;
			
			$author_object = get_userdata( $thepost->post_author );
			if($author_object->data->user_login != "Admin"){
				$firstname = get_the_author_meta('first_name',$author_object->ID);
				$lastname = get_the_author_meta('last_name',$author_object->ID);

				$author    = $firstname." ".$lastname;
			}else{
				$author    = null;
			}
			
			

			$stringToPrint = '<a href="'.$link.'">
				<div class="bg" style="background-image:url(\''.$bgimg.'\');"></div>
				<div class="cover">';
			if($gametitle != null){
				$stringToPrint .= '<div class="gametitle">'.$gametitle.'</div>';
			}
			$stringToPrint .= '<div class="posttitle">'.$posttitle.'</div>';
			
			if($author != null){
				$stringToPrint .= '<div class="author">'.$author.'</div>';
			}
			$stringToPrint .= '</div></a>';


			echo($stringToPrint);
		}
	}

//Get 3 other posts from the same series.
	function omc_get_posts_from_series($currentPostid, $seriesslug){
		$query = new WP_Query( array(
				'post__not_in' => array($currentPostid),
				//Order & Orderby Parameters
				'order'               => 'DESC',
				'orderby'             => 'rand',
				//Pagination Parameters
				'posts_per_page'         => 3,
				'tax_query' => array(
					array(
						'taxonomy'         => 'series',
						'field'            => 'slug',
						'terms'            => array($seriesslug)
					)
				)		
			)
		);

		if($query->post_count > 2){
			return $query;	
		}else{
			return false;
		}
		
	}


//queue up all JS
	//all JS is minified into script.js, but we still need jquery
	//fuck it
	/*
	function omc_javascript_enqueue(){
		wp_enqueue_script('omc_mainjs', get_template_directory_uri().'/script.js', array('jquery'),false,true);
	}

	add_action('wp_enqueue_scripts', 'omc_javascript_enqueue');
	*/

//add theme support for various features
	add_theme_support('post-thumbnails');



//Allow Contributors to upload media
	if ( current_user_can('contributor') && !current_user_can('upload_files') )
		add_action('admin_init', 'allow_contributor_uploads');

	function allow_contributor_uploads() {
		$contributor = get_role('contributor');
		$contributor->add_cap('upload_files');
	}

//unfuck galleries
	add_filter( 'use_default_gallery_style', '__return_false' );

//series Taxonomy
	register_taxonomy('series', 'post', array(
		'label' => 'Article Series',
		'labels' => array(
			'name' => 'Series',
			'singular_name' => 'Series',
			'add_new_item' => 'Add new series'
		),
		'hierarchical' => true,
		'rewrite' => true
	));


//Responsive YouTube Embed
	function omc_responsive_youtube($attr,$content=null){
		if($content == null){
			return 'no video id specified';
		}else if(strpos($content, "?") != false){
			//is url
			parse_str(parse_url($content,PHP_URL_QUERY),$ytvars);
			$content = $ytvars["v"];
		}
		
		return '<div class="youtube-container"><iframe src="http://www.youtube.com/embed/'.$content.'" frameborder="0" width="560" height="315"></iframe></div>';
	}

	add_shortcode('youtube', 'omc_responsive_youtube');


//ad blocks
	function omc_get_ad($get_ad){
		return false; // no ads ever now
		if($noAd==true){
			return false;
		}

		switch($get_ad){
			case "topcontent":
				$ad_id = "5138522927";
				break;
			case "bottomcontent":
				$ad_id = "6615256121";
				break;
			case "sidebar":
				$ad_id = "9568722524";
				break;
		}
		?>
		<div class="mad <?php echo $get_ad ?>">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- bottom content -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-0878802325861700"
			     data-ad-slot="<?php echo $ad_id ?>"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
		<?php
	}



//featured series in sidebar
	function omc_featured_series(){
		$allFeaturedSeries = omc_get_menu_items('featured_series');
		if($allFeaturedSeries == false){
			return;
		}
		//choose random one
		$featuredseries = $allFeaturedSeries[array_rand($allFeaturedSeries,1)];

		?>
			<div class="featured-sidebar">
				<h3>Featured Series</h3>
				<div>
					<a href="<?php echo $featuredseries->url; ?>" class="<?php echo $featuredseries->classes[0]; ?>"></a>
				</div>
			</div>
		<?php
	}


//ANALYTICS
	function omc_analytics(){
		$analyticsString = "";
		if(!current_user_can('edit_post')){
			$analyticsString .= "<script>";
			
			$analyticsString = $analyticsString."(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-30208407-1', '1morecastle.com');";
			$analyticsInner = array();
			if(is_singular()){
				
				$id = get_the_ID();
				$post = get_post($id);

				//author
				$author = get_the_author_meta('user_nicename',$post->post_author);
				$author = strtolower($author);
				$author = str_replace(" ","-",$author);
				$author = "'dimension1' : '".$author."'";

				array_push($analyticsInner, $author);
				
				//series
				$terms = wp_get_post_terms( $id, 'series');
				if(count($terms) > 0){
					$dimension2 = $terms[0]->slug;
					array_push($analyticsInner, "'dimension2' : '".$dimension2."'");
				}
				
				//category
				$category = get_the_category($id);
				if(count($category) > 0){
					$allCats = array();
					for($i=0;$i<count($category);$i++){
						array_push($allCats, $category[$i]->slug);
					}
					$allCategories = implode(',',$allCats);
					array_push($analyticsInner, "'dimension3' : '".$allCategories."'");
				}

				//page type
				array_push($analyticsInner, "'dimension4' : 'single'");
			}else{
				//page type
				array_push($analyticsInner, "'dimension4' : 'multi'");
			}

			$analyticsString .= "ga('send', 'pageview', {";
			for($i=0; $i<count($analyticsInner); $i++){
				if($i == count($analyticsInner)-1){
					$analyticsString .= $analyticsInner[$i];
				}else{
					$analyticsString .= $analyticsInner[$i].",";
				}
				
			}
			$analyticsString .= "});";
			
			


			$analyticsString .= "</script>";
		}

		echo $analyticsString;
	}
?>
