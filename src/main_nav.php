
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
					<h4>Who We Are</h4>
					<ul>
						<?php omc_getNavWho(); ?>
					</ul>
				</div>
				<div>
					<h4>Around the Site</h4>
					<ul>
						<?php omc_getNavAround(); ?>
					</ul>
				</div>
				<div>
					<h4>Projects &amp; Friends</h4>
					<ul>
						<?php omc_getNavProjects(); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="touchcancel"></div>
</nav>