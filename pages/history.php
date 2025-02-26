<?php 

	// $albums = file_get_contents('data/my-albums.json');
	// $albums = file_get_contents('data/albums.json');
	// $albums = json_decode($albums, true);

global $db;

	 $albums = $db->query("
    SELECT * FROM albums 
    WHERE id IN (
        SELECT album_id 
        FROM reviews 
        WHERE user_id == $_SESSION[user])")->fetchAll();
?>

<h1>History</h1>

<?php include('templates/views/album-list/template.php'); ?>
