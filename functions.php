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


function setRandomUnratedAlbum() {

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


function getUserReviewsWithAlbums($db, $userId) {
    $stmt = $db->prepare("
    	SELECT 
        reviews.*, 
        albums.*
        -- albums.rank AS rank,
        -- albums.title AS title,
        -- albums.artist AS artist, 
        -- albums.year AS year,
        -- albums.coverUrl AS coverUrl
      FROM reviews
      JOIN albums ON reviews.album_id = albums.id
      WHERE reviews.user_id = ?
      ORDER BY reviews.created ASC");

    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all as associative array
}