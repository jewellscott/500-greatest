
<?php $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
 ?>

<?php if ($isLoggedIn) { ?>

	Show the latest album you randomized, and the option to generate another. Maybe also show the percentage completed. 

<?php } else { ?>

	Show some spiel about the app.

<?php } ?>
