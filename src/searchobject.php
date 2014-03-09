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
	$allAuthors = get_users(
		array(
			'orderby' => 'post_count',
			'order'   => 'DESC',
			'role'	  => 'contributor'
		)
	);

	foreach($allAuthors as $author){
		array_push($searchArray, array(
				$author->data->display_name,
				home_url()."/author/".$author->data->user_nicename,
				"author"
			)
		);
	}


	foreach($searchArray as $element){
		echo("{'name' : '".$element[0]."','url' : '".$element[1]."','class' : '".$element[2]."'},");
	}
	
	
?>];
</script>