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

	// update this to have the logged in thing. only show the home page and the full list of 500. - basically i need two separate headers

	function getTemplate($page) {
		include($page . '.php');
	};
