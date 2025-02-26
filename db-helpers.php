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

	// $database->exec("PRAGMA foreign_keys = ON;");

	// create album data here

	$database->exec("CREATE TABLE IF NOT EXISTS users (
    	id INTEGER PRIMARY KEY AUTOINCREMENT,
    	email TEXT NOT NULL UNIQUE,
    	username TEXT NOT NULL UNIQUE,
    	password TEXT NOT NULL,
    	created DATETIME DEFAULT (CURRENT_TIMESTAMP)
	)");

	$database->exec("CREATE TABLE IF NOT EXISTS reviews (
    	id INTEGER PRIMARY KEY AUTOINCREMENT,
    	user_id INTEGER NOT NULL,
    	-- FOREIGN KEY (user_id) REFERENCES users(id),
    	album_id TEXT NOT NULL,
    	-- FOREIGN KEY (album_id) REFERENCES albums(id),
    	rating INTEGER, 
    	review TEXT,
    	created DATETIME DEFAULT (CURRENT_TIMESTAMP)
	)");
}



function validateUser($email, $username, $password) {
	$errors = [];

	if (empty($email)) {
		$errors['email'] = "Please enter an email";
	}

	if (empty($username)) {
		$errors['username'] = "Please enter an email";
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

function createUser($db, $email, $username, $password) {

	$errors = validateUser($email, $username, $password);

	if ( !empty($errors) ) {
		return $errors;
	}

    try {
        $db->exec("INSERT INTO users (email, username, password, created) VALUES ('$email', '$username', '$password', CURRENT_TIMESTAMP)");
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

function createReview($db, $albumId, $userId, $rating, $review) {
	$db->exec("INSERT INTO reviews (album_id, user_id, rating, review, created) VALUES ('$albumId', '$userId', '$rating', '$review', CURRENT_TIMESTAMP)");
}
