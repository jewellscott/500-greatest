<?php 

	global $db;

    $userId = $_SESSION["user"]["id"];

    $user = $db->query("
			SELECT * FROM users 
			WHERE id = $userId")->fetch();

 ?>

<h1><?=$user["username"]?>'s Stats</h1>

just loop through all of the attributes of a huge user stats object