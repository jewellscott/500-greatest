<?php 

	global $db;

   $globalStats = getGlobalStats($db);

	$userCount = $globalStats["userCount"];
	$listenedCount = $globalStats["listenedCount"];
	$reviewCount = $globalStats["reviewCount"];
	$averageRating = $globalStats["averageRating"];
	$topDecade = $globalStats["topDecade"];
	$topGenres = $globalStats["topGenres"];
	$topArtists = $globalStats["topArtists"];
	$albums = $globalStats["topAlbums"];

 ?>

<h1>Global Stats</h1>

<ul class="global-stats">
	<li>userCount: <?=$userCount?></li>
	<li>listenedCount: <?=$listenedCount?></li>
	<li>reviewCount: <?=$reviewCount?></li>
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

<style>
	.global-stats {
		display: grid;
		gap: 20px;
	}
</style>