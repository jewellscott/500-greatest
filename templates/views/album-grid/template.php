<album-grid>
	<ul class="album-grid">

		<?php foreach ($albums as $album) { ?>
			<li class="album">

				<?php include('templates/components/album-card/template.php'); ?>

			</li>
		<?php } ?>
	</ul>
</album-grid>