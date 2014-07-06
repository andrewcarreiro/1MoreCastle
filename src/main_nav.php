
<nav class="mainnav">
	<div class="menuarea">
		<div>
			<div class="inner">
				<form role="search" method="get" action="<?php echo home_url( '/' ); ?>"  class="search mobileonly">
					<div>
						<input type="text" name="s" id="s" placeholder="Search"/>
					</div>
					<a href="#" class="submit"></a>
				</form>
				<div>
					<h4>Series</h4>
					<ul>
						<?php omc_getAllSeries(); ?>
					</ul>
				</div>
				<div>
					<h4>Authors</h4>
					<ul>
						<?php omc_getAllAuthors(); ?>
					</ul>
				</div>
				<div>
					<h4>Categories</h4>
					<ul>
						<?php omc_getNavCategories(); ?>
					</ul>
				</div>
				<div>
					<h4><?php echo omc_get_menu_title('main_nav_custom1') ?></h4>
					<ul>
						<?php omc_getNavCustom(1); ?>
					</ul>
				</div>
				<div>
					<h4><?php echo omc_get_menu_title('main_nav_custom2') ?></h4>
					<ul>
						<?php omc_getNavCustom(2); ?>
					</ul>
				</div>
				<div>
					<h4><?php echo omc_get_menu_title('main_nav_custom3') ?></h4>
					<ul>
						<?php omc_getNavCustom(3); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="touchcancel"></div>
</nav>