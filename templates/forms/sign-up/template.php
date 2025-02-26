<?php 
	
	global $db;

	$errors = [];

 ?>

 <?php 


	if ( postForm("create_user") ) {
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];

	    $errors = createUser($db, $email, $username, $password);

	    if (empty($errors) ) {
	        clearForm();
	    }
	}

 ?>

<sign-up>
	<form method="POST">
		<label for="email">Email</label>
		<input type="email" name="email" required>

		<label for="username">Username</label>
		<input type="text" name="username" required>

		<label for="password">Password</label>
		<input type="password" name="password" required>

		<button type="submit" name="create_user" value="Submit">Submit</button>
	</form>
</sign-up>


<?php

	$users = $db->query("SELECT * FROM users")->fetchAll();

?>


<?php if ( !empty($users) ): ?>

	<ul>
		<?php foreach ($users as $user) { ?>
			<li>
				<article>
					<?=$user['email']?>
				</article>
			</li>
		<?php } ?>
	</ul>

<?php else: ?>

	<p>You haven't added any users yet.</p>

<?php endif; ?>
