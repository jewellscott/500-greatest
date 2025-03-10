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


function initializeUser() {
    $_SESSION['user'] = [
        'id' => 1,
        'random-album' => NULL
   ];

   return;
}

function setRandomUnratedAlbum() {
    // echo "SET RANDOM UNRATED IS BEING CALLED";

	$_SESSION['user']['random-album'] = NULL;
	// clear the session album

	global $db;

    $userId =  $_SESSION['user']['id'];


	$albums = $db->query("
    SELECT * FROM albums 
    WHERE id NOT IN (
        SELECT album_id 
        FROM reviews 
        WHERE user_id = $userId)")->fetchAll();

		$key = array_rand($albums, 1);

		$album = $albums[$key];
		// get a new album


   	$_SESSION['user']['random-album'] = $album;
   	// set the session album again


    // DEBUG
    // var_dump($_SESSION['user']['random-album']);
    // it is actually setting it, so...

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