	<?php 

		global $db; 
		// global $user; 
		// var_dump($user);

		$userId = $_SESSION["user"]["id"];
		var_dump($userId);


		if (isset($_POST["create_review"])) {
			$albumId = $_POST["album_id"];
			$userId = $_POST["user_id"];
			$rating = $_POST["rating"];
			$review = $_POST["review"];

			createReview($db, $albumId, $userId, $rating, $review);

			// header("Location: " . $_SERVER['PHP_SELF']);
		}

		$userId =  $_SESSION['user']['id'];

		$userReviews = $db->query("SELECT * FROM reviews WHERE user_id == $userId AND album_id == '$this_album[id]'")->fetchAll();

	?>



<album-review>
	<?php if (isset($this_album["rank"])) {?>
		<span class="rank"><?=padRanking($this_album["rank"]);?></span>
	<?php } ?>	

	<album-content>
		<picture>
			<img src="<?=$this_album["coverUrl"];?>" alt="">
		</picture>

		<div class="right">
			<album-stats>
				<h1 class="title"><?=$this_album["title"];?></h1>
				<h2 class="artist">
					<a href="">
						<?=$this_album["artist"];?>
					</a>
					</h2>
				<h3 class="year"><?=$this_album["year"];?></h3>
			</album-stats>

			<?php if (empty($userReviews)) { ?>
 
			<form class="rating-review" method="POST">
				<input type="hidden" name="album_id" value="<?=$this_album["id"];?>">
				<input type="hidden" name="user_id" value="<?=$userId?>">

				<album-rating>
					<label for="rating">Album Rating</label>
  					<input type="range" id="rating" name="rating" min="1" max="5" step=".5">
				</album-rating>
				<album-review>
					<label for="review">Album Review</label>
					<textarea id="review" name="review" rows="10"></textarea>
				</album-review>
				<form-actions>
					<button name="create_review">Save</button>
				</form-actions>
			</form>
		<?php } else { 

			include('templates/components/user-review/template.php');
			
		 } ?>
		</div>
	</album-content>
</album-review>
