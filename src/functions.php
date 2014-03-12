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
				echo("<li><a href='".home_url()."/author/".$author->data->user_nicename."'>".$author->data->display_name."</a></li>");
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
	//Who We Are
		//custom menu
		//wp_nav_menu('main_nav_who');
		function omc_getNavWho(){
			$allWho = wp_get_nav_menu_items(get_nav_menu_locations()->main_nav_who->ID);
			if($allWho == false){
				return;
			}
			foreach($allWho as $who){
				echo("<li><a href='".$who->url."'>".$who->post_title."</a></li>");
			}
		}
	//Around the Site
		//custom menu
		//wp_nav_menu('main_nav_around');
		function omc_getNavAround(){
			$allAround = wp_get_nav_menu_items(get_nav_menu_locations()->main_nav_around->ID);
			if($allAround == false){
				return;
			}
			foreach($allAround as $around){
				echo("<li><a href='".$around->url."'>".$around->post_title."</a></li>");
			}
		}
	//Projects &amp; Friends
		//custom menu
		//wp_nav_menu('main_nav_projects');
		function omc_getNavProjects(){
			$allProjects = wp_get_nav_menu_items(get_nav_menu_locations()->main_nav_projects->ID);
			if($allProjects == false){
				return;
			}
			foreach($allProjects as $project){
				echo("<li><a href='".$project->url."'>".$project->post_title."</a></li>");
			}
		}


//Featured items function
	function omc_featured_items(){
		$allFeaturedItems = wp_get_nav_menu_items(get_nav_menu_locations()['featured_items']);
		if($allFeaturedItems == false){
			return;
		}
		for($i=0; $i<3; $i++){

			$thepost   = get_post( $allFeaturedItems[$i]->object_id );
			$link 	   = $allFeaturedItems[$i]->url;

			$bgimg 	   = wp_get_attachment_image_src( get_post_thumbnail_id( $thepost->ID ) )[0];
			$gametitle = null;
			$posttitle = $thepost->post_title;
			
			$author_object = get_userdata( $thepost->post_author );
			if($author_object->data->user_login != "Admin"){
				$author    = $author_object->display_name;
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
		parse_str(parse_url($content,PHP_URL_QUERY),$ytvars);
		return '<div class="youtube-container"><iframe src="http://www.youtube.com/embed/'.$ytvars["v"].'" frameborder="0" width="560" height="315"></iframe></div>';
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
			<div style="padding:10%;background-color:<?php echo $colour ?>">
			Ad block - <?php echo $get_ad ?>
			</div>
		</div>
		<?php
	}



//featured series in sidebar
	function omc_featured_series(){
		$allFeaturedSeries = wp_get_nav_menu_items(get_nav_menu_locations()['featured_series']);
		if($allFeaturedSeries == false){
			return;
		}
		//choose random one
		$featuredseries = $allFeaturedSeries[array_rand($allFeaturedSeries,1)];

		//var_dump($featuredseries);
	}
?>