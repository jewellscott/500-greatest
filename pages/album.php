<?php 

	function getAlbums() {

		$greatestAlbums = getData('albums.json');
		$myAlbums = getData('my-albums.json');

		return array_merge($greatestAlbums, $myAlbums);
	}

	function getAlbumById($albums, $id) {
		foreach($albums as $album) {
			if ($id == $album["id"]) {
				return $album;
			} 
		}
		return null;	 		
 	}

	function padRanking($rank) {
		return str_pad($rank, 3, '0', STR_PAD_LEFT);
	}
?>


<?php 
	$this_album_id = $_GET["album"];
 	$albums = getAlbums();

 	$this_album = getAlbumById($albums, $this_album_id);
?>


<?php if (isset($this_album)) { ?>
	<?php include('templates/modules/album-detail/template.php'); ?>

<?php } else { ?>
	<h1>Sorry! No album found. </h1>
	<p>Go back to the <a href="?page=albums">albums</a>.</p>
<?php } ?>