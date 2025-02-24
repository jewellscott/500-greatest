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
 
			<form action="rating-review" class="rating-review">
				<album-rating>
					<label for="rating">Album Rating</label>
  					<input type="range" id="rating" name="rating" min="0" max="5" step=".5">

				</album-rating>
				<album-review>
					<label for="review">Album Review</label>

					<textarea id="review" name="review" rows="10"></textarea>
				</album-review>
				<form-actions>
					<button action="save-rating-review">Save</button>
				</form-actions>
			</form>
		</div>
	</album-content>
</album-review>
