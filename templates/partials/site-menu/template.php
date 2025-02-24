<site-menu>
	<nav class="site-menu">

		<nav class="album-filters">
			<a href="?page=albums" class="rs-500 <?php if ($page == 'albums') {echo 'active';} ?>">Rolling Stone 500</a>
		</nav>

		<nav class="list-filters">
			<span class="nav-label">Sort by</span>
			<!--  ?page=list&filter=artist -->
			<a href="?page=albums&sort=artist" class="dead">Artist</a>
			<!-- <a href="#" class="dead">Genre</a> -->
			<!-- <a href="#" class="dead">Rating</a> -->

			<a href="?page=albums&sort=rank" class="dead">Rank</a>

			<a href="?page=albums&sort=year" class="dead">Year</a>
			<!-- <a href="#" class="dead">Label</a> -->
		</nav>

		<nav class="user-menu">
			<a href="?page=history" class="history <?php if ($page == 'history') {echo 'active';} ?>">History</a>
			<a href="?page=stats" class="stats <?php if ($page == 'stats') {echo 'active';} ?>">Stats</a>
		</nav>
	</nav>
</site-menu>