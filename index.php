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

	<?php include('templates/partials/site-header/template.php'); ?>

	<main>
		<inner-column>
			
			<?php getTemplate($page); ?>

		</inner-column>
	</main>

	<footer>
		
	</footer>
	
</body>
</html>