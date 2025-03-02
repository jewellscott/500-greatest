<?php 

	// $albums = file_get_contents('data/my-albums.json');
	// $albums = file_get_contents('data/albums.json');
	// $albums = json_decode($albums, true);

global $db;
	
	// rated albums
	// $albums = $db->query("
    // SELECT * FROM albums 
    // WHERE id IN (
    //     SELECT album_id 
    //     FROM reviews 
    //     WHERE user_id == $_SESSION[user])")->fetchAll();

	//  $reviews = $db->query("
	//  	SELECT * FROM reviews
	//  	WHERE user_id == $_SESSION[user][id]")->
	//  		fetchAll();


	 // this needs to be fixed on the front end for the rating form
	 // the timestamp is not pulling the current timestamp, just the timestamp for when the function is created
	 // once it's correct, it needs to be sorted by the date/timestamp

	$userId =  $_SESSION['user']['id'];

	$albums = getUserReviewsWithAlbums($db, $userId);

	// var_dump($albums[0]);

?>

<h1>History</h1>

<album-row class="history-sort">  
	<picture>
	</picture>

	<listening-stats>
		<!-- <p>#NUM</p> -->
		<p>DATE</p>
	</listening-stats>

	<h2 class="rank">RANK</h2>
	<h2 class="title">TITLE</a></h2>
	<h3 class="artist">ARTIST</h3>
	<h4 class="year">YEAR</h4>
	<review-stats>
		<p>RATING</p>
	</review-stats>

</album-row>

<?php include('templates/views/album-list/template.php'); ?>
