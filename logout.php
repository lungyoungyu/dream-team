<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DreamTeam | Logout</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/logout.css">

</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="title col-12 mt-4 mb-4">Logout.</h1>
			<div class="col-12">You are now logged out.</div>
			<div class="col-12 mt-3">You can go to the <a class="link" href="home.php">home page</a> and log in again.</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

</body>
</html>