<header class="site-header">

		<inner-column>
			<?php include('templates/modules/mast-head/template.php'); ?>
			
			<!-- <span class="query"><?php echo $_SERVER["QUERY_STRING"]; ?></span> -->



			<?php if ($isLoggedIn) { 
				include('templates/partials/site-menu/template.php'); 
				}
			 ?>

		</inner-column>

</header>