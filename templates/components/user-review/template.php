<?php 

	$userId =  $_SESSION['user']['id'];

	$userReviews = $db->query("SELECT * FROM reviews WHERE user_id == $userId AND album_id == '$this_album[id]'")->fetchAll();

	// var_dump($userReviews);

	$latestRating = array_reverse($userReviews)[0]["rating"];

	$latestReview = array_reverse($userReviews)[0]["review"] ?? "No review. I guess there should be an option to ADD a review after the fact... ugh";

	$rawDateReviewed = array_reverse($userReviews)[0]["created"];

	$timestamp = strtotime($rawDateReviewed);

	$dateReviewed = date('F j, Y', $timestamp);


 ?>

<user-review>
	<p>Star rating: <?=$latestRating?> stars</p>
	<p>Review: <?=$latestReview?></p>
	<p>Timestamp: <?=$dateReviewed?></p>


</user-review>