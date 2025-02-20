<mast-head>
	<nav>
		<a href="?page=home" class="site-logo">500 Greatest</a>

			<!-- I think I need to learn MySQL to really do anything meaningful here  -->

			<form method="POST" class="sign-in">
            <?php if ($isLoggedIn) {?>
                <button type="submit" name="logout">Logout</button>
            <?php } else { ?>
            	 <button type="submit" name="sign-up">Sign Up</button>
                <button type="submit" name="login">Login</button>
            <?php } ?>
         </form>
	</nav>
</mast-head>