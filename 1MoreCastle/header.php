<?php require 'ads.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php wp_title(); ?></title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
	<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/apple-itouch-icon.png" />
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css"/>
	<?php wp_head(); ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			//On initial click, clear the field.
			//If nothing is entered, return the field to inital
			var formInit = "Search";
			jQuery("#s").focus(function(){
				if(jQuery(this).val() == formInit){
					jQuery(this).val("");
					jQuery(this).removeClass("grey");
					jQuery(this).parent().addClass("wide");
				}
			});
			
			jQuery("#s").blur(function(){
				if(jQuery(this).val() == ""){
					jQuery(this).val(formInit);
					jQuery(this).addClass("grey");	
					jQuery(this).parent().removeClass("wide");
				}
			});
		});
	</script>
	
</head>
<body <?php if(is_user_logged_in()){echo('class="logged-in"');}?> >
<script type="text/javascript">
   (function(){function pw_load(){
      if(arguments.callee.z)return;else arguments.callee.z=true;
      var d=document;var s=d.createElement('script');
      var x=d.getElementsByTagName('script')[0];
      s.type='text/javascript';s.async=true;
      s.src='//www.projectwonderful.com/pwa.js';
      x.parentNode.insertBefore(s,x);}
   if (window.attachEvent){
    window.attachEvent('DOMContentLoaded',pw_load);
    window.attachEvent('onload',pw_load);}
   else{
    window.addEventListener('DOMContentLoaded',pw_load,false);
    window.addEventListener('load',pw_load,false);}})();
</script>