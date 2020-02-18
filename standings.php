<?php
	
	require "config/config.php";

	// cURL API 

	// Current NBA Standings
	$url = "http://data.nba.net/prod/v1/current/standings_all.json";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);

	$json_object = json_decode($result, true);

	$standings = $json_object["league"]["standard"]["teams"];


	// NBA Teams
	$url = "http://data.nba.net/prod/v1/2019/teams.json";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);

	$json_object = json_decode($result, true);

	$teams = $json_object["league"]["standard"];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DreamTeam | NBA Standings</title>
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
      			<a class="nav-item nav-link" href="nba.php"> NBA </a>
      			<a class="nav-item nav-link active"> NBA STANDINGS </a>
			</div>
		</div>
		<?php if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
			<a class="navbar-brand">Welcome <span class="title"><?php echo($_SESSION['username'] . ".");?></span></a>
		<?php } ?>
		<a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">LOGOUT</a>
	</nav>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4"><span class="title">Current Season.</span> <a class="link">NBA Standings.</a></h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Conference Rank</th>
							<th>Team Name</th>
							<th>Overall Wins / Losses</th>
							<th>Current Win Streak</th>
							<th>Win Percentage</th>
							<th>Conference Wins / Losses</th>
							<th>Home Wins / Losses</th>
							<th>Away Wins / Losses</th>
							<th>Last Ten Wins / Losses</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($standings as $team) { ?>
							<tr>
								<td><?php echo $team["confRank"];?></td>
								<td>
									<?php 
										$teamName = "";
										for ($index = 0; $index < sizeof($teams); $index++) {
											if($teams[$index]["isNBAFranchise"] == true && $teams[$index]["teamId"] == $team["teamId"]) {
												$teamName = $teams[$index]["fullName"];
											}
										}
										echo $teamName;
									?>
								</td>
								<td><?php echo $team["win"] . " / " . $team["loss"];?></td>
								<td><?php echo $team["streak"];?></td>
								<td><?php echo $team["winPct"];?></td>
								<td><?php echo $team["confWin"] . " / " . $team["confLoss"];?></td>
								<td><?php echo $team["homeWin"] . " / " . $team["homeLoss"];?></td>
								<td><?php echo $team["awayWin"] . " / " . $team["awayLoss"];?></td>
								<td><?php echo $team["lastTenWin"] . " / " . $team["lastTenLoss"];?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div>
</body>
</html>