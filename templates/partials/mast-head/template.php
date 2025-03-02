<mast-head>
	<nav class="site-nav">
		<a href="?page=home" class="site-logo">500 Greatest</a>

			<!-- I think I need to learn MySQL to really do anything meaningful here  -->

			<!-- <form method="POST" class="sign-in"> -->
            <?php // if ($isLoggedIn) {?>
                <!-- <button type="submit" name="logout">Logout</button> -->
            <?php // } else { ?>
            	 <!-- <button type="submit" name="sign-up">Sign Up</button>
                <button type="submit" name="login">Login</button> -->
            <?php // } ?>

	           <user-login>

	           <?php if ($isLoggedIn) {?>
	           	<a href="#" class="user-settings">
	           		<?php 

	           			$userId = $_SESSION["user"]["id"];

	           			$user = $db->query("
	           				SELECT * FROM users 
	           				WHERE id = $userId")->fetch();

	           			// var_dump($user);

	           			echo($user["username"]);
	           			// eventually this will be a component link to a user settings page

	           			// echo($_SESSION['random-album']["title"]);

	           		 ?>
	           	</a>

					<form method="POST">
	              		<button type="submit" name="logout">Logout</button>
					</form>
	            <?php } else { ?>
					 <form action="">
						<input type="hidden" name="page" value="sign-up">
				    	<button type="submit" name="signup">Sign Up</button>
					</form>
					<form action="">
						<input type="hidden" name="page" value="login">
				    	<button type="submit" name="login">Login</button>
					</form>
	            <?php } ?>
	         </form>
	     </user-login>
	</nav>
</mast-head>