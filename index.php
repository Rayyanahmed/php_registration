<?php include("includes/header.php"); ?>
<?php include("includes/nav.php"); ?>
	

	<div class="jumbotron">
		<h1 class="text-center"> Home Page</h1>
	</div>

	<?php

	$sql = "SELECT * FROM users";
	$result = query($sql);
	confirm($result);
	echo row_count($result);
	// Outputs 1, only have 1 datset in database right now

	 ?>


<?php include("includes/footer.php"); ?>