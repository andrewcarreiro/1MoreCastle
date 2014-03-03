<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="title" content="<?php wp_title(); ?>">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->

	<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('stylesheet_url') ?>" />
	<?php wp_head(); ?>
</head>
<body>
<!--[if lte IE 8]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div id="mobileflag"></div>
	<?php get_template_part('main_nav'); ?>
	<div class="container">
		<div>
			<div class="whitebg"></div>
			<div class="header">
				<a class="logo" href="#"></a>
				<form class="search desktoponly">
					<div>
						<input type="text" placeholder="search"/>
					</div>
					<a href="#" class="submit"></a>
				</form>
				<div class="menubutton">
				</div>
			</div>
			<?php get_template_part('header_featured'); ?>