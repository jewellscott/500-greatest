<?php

function getDatabaseConnection() {
    $db = new PDO('sqlite:db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

function clearForm() {
	header("Location: " . $_SERVER['PHP_SELF']);
	exit;
}

function initializeDatabase($database) {
	$database->exec("CREATE TABLE IF NOT EXISTS users (
    	id INTEGER PRIMARY KEY AUTOINCREMENT,
    	email TEXT NOT NULL UNIQUE,
    	password TEXT NOT NULL,
    	created DATETIME DEFAULT (CURRENT_TIMESTAMP)
	)");
}

function validateUser($email, $password) {
	$errors = [];

	if (empty($email)) {
		$errors['email'] = "Please enter an email";
	}

	if (empty($password)) {
    	$errors['password'] = "Please enter a password";
	}

	return $errors;
}

function showError($errors, $name) {
	if ( isset($errors[$name]) ) {
		$message = $errors[$name];
		return "<p class='error'>$message</p>";
	}

	return "";
}

function createUser($db, $email, $password) {

	$errors = validateUser($email, $password);

	if ( !empty($errors) ) {
		return $errors;
	}

    try {
        $db->exec("INSERT INTO users (email, password, created) VALUES ('$email', '$password', CURRENT_TIMESTAMP)");
        return []; // no errors means success, right?
    } catch (Exception $error) {
        return ['database' => "Database error: " . $error->getMessage()];
    }
}

function postForm($name) {
	return $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$name]);
	// there are other request types, so - it's nice
	// to make sure you aren't just assuming what it is
}
