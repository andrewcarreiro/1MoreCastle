<?php

//register user-editable menus
	register_nav_menus(array(
		'featured_items' => 'Featured items',
		'main_nav_around' => 'Around the Site',
		'main_nav_who' => 'Who We Are',
		'main_nav_projects' => 'Projects &amp; Friends',
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
		function omc_get_menu_items($menuName){
			$loc = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object( $loc[ $menuName ] );
			return wp_get_nav_menu_items($menu);
		}

	//Who We Are
		//custom menu
		//wp_nav_menu('main_nav_who');
		function omc_getNavWho(){
			$allWho = omc_get_menu_items('main_nav_who');
			if($allWho == false){
				return;
			}
			foreach($allWho as $who){
				$title = strlen($who->post_title) != 0 ? $who->post_title : $who->title;
				echo("<li><a href='".$who->url."'>".$title."</a></li>");
			}
		}
	//Around the Site
		//custom menu
		//wp_nav_menu('main_nav_around');
		function omc_getNavAround(){
			$allAround = omc_get_menu_items('main_nav_around');
			if($allAround == false){
				return;
			}
			foreach($allAround as $around){
				$title = strlen($around->post_title) != 0 ? $around->post_title : $around->title;
				echo("<li><a href='".$around->url."'>".$title."</a></li>");
			}
		}
	//Projects &amp; Friends
		//custom menu
		//wp_nav_menu('main_nav_projects');
		function omc_getNavProjects(){
			$allProjects = omc_get_menu_items('main_nav_projects');
			if($allProjects == false){
				return;
			}
			foreach($allProjects as $project){
				$title = strlen($project->post_title) != 0 ? $project->post_title : $project->title;
				echo("<li><a href='".$project->url."'>".$title."</a></li>");
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


/* ======================================================================
 * Disable-Inline-Styles.php
 * Removes inline styles and other coding junk added by the WYSIWYG editor.
 * Script by Chris Ferdinandi - http://gomakethings.com
 * ====================================================================== */
	add_filter( 'the_content', 'clean_post_content' );
	function clean_post_content($content) {

	    // Remove inline styling
	    $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);

	    // Remove font tag
	    $content = preg_replace('/<font[^>]+>/', '', $content);

	    // Remove empty tags
	    $post_cleaners = array('<p></p>' => '', '<p> </p>' => '', '<p>&nbsp;</p>' => '', '<span></span>' => '', '<span> </span>' => '', '<span>&nbsp;</span>' => '', '<span>' => '', '</span>' => '', '<font>' => '', '</font>' => '');
	    $content = strtr($content, $post_cleaners);

	    return $content;
	}


//ad blocks
	function omc_get_ad($get_ad){
		
		switch($get_ad){
			case "topcontent":
				$colour = "green";
				break;
			case "bottomcontent":
				$colour = "orange";
				break;
			case "sidebar":
				$colour = "pink";
				break;
		}
		?>
		<div class="mad <?php echo $get_ad ?>">
			<div style="">
			
			</div>
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
				<h3>Featured Series:</h3>
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
			
			$analyticsString = $analyticsString."(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-30208407-1', '1morecastle.com');ga('send', 'pageview');";

			if(have_posts()) : while(have_posts()) : the_post();
				
				if(is_singular()){
					
					//author
					$author = get_the_author_meta('user_nicename');
					$author = strtolower($author);
					$author = str_replace(" ","-",$author);

					$analyticsString .= "ga('set', 'dimension1', '".$author."');";
					
					//series
					$terms = get_terms(array('series'));
					if(count($terms) > 0){
						$analyticsString .= "ga('set', 'dimension2', '".$terms[0]->slug."');";
					}
					
					//category
					$category = get_the_category();
					if(count($category) > 0){
						$allCats = array();
						for($i=0;$i<count($category);$i++){
							array_push($allCats, $category[$i]->slug);
						}
						$analyticsString .= "ga('set', 'dimension3', '".implode(',',$allCats)."');";
					}

					//page type
					$analyticsString .= "ga('set', 'dimension4', 'single');";
				}else{
					//page type
					$analyticsString .= "ga('set', 'dimension4', 'multi');";
					break;
				}
			
			endwhile; endif;

			$analyticsString .= "</script>";
		}

		echo $analyticsString;
	}
?>