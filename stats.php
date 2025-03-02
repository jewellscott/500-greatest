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

   $stmt = $db->prepare("SELECT ROUND(AVG(rating), 2) FROM reviews WHERE user_id = ?");
	$stmt->execute([$userId]);
	$userStats['averageRating'] = $stmt->fetchColumn();

   // topDecade

	$stmt = $db->prepare(" 
		SELECT FLOOR(year / 10) * 10 AS decade, COUNT(*) AS count
	  	FROM reviews
	    JOIN albums ON reviews.album_id = albums.id
	    WHERE user_id = ? AND rating >= 5
	    GROUP BY decade
	    ORDER BY count DESC
	    LIMIT 1;
	");
	$stmt->execute([$userId]);
	$userStats['topDecade'] = $stmt->fetchColumn();

   // topGenres

   $stmt = $db->prepare("
		SELECT genre, COUNT(*) AS frequency
   	FROM reviews 
   	JOIN albums ON reviews.album_id = albums.id
   	WHERE user_id = ? AND rating >= 4.5
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
   	WHERE user_id = ? AND rating = 5
   	GROUP BY artist
		ORDER BY frequency DESC
		LIMIT 10;");
	$stmt->execute([$userId]);
	$userStats['topArtists'] = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

   // topAlbums

   $stmt = $db->prepare("
		SELECT * 
   	FROM albums 
   	JOIN reviews ON albums.id = reviews.album_id
   	WHERE user_id = ? AND rating = 5
   	ORDER BY rank ASC
		LIMIT 100;");
	$stmt->execute([$userId]);
	$userStats['topAlbums'] = $stmt->fetchAll();


	return $userStats;
}

function getGlobalStats($db) {
	global $db; 
	
	$globalStats = [
		'userCount' => 0,
		'listenedCount' => 0,
		'reviewCount' => 0,
		'averageRating' => 0,
		'topDecade' => '',
		'topGenres' => [],
		'topArtists' => [],
		'topAlbums' => []
	];

	// a bunch of queries 

	// userCount

	  $stmt = $db->query("SELECT COUNT(*) FROM users");
    $globalStats['userCount'] = $stmt->fetchColumn();


	// listenedCount

    $stmt = $db->query("SELECT COUNT(*) FROM reviews");
    $globalStats['listenedCount'] = $stmt->fetchColumn();

  // reviewCount

    $stmt = $db->query("SELECT COUNT(review) FROM reviews WHERE review IS NOT NULL");
    $globalStats['reviewCount'] = $stmt->fetchColumn();


  // averageRating

   	$stmt = $db->query("SELECT ROUND(AVG(rating), 2) FROM reviews");
    $globalStats['averageRating'] = $stmt->fetchColumn();

	// topDecade

   $stmt = $db->query(" 
		SELECT FLOOR(year / 10) * 10 AS decade, COUNT(*) AS count
	  	FROM reviews
	    JOIN albums ON reviews.album_id = albums.id
	    WHERE rating >= 5
	    GROUP BY decade
	    ORDER BY count DESC
	    LIMIT 1;
	");
	$globalStats['topDecade'] = $stmt->fetchColumn();

	// topGenres

	 $stmt = $db->query("
		SELECT genre, COUNT(*) AS frequency
   	FROM reviews 
   	JOIN albums ON reviews.album_id = albums.id
   	WHERE rating >= 5
   	GROUP BY genre
		ORDER BY frequency DESC
		LIMIT 3;");
	$globalStats['topGenres'] = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// topArtists

  $stmt = $db->query("
		SELECT artist, COUNT(*) AS frequency
   	FROM reviews 
   	JOIN albums ON reviews.album_id = albums.id
   	WHERE rating >= 4.5
   	GROUP BY artist
		ORDER BY created ASC
		LIMIT 10;");
	$globalStats['topArtists'] = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// topAlbums 

	$stmt = $db->query("
		SELECT * 
   	FROM albums 
   	JOIN reviews ON albums.id = reviews.album_id
   	WHERE rating >= 4.5
   	ORDER BY rating DESC
		LIMIT 20;"); 
	$globalStats['topAlbums'] = $stmt->fetchAll();
// maybe edit this to add a rating so i can

	return $globalStats;
}


