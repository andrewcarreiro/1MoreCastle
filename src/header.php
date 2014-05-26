<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>1 More Castle <?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" />
	<?php get_template_part('searchobject'); ?>
	<?php wp_head(); ?>
	<?php omc_analytics();?>
</head>
<?php
	$headerClasses = "";
	$headerClasses .= is_single() ? "single " : "";
	$headerClasses .= is_home() ? "home " : "";
?>

<body class="<?php echo($headerClasses); ?>">
<!--[if lte IE 8]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div id="mobileflag"></div>
	<?php get_template_part('main_nav'); ?>
	<div class="container">
		<div>
			<div class="whitebg"></div>
			<div class="header">
				<a class="logo" href="<?php echo(home_url('/')); ?>"></a>
				<form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="search desktoponly">
					<div>
						<input type="text" autocomplete="off" name="s" id="s" placeholder="search"/>
					</div>
					<a href="#" class="submit"></a>
					<div class="suggestedresults" id="suggestedresults"></div>
				</form>
				<div class="menubutton">
				</div>
			</div>
			<?php get_template_part('header_featured'); ?>