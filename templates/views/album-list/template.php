<album-list>
	
	<ul class="album-list">

	<?php

	foreach (array_reverse($albums) as $album) { ?>

		<li class="album">
			<?php include('templates/components/album-row/template.php'); ?>
		</li>

	<?php } ?>

</ul>
</album-list>