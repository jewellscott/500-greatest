<album-row>

	<?php 

	if (isset($album["rank"])) {
		$rank = str_pad($album["rank"], 3, '0', STR_PAD_LEFT);
	}
	?>

	<!-- change ranks to ids --> 
	<a href='?page=album&album=<?=$album["id"]?>'>

		<!-- make an if statement (if custom, no rank) -->

		<?php if (isset($album["rank"])) { ?>
			<h2 class="rank"><?=$rank?></h2>
		<?php };?>
		<picture>
			<img 
			src="<?=$album["coverUrl"]?>" 
			alt="<?=$album["title"]?>, <?=$album["artist"]?>">
		</picture>

		<h2 class="title"><?=$album["title"]?></h2>
		<h3 class="artist"><?=$album["artist"]?></h3>
		<h4 class="year"><?=$album["year"]?></h4>
	</a>

</album-row>