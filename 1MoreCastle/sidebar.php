<aside class="sidebar">
	<!--SIDEBAR TEMPLATE
	<div>
		<h3>Title</h3>
		<div>
			{content here}
		</div>
	</div>
		
	-->

	<div>
		<h3>Indy PopCon</h3>
		<div>
			<a href="http://1morecastle.com/2014/02/meet-us-at-indy-popcon/">
				<img src="http://1morecastle.com/wp-content/uploads/2014/02/indypopcon.jpg"/>
			</a>
		</div>
	</div>
	<div>
		<h3>Get Involved</h3>
		<div>
			<a href="<?php bloginfo('url'); ?>/contribution-guidelines/">
				<img src="<?php bloginfo('template_url'); ?>/images/cta/contribute_<?php echo rand(1,3); ?>.png"/>
			</a>
		</div>
	</div>
	<?php if(ads('sidebar0') != ""){ ?>
	<div>
		<h3>Support 1MoreCastle</h3>
		<?php ads('sidebar0'); ?>
	</div>
	<?php } ?>
	<div>
		<h3>Support 1MoreCastle</h3>
		<?php ads('sidebar1'); ?>
	</div>
	<div>
		<h3>Support 1MoreCastle</h3>
		<?php ads('sidebar2'); ?>
	</div>
</aside>