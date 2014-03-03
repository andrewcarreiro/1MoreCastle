<footer class="mainfooter">
	<div>
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
			<h4>Consoles</h4>
			<ul>
				<?php omc_getNavConsoles(); ?>
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
</footer>