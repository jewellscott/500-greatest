<?php 
global $db; 

$userId = $_SESSION["user"]["id"];


function getUserStats($db, $userId) {
	global $db; 
	
	$userStats = [
		'listenedCount' => 0,
		'percentageComplete' => 0,
		'averageRating' => 0,
		'topDecade' => '',
		'topGenres' => [],
		'topArtists' => [],
		'topAlbums' => []
	];

	// a bunch of queries 

	// listenedCount

    $stmt = $db->prepare("SELECT COUNT(*) FROM reviews WHERE user_id = ?");
    $stmt->execute([$userId]);
    $userStats['listenedCount'] = $stmt->fetchColumn();

	// percentComplete

    $stmt = $db->prepare("SELECT COUNT(*) FROM reviews WHERE user_id = ?");
    $stmt->execute([$userId]);
    $userStats['percentageComplete'] = ($stmt->fetchColumn() / 500 * 100);

   // averageRating

   $stmt = $db->prepare("SELECT AVG(rating) FROM reviews WHERE user_id = ?");
	$stmt->execute([$userId]);
	$userStats['averageRating'] = $stmt->fetchColumn();

   // topDecade

   $stmt = $db->prepare("
    	SELECT FLOOR(albums.year / 10) * 10 AS decade, 
   		COUNT(*) AS count 
   	FROM reviews 
  		JOIN albums ON reviews.album_id = albums.id   	
  		WHERE user_id = ? 
   	GROUP BY decade
   	ORDER BY count DESC
   	LIMIT 1;");
	$stmt->execute([$userId]);
	$userStats['topDecade'] = $stmt->fetchColumn();
	// is not actually returning the top decade
	// rounding error that I don't know how to fix

   // topGenres

   $stmt = $db->prepare("
		SELECT genre, COUNT(*) AS frequency
   	FROM reviews 
   	JOIN albums ON reviews.album_id = albums.id
   	WHERE user_id = ? 
   	GROUP BY genre
		ORDER BY frequency DESC
		LIMIT 3;");
	$stmt->execute([$userId]);
	$userStats['topGenres'] = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

   // topArtists

     $stmt = $db->prepare("
		SELECT artist, COUNT(*) AS frequency
   	FROM reviews 
   	JOIN albums ON reviews.album_id = albums.id
   	WHERE user_id = ? AND rating >= 4.5
   	GROUP BY artist
		ORDER BY frequency DESC
		LIMIT 10;");
	$stmt->execute([$userId]);
	$userStats['topArtists'] = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);


   // topAlbums

	return $userStats;
}

// $userStats = getUserStats($db, $userId);

// $listenedCount = $userStats["listenedCount"];

