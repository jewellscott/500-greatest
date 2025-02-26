
<?php $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;

	global $db;
 ?>

<?php if ($isLoggedIn) {


		$user = $db->query("
			SELECT * FROM users 
			WHERE id == $_SESSION[user]")->fetch();


	 $ratedAlbums = $db->query("
    SELECT * FROM albums 
    WHERE id IN (
        SELECT album_id 
        FROM reviews 
        WHERE user_id == $_SESSION[user])")->fetchAll();

	 $percentageCompleted = count($ratedAlbums) / 500;
	 $completed = count($ratedAlbums);

	?>

	<!-- Show the latest album you randomized, and the option to generate another. Maybe also show the percentage completed.  -->

	<!-- this needs to be its own module -->

	<p>Welcome back, <?=$user["username"]?>!</p>
	<!-- <p>You have listened to  <?=$percentageCompleted?>% of the albums.</p> -->

	<p>You have listened to <?=$completed?> out of 500 albums.</p>


	<?php include('templates/modules/random-album/template.php'); ?>

<?php } else { ?>

	Show some spiel about the app.

<?php } ?>
