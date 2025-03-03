<?php 

	if (isset($album["rank"])) {
		$rank = str_pad($album["rank"], 3, '0', STR_PAD_LEFT);
	}


	$timestamp = strtotime($album['created']);
	$dateListened = date('F j, Y', $timestamp);

	?>

<album-row>
	<picture>
		<img 
		src="<?=$album["coverUrl"]?>" 
		alt="<?=$album["title"]?>, <?=$album["artist"]?>">
	</picture>

	<listening-stats>
		<!-- <p>#NUM</p> -->
		<p><?=$dateListened?></p>
	</listening-stats>

	<h2 class="rank"><?=$rank?></h2>
	<h2 class="title"><a href='?page=album&album=<?=$album["id"]?>'><?=$album["title"]?></a></h2>
	<h3 class="artist"><?=$album["artist"]?></h3>
	<h4 class="year"><?=$album["year"]?></h4>
	<review-stats>
		<p><?=$album["rating"]?></p>
		<?php if ($album["review"] != NULL) { ?>
			<p><a href='?page=review&album=<?=$album["id"]?>'>Review</a></p>
		<?php } ?>
	</review-stats>

</album-row>