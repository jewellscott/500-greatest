<?php 

global $db;

function getData($fileName) {
	$path = "data/$fileName";
	if ( file_exists($path) ) {
		$json = file_get_contents($path);
		return json_decode($json, true);			
	} 
	return null;
}


function getRandomUnratedAlbum() {

	$_SESSION['random-album'] = null;
	// clear the session album

	global $db;

	$albums = $db->query("
    SELECT * FROM albums 
    WHERE id NOT IN (
        SELECT album_id 
        FROM reviews 
        WHERE user_id == $_SESSION[user])")->fetchAll();


		$key = array_rand($albums, 1);

		$album = $albums[$key];
		// get a new album


   	$_SESSION['random-album'] = $album;
   	// set the session album again

		return $album;
	}
