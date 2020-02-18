<?php
	
	require "config/config.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DreamTeam | NBA</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-light navbar-background ">
		<a class="navbar-brand"><span class="title"> DREAMTEAM. </span></a>
	  	<div class="collapse navbar-collapse" id="navbarNav">
	    	<div class="navbar-nav">
      			<a class="nav-item nav-link" href="main.php"> HOME </a>
      			<a class="nav-item nav-link" href="team.php"> MY TEAM </a>
      			<a class="nav-item nav-link active"> NBA </a>
      			<a class="nav-item nav-link" href="standings.php"> NBA STANDINGS </a>
			</div>
		</div>
		<?php if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
			<a class="navbar-brand">Welcome <span class="title"><?php echo($_SESSION['username'] . ".");?></span></a>
		<?php } ?>
		<a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
	</nav>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">30 Teams. <span class="title">One Goal.</span></h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<div id="players">
			<div class="row players-row">

					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/atlanta_hawks.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/boston_celtics.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/brooklyn_nets.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/charlotte_hornets.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/chicago_bulls.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
					    <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/cleveland_cavaliers.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
					    <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/dallas_mavericks.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/denver_nuggets.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/detroit_pistons.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/goldenstate_warriors.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/houston_rockets.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/indiana_pacers.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/la_clippers.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/la_lakers.png" >
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/memphis_grizzlies.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/miami_heat.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/milwaukee_bucks.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/minnesota_timberwolves.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/neworleans_pelicans.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/newyork_knicks.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/okc_thunder.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/orlando_magic.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/philly_sixers.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/phoenix_suns.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/portland_trailblazers.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/sacramento_kings.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/sanantonio_spurs.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
					    <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/toronto_raptors.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/utah_jazz.png">
					</div>
					<div class="col-lg-3 col-md-4 col-xs-4">
				        <img onmouseover="bigImg(this)" onmouseout="normalImg(this)" src= "logos/washington_wizards.png">
					</div>
			</div>
		</div>
	</div>

	<script>
		function bigImg(x) {
		  x.style.height = "200px";
		  x.style.width = "200px";
		}

		function normalImg(x) {
		  x.style.height = "100%";
		  x.style.width = "100%";
		}
	</script>
</body>
</html>