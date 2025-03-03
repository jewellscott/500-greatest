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
	// var_dump("user object: " , $_SESSION['user']);
	// this says random album isn't being set.

	// var_dump($_SESSION['user']['random-album']);

	// if it doesn't exist, generate one
	$album = $_SESSION['user']['random-album'] ?? setRandomUnratedAlbum();

	// if (array_key_exists('random-album', $_SESSION['user'])) {
	// 	echo("ughhhh");
	// 	$album = $_SESSION['user']['random-album'];
	// } else {
	// 	$album = setRandomUnratedAlbum();
	// }

	// if the the session album is in the rated array history for the user, randomize the album

	$userId =  $_SESSION['user']['id'];

	$randomAlbum = $_SESSION['user']['random-album'] ?? null;

	$ratedAlbums = $db->query("
    SELECT * FROM albums 
    WHERE id IN (
        SELECT album_id 
        FROM reviews 
        WHERE user_id = $userId)")->fetchAll();

	if (array_search($randomAlbum, $ratedAlbums)) {
		echo ("the randomized album has already been rated! so something is glitched.");

		setRandomUnratedAlbum();
	}

	// THIS IS WORKING BUT I HAVE TO REFRESH THE PAGE... CACHING ISSUE? IDK

	// if you click the button, get a new randomized album 

	if (isset($_POST['get-random'])) {
		setRandomUnratedAlbum();
		header("Location: ?page=home");
        exit();
   }

   // if they review any album, not necesarily the randomized album
   if (isset($_POST['create-review'])) {
			$ratedAlbumId = $_POST['album_id']; // Get the album ID from the form
    		$randomAlbumId = $_SESSION['user']['random-album']['id'] ?? null;
    		// get the randomized album id

    		// var_dump($ratedAlbumId);
    		// var_dump($randomAlbumId);

    	if ($ratedAlbumId == $randomAlbumId) {

    		setRandomUnratedAlbum();

    		// header("Location: ?page=home");
        	// exit();
    
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
