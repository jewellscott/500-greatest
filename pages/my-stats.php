<?php 

	global $db;

    $userId = $_SESSION["user"]["id"];

    $user = $db->query("
			SELECT * FROM users 
			WHERE id = $userId")->fetch();

   $userStats = getUserStats($db, $userId);

	$listenedCount = $userStats["listenedCount"];
	$percentageComplete = $userStats["percentageComplete"];
	$averageRating = $userStats["averageRating"];
	$topDecade = $userStats["topDecade"];
	$topGenres = $userStats["topGenres"];
	$topArtists = $userStats["topArtists"];
	$albums = $userStats["topAlbums"];

 ?>

<h1><?=$user["username"]?>'s Stats</h1>

just loop through all of the attributes of a huge user stats object

<ul>
	<li>listenedCount: <?=$listenedCount?></li>
	<li>percentComplete: <?=$percentageComplete?></li>
	<li>averageRating: <?=$averageRating?></li>
	<li>topDecade: <?=$topDecade?></li>
	<li>topGenres:</li>
	<ul>
		<?php foreach($topGenres as $genre) { ?>
			<li><?=$genre?></li>
		<?php } ?>
	</ul>
		<li>topArtists:</li>
	<ul>
		<?php foreach($topArtists as $artist) { ?>
			<li><?=$artist?></li>
		<?php } ?>
	</ul>
	<li>topAlbums:</li>
	<?php include('templates/views/album-grid/template.php'); ?>
</ul>