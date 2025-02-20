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

	<album-detail>
		<?php if (isset($this_album["rank"])) {?>
			<span class="rank"><?=padRanking($this_album["rank"]);?></span>
		<?php } ?>

		<album-content>
			<picture>
				<img src="<?=$this_album["coverUrl"];?>" alt="">
			</picture>

			<div class="right">
				<album-stats>
					<h1 class="title"><?=$this_album["title"];?></h1>
					<h2 class="artist">
						<a href="">
							<?=$this_album["artist"];?>‰
						</a>
						</h2>
					<h3 class="year"><?=$this_album["year"];?></h3>
				</album-stats>

				<album-description>
					<p><?=$this_album["description"];?></p>
				</album-description>
			</div>
		</album-content>
	</album-detail>

<?php } else { ?>
	<h1>Sorry! No album found. </h1>
	<p>Go back to the <a href="?page=albums">albums</a>.</p>
<?php } ?>