<?php
	
	require './config/config.php';

	if( isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if( $mysqli->connect_errno  ) {
			exit();
		}

		$mysqli->set_charset('utf8');

		$userid = $_SESSION['user_id'];

		// DreamTeam Players
		$sql = "SELECT dreamteams.id AS id, players.firstname AS firstname, players.lastname AS lastname, positions.name AS position, teams.name AS team, players.awards AS awards, dreamteams.notes AS notes
		 		FROM dreamteams
		 		JOIN players
		 			ON players.id = dreamteams.player_id
				JOIN positions 
					ON players.position_id = positions.id
				JOIN teams
					ON players.team_id = teams.id
				WHERE dreamteams.user_id = ";

		$sql = $sql . $userid;

		$results = $mysqli->query($sql);
		if( !$results ) {
			exit();
		}

		$sql = $sql . ";";


		// Player Dropdown:
		$sql_players = "SELECT * FROM players;";
		$results_players = $mysqli->query($sql_players);
		if ( $results_players == false ) {
			echo $mysqli->error;
			exit();
		}

		// Players
		$sql = "SELECT dreamteams.id AS id, players.firstname AS firstname, players.lastname AS lastname, dreamteams.notes AS notes, players.id AS player_id
		 		FROM dreamteams
		 		JOIN players
		 			ON dreamteams.player_id = players.id
				WHERE dreamteams.user_id = ";

		$sql = $sql . $userid;

		$players = $mysqli->query($sql);
		if( !$players ) {
			exit();
		}

		$sql = $sql . ";";

		$mysqli->close();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DreamTeam | The Team</title>
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
      			<a class="nav-item nav-link active"> MY TEAM </a>
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
        <div class="row">
			<h1 class="col-12 mt-4 mb-4"><a class="link">Find your player.</a> <span class="title">Create your team.</span></h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<?php if( isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					Roster Size: <?php echo $results->num_rows; ?>

				</div> <!-- .col -->
				<div class="col-12">
					<table class="table table-hover table-responsive mt-4">
						<thead>
							<tr>
								<th></th>
								<th>Photo</th>
								<th>Name</th>
								<th>Position</th>
								<th>Team(s)</th>
								<th>Career Highlights/Awards</th>
								<th>Notes</th>
							</tr>
						</thead>
						<tbody>
							<?php while($row = $results->fetch_assoc() ) : ?>

								<tr>
									<td>
										<a href="delete.php?dreamteam_id=<?php echo $row['id']?>" class="btn btn-outline-danger delete-btn">
											Release
										</a>
									</td>
									<td>
										<img class="img-responsive" src= <?php echo("https://nba-players.herokuapp.com/players/" . $row["lastname"] . "/" . $row["firstname"]); ?>>
									</td>
									<td>
										<?php 
											if (!empty($row["firstname"]) && !empty($row["lastname"])) {
												echo $row["firstname"] . " " . $row["lastname"];
											}
										?>
									</td>
									<td><?php echo $row["position"]?></td>
									<td><?php echo $row["team"];?></td>
									<td><?php echo $row["awards"];?></td>
									<td><?php echo $row["notes"];?></td>
								</tr>

							<?php endwhile;?>
						</tbody>
					</table>
				</div> <!-- .col -->
			</div> <!-- .row -->

			<div class="container">
				<form action="update_confirmation.php" method="POST">
					<div class="form-group row">
						<label for="notes-id" class="col-sm-3 col-form-label text-sm-right">Select Player:</label>
						<div class="col-sm-9">
							<select name="player_id" id="player_id" class="form-control">
								<option value="" selected disabled> Select... </option>

								<?php while( $row = $players->fetch_assoc() ): ?>

									<option value="<?php echo $row['player_id'];?>">
										<?php echo $row['firstname'] . " " . $row['lastname']; ?>
									</option>

								<?php endwhile; ?>

							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="notes-id" class="col-sm-3 col-form-label text-sm-right">Player Notes:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="notes-id" name="notes">
						</div>
					</div> <!-- .form-group -->
					<div class="form-group row">
						<div class="col-sm-3"></div>
						<div class="col-sm-9 mt-2">
							<button type="update" class="btn btn-primary">Update</button>
						</div>
					</div> <!-- .form-group -->
				</form>
			</div> <!-- .container -->

			<div class="row mt-4 mb-4">
				<div class="col-12">
					<a href="main.php" role="button" class="btn btn-primary">Back to Scouting</a>
				</div> <!-- .col -->
			</div> <!-- .row -->
		</div> <!-- .container-fluid -->
	<?php } ?>
</body>
</html>