<?php 

	$albums = file_get_contents('data/my-albums.json');
	$albums = json_decode($albums, true);

?>

<h1>My Albums</h1>

<ul class="album-list">

	<?php

	foreach (array_reverse($albums) as $album) { ?>

		<li class="album">
			<?php include('templates/modules/album-card/template.php'); ?>
		</li>

	<?php } ?>

</ul>