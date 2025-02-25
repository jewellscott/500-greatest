<?php 

	$db = getDatabaseConnection();

	// i have to call this on every page. should be on every module that uses the database or should i put it in the header somewhere


	$errors = [];

 ?>

 <?php 


	if ( postForm("create_user") ) {
		$email = $_POST['email'];
		$password = $_POST['password'];

	    $errors = createUser($db, $email, $password);

	    if (empty($errors) ) {
	        clearForm();
	    }
	}

 ?>

<sign-up>
	<form method="POST">
		<label for="email">Email</label>
		<input type="email" name="email" required>

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
