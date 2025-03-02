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
			<a href="?page=my-stats" class="my-stats <?php if ($page == 'my-stats') {echo 'active';} ?>">My Stats</a>
			<a href="?page=global-stats" class="global-stats <?php if ($page == 'global-stats') {echo 'active';} ?>">Global Stats</a>
		</nav>
	</nav>
</site-menu>