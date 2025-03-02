<?php 
global $db; 

// $user = $db->query("
// 	SELECT * FROM users 
// 	WHERE id = $userId")->fetch();

$userId = $_SESSION["user"]["id"];


function getUserStats($userId) {
	global $db; 
	
	$userStats = [
		'listenedCount' => 0,
		'percentComplete' => 0,
		'averageRating' => 0,
		'topDecade' => '',
		'topGenres' => [],
		'topArtists' => [],
		'topAlbums' => []
	];

	// a bunch of queries 

    $stmt = $db->prepare("SELECT COUNT(*) FROM reviews WHERE user_id = ?");
    // $stmt->execute([$userId]);
    // $stats['listenedCount'] = $stmt->fetchColumn();

	var_dump($userId);

	return $userStats;
}

getUserStats($userId);