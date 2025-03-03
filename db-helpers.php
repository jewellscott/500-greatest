<?php

// declare(strict_types=1);

require_once 'vendor/autoload.php';
// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

function seedUsers($db, $faker, $fakeCount) {
	for ($i = 0; $i < $fakeCount; $i++) {
		$email = $faker->unique()->safeEmail();
		$username = $faker->unique()->userName();
        $password = password_hash('password', PASSWORD_DEFAULT);


		// insert into database // fix with prepared statements?!
		$query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
            $result = $db->exec($query);
	}
}

function seedReviews($db, $faker, $fakeCount) {

	// count existing users so we can use the (incrementing user ids)
    $uStmt = $db->query("SELECT COUNT(*) FROM users");
    $userCount = $uStmt->fetchColumn();

    if ($userCount == 0) {
    	// do nothing
        return;
    }
    
    // get the album ideas from the id column in the albums table
    $aStmt = $db->query("SELECT id FROM albums");
    // $albumIds = $aStmt->fetchAll();
    $albumIds = array_column($aStmt->fetchAll(PDO::FETCH_ASSOC), 'id');


    // add fake reviews
    for ($i = 0; $i < $fakeCount; $i++) {

        $userId = $faker->numberBetween(1, $userCount);
        $albumId = $faker->randomElement($albumIds);
		$rating = $faker->randomElement([
		    1, 1.5, 
		    2, 2, 2.5, 2.5, 
		    3, 3, 3, 3.5, 3.5, 3.5, 
		    4, 4, 4, 4.5, 4.5, 4.5,
		    5, 5, 5, 5
		]);
		// trying to do some biased seeding idk
		$review = $faker->boolean(50) ? $faker->paragraph() : null; 

        // complains about string to array conversion
    	$rStmt = $db->prepare("INSERT INTO reviews (album_id, user_id, rating, review, created) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
		$rStmt->execute([$albumId, $userId, $rating, $review]);
    }
}


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
        $signup = $db->prepare("INSERT INTO users (email, username, password, created) VALUES (?, ?, ?, CURRENT_TIMESTAMP)");
        $signup->execute([$email, $username, $password]);
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
	$stmt = $db->prepare("INSERT INTO reviews (album_id, user_id, rating, review, created) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
	$stmt->execute([$albumId, $userId, $rating, $review]);
}
