	<?php 

		global $db;

		$globalReviews = $db->query("
			SELECT reviews.*, users.username
			FROM reviews
			JOIN users ON reviews.user_id = users.id
			WHERE album_id == '$this_album[id]'
			AND review IS NOT NULL")->fetchAll();

		// var_dump($globalReviews[0]);

	 ?>

	<album-detail>
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

				<album-description>
					<p><?=$this_album["description"];?></p>
				</album-description>
			</div>
		</album-content>

		<album-stats>

			will have some general album stats

		</album-stats>

		<album-reviews>

			global reviews from users

			<?php foreach ($globalReviews as $review) { ?>

				<?php 	
					$timestamp = strtotime($review['created']);
					$dateReviewed = date('F j, Y', $timestamp);
 				?>
				<!-- will be its own module -->
				<global-review>
					<ul>
						<li><a href="#"><?=$review['username']?></a></li>
						<li>RATING: <?=$review['rating']?></li>
						<li>REVIEW: <?=$review['review']?></li>
						<li>DATE: <?=$dateReviewed?></li>
					</ul>
				</global-review>
			<?php } ?> 
		</album-reviews>
	</album-detail>

	<style>
		album-content, album-stats, album-reviews {
			margin-bottom: 4rem;
		}

		album-reviews {
			display: grid;
			gap: 20px;
			a {
				font-weight: bold;
				color: blue;
			}
		}
	</style>
