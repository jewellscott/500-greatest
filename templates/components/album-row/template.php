<album-row>

	<?php 

	if (isset($album["rank"])) {
		$rank = str_pad($album["rank"], 3, '0', STR_PAD_LEFT);
	}
	?>

	<a href='?page=album&album=<?=$album["id"]?>'>

		<picture>
			<img 
			src="<?=$album["coverUrl"]?>" 
			alt="<?=$album["title"]?>, <?=$album["artist"]?>">
		</picture>

		<listening-stats>
			<p>#<?=$rank?></p>
			<p>February 24, 2025</p>
		</listening-stats>
	
		<h2 class="rank"><?=$rank?></h2>
		<h2 class="title"><?=$album["title"]?></h2>
		<h3 class="artist"><?=$album["artist"]?></h3>
		<h4 class="year"><?=$album["year"]?></h4>
		<p class="rating">⭐️⭐️⭐️⭐️⭐️</p>
		<p class="review">Review (link)</p>

	</a>

</album-row>