<?php

/*
 * 
 * CREATING THE GAME STRUCTURE
 * 
 */
function game_init(){
		
	register_post_type(
		'game',
		array(
			'exclude_from_search' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'public' => true,
			'rewrite' => array(
				'with_front' => true,
				'feeds' => false
			),
			'label' => 'Games',
			'labels' => array(
				'singular_name' => 'Game',
				'add_new_item' => 'Add New Game',
				'edit_item' => 'Edit Game',
				'new_item' => 'New Game',
				'view_item' => 'View Game',
				'search_items' => 'Search Games',
				'not_found' => 'No games found',
				'not_found_in_trash' => "No games found in trash."
			),
			'supports' => array(
				'custom-fields', 'title'
			)
		)
	);
	
	register_taxonomy(
		'system',
		'game',
		array(
			'label' => 'System',
			'hierarchical' => true
		)
	);
	
	register_taxonomy(
		'genre',
		'game',
		array(
			'label' => 'Genre',
			'hierarchical' => false
		)
	);
	
	
}
//add_action('init', 'game_init');



/*
 * 
 * REGISTER USER-EDITABLE MENUS
 *  
 */
register_nav_menus(array(
	'footer_menu' => 'About The Site (Footer Menu)'
));


/*
 * 
 * DAT JAVASCRIPT
 * 
 */

function datJavascript(){
	wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'datJavascript');

//Post Thumbnails
add_theme_support('post-thumbnails');


//Promo slider sizes
/*
update_option("promo_size_lg", "")
if( FALSE === get_option("frontpage_size_w") )
{
	add_option("frontpage_size_w", "260");
	add_option("frontpage_size_h", "0");
	add_option("frontpage_size_crop", "0");

	add_option("anothersize_size_w", "260");
	add_option("anothersize_size_h", "0");
	add_option("anothersize_size_crop", "0");


function additional_image_sizes( $sizes )
{
	$sizes[] = "frontpage";
	$sizes[] = "anothersize";

	return $sizes;
}
add_filter( 'intermediate_image_sizes', 'additional_image_sizes' );
*/
//http://codex.wordpress.org/Function_Reference/update_option

// Load up our awesome theme options
require_once ( get_stylesheet_directory() . '/theme-options.php' );

//Allow Contributors to upload media
if ( current_user_can('contributor') && !current_user_can('upload_files') )
	add_action('admin_init', 'allow_contributor_uploads');

function allow_contributor_uploads() {
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
}


/*
 * Replace Wordpress' shitty 10px caption system
 */
add_shortcode('wp_caption', 'slim_img_caption_shortcode');
add_shortcode('caption', 'slim_img_caption_shortcode');
function slim_img_caption_shortcode($attr, $content = null) {
	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		//this is the new success state
		$toprint = do_shortcode($content);
		$img = substr($toprint, strpos($toprint, '<img '), strpos($toprint, '/>', strpos($toprint, '<img ')) - strpos($toprint, '<img ')+2);
		$toprint = substr_replace($toprint, '', strpos($toprint, '<img '), strpos($toprint, '/>', strpos($toprint, '<img ')) - strpos($toprint, '<img ')+2);
		return '<div id="' . $id . '" class="wp-caption ' . esc_attr($align) . '" style="width: ' . ( (int) $width) . 'px"><div class="wp-caption-text">' . $img . '<div>'.$toprint.'</div></div></div>';

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
		//this is the old success state.
		
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