<script>
var searchObject = [<?php
	//get all series
	$searchArray = array();

	$allSeries = get_terms(
		'series',
		array(
			'orderby' => 'name'
		)
	);

	foreach($allSeries as $series){
		array_push($searchArray, array(
				$series->name,
				home_url()."/series/".$series->slug,
				"series"
			)
		);
	}

	//get all authors
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
		array_push($searchArray, array(
				get_the_author_meta('first_name',$author->ID)." ".get_the_author_meta('last_name',$author->ID),
				home_url()."/author/".$author->data->user_nicename,
				"author"
			)
		);
	}

	for($i=0; $i<count($searchArray); $i++){
		if($i != 0){ echo(","); }
		echo("{'name' : '".addslashes($searchArray[$i][0])."','url' : '".addslashes($searchArray[$i][1])."','class' : '".addslashes($searchArray[$i][2])."'}");
	}
	
	
?>];
</script>