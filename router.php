<?php 

	session_start();

	$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['login'])) {
	        $_SESSION['isLoggedIn'] = true;
	        $isLoggedIn = true;
	    } elseif (isset($_POST['logout'])) {
	        $_SESSION['isLoggedIn'] = false;
	        $isLoggedIn = false;
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
