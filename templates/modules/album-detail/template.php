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
	</album-detail>
