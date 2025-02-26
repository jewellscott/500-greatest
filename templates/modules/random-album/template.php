<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// in the future, it'll pull just from albums you HAVEN'T listened to

	global $db;

	// $albums = file_get_contents('data/albums.json');
	// $albums = json_decode($albums, true);

	$albums = $db->query("SELECT * FROM albums")->fetchAll();

	// $albums = file_get_contents('data/albums.json');
	// $albums = json_decode($albums, true);

	// $albums = $db->query("SELECT * FROM albums)")->fetchAll();

	// if it doesn't exist, generate one
	$album = $_SESSION['random-album'] ?? getRandomUnratedAlbum();

	// if the the session album is in the rated array history for the user, randomize the album

	$randomAlbum = $_SESSION['random-album'] ?? null;

	$ratedAlbums = $db->query("
    SELECT * FROM albums 
    WHERE id IN (
        SELECT album_id 
        FROM reviews 
        WHERE user_id == $_SESSION[user])")->fetchAll();

	if (array_search($randomAlbum, $ratedAlbums)) {
		getRandomUnratedAlbum();
	}

	// THIS IS WORKING BUT I HAVE TO REFRESH THE PAGE... CACHING ISSUE? IDK

	// if you click the button, get a new randomized album 
	if (isset($_POST['get-random'])) {
		getRandomUnratedAlbum();
   }

   // if they review any album, not necesarily the randomized album
   if (isset($_POST['create-review'])) {
			$ratedAlbumId = $_POST['album_id']; // Get the album ID from the form
    		$randomAlbumId = $_SESSION['random-album']['id'] ?? null;
    		// get the randomized album id

    		var_dump($ratedAlbumId);
    		var_dump($randomAlbumId);

    	if ($ratedAlbumId == $randomAlbumId) {

    		getRandomUnratedAlbum();
    
    	}
 	}

 	// $TODO THIS KINDA WORKS BUT IS TEMPERMENTAL... MIGHT BE A SESSION THING

 ?>

 <random-album>

 	<?php include('templates/components/album-card/template.php'); ?>

 	<form method="POST" class="album-actions">
 		<button type="submit" name="get-random" action="">Randomize</button>
 		<a href="?page=review&album=<?=$album['id']?>"class="rate-review">Rate and Review <?=$album['title']?></a>
 	</form>
 </random-album>
