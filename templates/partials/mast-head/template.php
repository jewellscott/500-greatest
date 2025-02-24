<mast-head>
	<nav>
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