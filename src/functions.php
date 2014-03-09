<?php

//register user-editable menus
	register_nav_menus(array(
		'featured_items' => 'Featured items',
		'main_nav_around' => 'Around the Site',
		'main_nav_who' => 'Who We Are',
		'main_nav_projects' => 'Projects &amp; Friends'
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
				echo("<li><a href='".home_url()."/series/".$element->slug."'>".$element->name."</a></li>");
			}
		}
		
	//Authors
		//list all users with permission level "contributor"
		function omc_getAllAuthors(){
			$allAuthors = get_users(
				array(
					'orderby' => 'post_count',
					'order'   => 'DESC',
					'role'	  => 'contributor'
				)
			);

			foreach($allAuthors as $author){
				echo("<li><a href='".home_url()."/author/".$author->data->user_nicename."'>".$author->data->display_name."</a></li>");
			}
		}
	//Consoles
		//browse by games in a particular console? <-could be an easy custom taxonomy.
		//wp_nav_menu('main_nav_consoles');
		function omc_getNavConsoles(){
			$allConsoles = wp_get_nav_menu_items(get_nav_menu_locations()->main_nav_consoles->ID);
			if($allConsoles == false){
				return;
			}
			foreach($allConsoles as $console){
				echo("<li><a href='".$console->url."'>".$console->post_title."</a></li>");
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


?>