<?php 

	$albums = file_get_contents('data/albums.json');
	$albums = json_decode($albums, true);

	function sortByKey($albums, $key) {
		$copy = $albums;

		usort($copy, function($a, $b) use ($key) {
			if (is_numeric($a[$key])) {
				// if key is a number
				return $a[$key] - $b[$key];
			}
			return strcmp($a[$key], $b[$key]);
		});
		return $copy;
	}


	if(isset($_GET["sort"])) {
		$sort = $_GET["sort"];
		echo $sort;
		if ($sort == "artist") {
			$albums = sortByKey($albums, "artist");
		} 
		if ($sort == "rank") {
			$albums = sortByKey($albums, "rank");
		}
		if ($sort == "year") { 
			$albums = sortByKey($albums, "year"); 
		}
	}
?>

<h1>Albums</h1>

<ul class="album-list">

	<?php foreach ($albums as $album) { ?>
		<li class="album">

			<?php include('modules/album-card/template.php'); ?>

		</li>
	<?php } ?>
</ul>