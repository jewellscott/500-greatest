<!DOCTYPE html>

<?php require('router.php'); ?>
<?php require('functions.php'); ?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>500 Greatest</title>
	<link rel="stylesheet" href="css/site.css">
</head>
<body>

	<header>

		<inner-column>
			<?php include('modules/mast-head/template.php'); ?>
			
			<span class="query"><?php echo $_SERVER["QUERY_STRING"]; ?></span>

	
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
					<a href="?page=my-albums" class="my-albums <?php if ($page == 'my-albums') {echo 'active';} ?>">My Albums</a>
					<a href="?page=add-album" class="add-album <?php if ($page == 'add-album') {echo 'active';} ?>">+ Add Album</a>
				</nav>
			</nav>

	
		</inner-column>

	</header>

	<main>
		<inner-column>
			
			<?php getTemplate($page); ?>

		</inner-column>
	</main>

	<footer>
		
	</footer>
	
</body>
</html>