<?php

	require "./config/config.php";
	$isDeleted = false;
	if ( isset($_GET['dreamteam_id']) && !empty($_GET['dreamteam_id'])) {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}
		$sql = "DELETE FROM dreamteams WHERE dreamteams.id = " . $_GET["dreamteam_id"] .";";
		$results = $mysqli->query($sql);
		if (!$results) {
			echo $mysqli->error;
			exit();
		}
		if ($mysqli->affected_rows == 1) {
			$isDeleted = true;
		}
		$mysqli->close();
		$isDeleted = true;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DreamTeam | Release Your Player</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-light navbar-background ">
		<a class="navbar-brand"><span class="title"> DREAMTEAM. </span></a>
	  	<div class="collapse navbar-collapse" id="navbarNav">
	    	<div class="navbar-nav">
      			<a class="nav-item nav-link" href="main.php"> HOME </a>
      			<a class="nav-item nav-link" href="team.php"> MY TEAM </a>
      			<a class="nav-item nav-link" href="nba.php"> NBA </a>
      			<a class="nav-item nav-link" href="standings.php"> NBA STANDINGS </a>
			</div>
		</div>
		<?php if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
			<a class="navbar-brand">Welcome <span class="title"><?php echo($_SESSION['username'] . ".");?></span></a>
		<?php } ?>
		<a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
	</nav>
	<div class="container">
		<div class="row align-items-center justify-content-center">
        	<div><h1>This is <font color="DC470B">DreamTeam</font>.</h1></div>
        </div>
		<div class="row">
			<h1 class="title col-12 mt-4">Release Your Player.</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
					<div class="text-danger font-italic"></div>
					<div class="text-success">
						<?php if ($isDeleted == true) {?>
							<span class="font-italic">Your player was successfully released.</span>
						<?php } else {?>
							<span class="font-italic">Error. Your player was not released.</span>
						<?php } ?>
					</div>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="team.php" role="button" class="btn btn-primary">Back to your team</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>