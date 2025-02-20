<?php 

	$formSubmitted = isset($_POST["add"]);

	function slugify($title) {
		// lowercase
		$lower = strtolower($title);
		// spaces
		$dashed = preg_replace('/[^a-z0-9]+/', '-', $lower);
		// trim spaces
		$trimmed = trim($dashed);
		return $trimmed;
		// special char
	} 

	if($formSubmitted) {
		$album = $_POST;
		// echo 'Added ' . $newAlbum["title"] . ' by ' . $newAlbum["artist"] . ' (' . $newAlbum["year"] . ')';

		// var_dump($newAlbum);

		// create album

		$newAlbum = [
			"id" => uniqid(),
			"slug" => slugify($album["title"]),
			"title" => htmlspecialchars($album["title"]),
			"artist" => htmlspecialchars($album["artist"]),
			"year" => $album["year"],
			"coverUrl" => $album["cover-url"],
			"description" => htmlspecialchars($album["description"]),
		];

		file_put_contents("data/my-albums.json", json_encode([$newAlbum]));

		// header(“Location: https://www.example.com/”)

		// save album
	};

?>

<h1>Add Album</h1>

<form method="POST">

	<fieldset>
		<label for="">Title</label>
		<input 
			name="title" 
			type="text"
			required
			>
	</fieldset>

	<fieldset>
		<label for="">Artist</label>
		<input 
			name="artist" 
			type="text"
			required
			>
	</fieldset>

	<fieldset>
		<label for="">Year</label>
		<input 
			name="year" 
			type="number" 
			value="<?=date("Y")?>"
			min="1900" 
			max="2030" 
			step="1"
			required
			>
	</fieldset>

	<fieldset>
		<label for="">Cover URL</label>
		<input 
			name="cover-url" 
			type="text"
			pattern="https?://.*\.(?:png|jpg|jpeg)"
			required
			>
	</fieldset>

	<fieldset>
		<label for="">Description</label>
		<input 
			name="description" 
			type="text"
			required
			>
	</fieldset>

	<button 
		type="submit" 
		name="add"
		required
		>
		Add Album
	</button>

</form>