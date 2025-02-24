<?php 

	// $albums = file_get_contents('data/my-albums.json');
	$albums = file_get_contents('data/albums.json');
	$albums = json_decode($albums, true);

?>

<h1>History</h1>

<?php include('templates/modules/album-list/template.php'); ?>
