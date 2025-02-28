	<?php 

		global $user; 
		global $db; 

		if (isset($_POST["create_review"])) {
			$albumId = $_POST["album_id"];
			$userId = $_POST["user_id"];
			$rating = $_POST["rating"];
			$review = $_POST["review"];

			createReview($db, $albumId, $userId, $rating, $review);

			// header("Location: " . $_SERVER['PHP_SELF']);
		}

		$userReviews = $db->query("SELECT * FROM reviews WHERE user_id == $user[id] AND album_id == '$this_album[id]'")->fetchAll();

		// var_dump($userReviews); 

		$latestRating = array_reverse($userReviews)[0]["rating"] ?? null;

		$latestReview = array_reverse($userReviews)[0]["review"] ?? null;

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
 
			<form class="rating-review" method="POST">
				<input type="hidden" name="album_id" value="<?=$this_album["id"];?>">
				<input type="hidden" name="user_id" value="<?=$user["id"]?>">

				<album-rating>
					<label for="rating">Album Rating</label>
  					<input type="range" id="rating" name="rating" min="0" max="5" step=".5" value="<?=$latestRating?>">
				</album-rating>
				<album-review>
					<label for="review">Album Review</label>
					<textarea id="review" name="review" rows="10"><?=$latestReview?></textarea>
					<!-- $TODO == RIGHT NOW THERE IS AN ERROR WITH ENCODING SPECIAL CHARACTERS....  -->
					<!-- $TODO == NEED SOME KIND OF ANIMATION OR SOMETHING TO PROVE THAT THE DATA WAS SAVED, EVEN IF IT STAYS ON THE SAME PAGE  -->

				</album-review>
				<form-actions>
					<button name="create_review">Save</button>
				</form-actions>
			</form>
		</div>
	</album-content>
</album-review>
