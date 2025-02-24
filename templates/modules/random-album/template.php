<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// in the future, it'll pull just from albums you HAVEN'T listened to

	$albums = file_get_contents('data/albums.json');
	$albums = json_decode($albums, true);

	function getRandomAlbum() {

		// get all albums
		// i had to initialize this stuff again... it wouldn't work otherwise

			$albums = file_get_contents('data/albums.json');
			$albums = json_decode($albums, true);

		// get a random one

		$key = array_rand($albums, 1);

		$album = $albums[$key];

		$_SESSION['random-album'] = $album;

		return $album;
	}

	$album = $_SESSION['random-album'] ?? getRandomAlbum();

	if (isset($_POST['get-random'])) {
		$_SESSION['random-album'] = null;
		// i had to add this! couldn't just ovewrite it

   	$album = getRandomAlbum();
   	$_SESSION['random-album'] = $album;
   }

 ?>

 <random-album>
 	<?php include('templates/modules/album-card/template.php'); ?>

 	<form method="POST" class="album-actions">
 		<button type="submit" name="get-random" action="">Randomize</button>
 		<a href="?page=review&album=<?=$album['id']?>"class="rate-review">Rate and Review <?=$album['title']?></a>
 	</form>
 </random-album>
