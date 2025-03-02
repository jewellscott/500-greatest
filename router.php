<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	session_start();

	global $db;

	// a way to randomly change users 

	// initializeUser();

	// var_dump($_SESSION['user']);

	$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['login'])) {
	        $_SESSION['isLoggedIn'] = true;
	        $isLoggedIn = true;

	        // $_SESSION["user"] = 0;

	        // reworking the session user to be a whole object

	       //  $_SESSION['user'] = [
		    //     'id' => 1,
		    // ];

	       initializeUser();

		    $userId = $_SESSION["user"]["id"];

	       $user = $db->query("
  				SELECT * FROM users 
  				WHERE id = $userId")->fetch();

        	  header("Location: ?page=home");
        	  exit();

	    } elseif (isset($_POST['logout'])) {
	        $_SESSION['isLoggedIn'] = false;
	        $isLoggedIn = false;
	        header("Location: ?page=home");
        	  exit();
	    }
	}

 ?>

<?php 

	/* router */
	$page = null;

	if(isset($_GET['page'])) {
		$page = $_GET['page']; // url?page=string
	} else {
		$page = "home";
	}

	function getTemplate($page) {
		include("pages/$page.php");
	};
