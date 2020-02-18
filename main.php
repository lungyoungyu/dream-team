<?php
	
	require './config/config.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if( $mysqli->connect_errno  ) {
		exit();
	}

	$mysqli->set_charset('utf8');

	// Player Dropdown:
	$sql_players = "SELECT * FROM players;";
	$results_players = $mysqli->query($sql_players);
	if ( $results_players == false ) {
		echo $mysqli->error;
		exit();
	}

	// Players
	$sql = "SELECT players.firstname AS firstname, players.lastname AS lastname, positions.name AS position, teams.name AS team
	 		FROM players
			JOIN positions 
				ON players.position_id = positions.id
			JOIN teams
				ON players.team_id = teams.id
			WHERE 1 = 1";

	$players = $mysqli->query($sql);
	if( !$players ) {
		exit();
	}

	$sql = $sql . ";";

	if( isset($_SESSION['username']) && !empty($_SESSION['username'])) {

		if( isset($_SESSION['password']) && !empty($_SESSION['password'])) {
			// Get user id
			 $sql = "SELECT id FROM users 
			        WHERE username = '" . $_SESSION['username'] . "' AND password = '" . $_SESSION['password'] . "';";
			$results = $mysqli->query($sql);
			if(!$results) {
			    echo $mysqli->error;
			    exit();
			}

			$row = $results->fetch_assoc();
			$user_id = $row['id'];

			$_SESSION['user_id'] = $user_id;
		}
	}
	
	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DreamTeam | Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">

	<link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-expand-md navbar-light navbar-background ">
		<a class="navbar-brand"><span class="title"> DREAMTEAM. </span></a>
	  	<div class="collapse navbar-collapse" id="navbarNav">
	    	<div class="navbar-nav">
      			<a class="nav-item nav-link active"> HOME </a>
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
		<div class="row">
			<h1 class="col-12 mt-4 mb-4"><span class="title">Find your player.</span> <a class="link">Create your team.</a></h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<?php if( isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
			<?php if( isset($_SESSION['password']) && !empty($_SESSION['password'])) { ?>
				<div class="row">
					<form action="add_confirmation.php" method="POST" class="col-12" id="search-form">
						<div class="form-row">

							<div class="col-12 mt-4 col-sm-6 col-lg-4">
								<select name="player_id" id="player_id" class="form-control">
									<option value="" selected disabled> Scouting... </option>

									<?php while( $row = $results_players->fetch_assoc() ): ?>

										<option value="<?php echo $row['id']; ?>">
											<?php echo $row['firstname'] . " " . $row['lastname']; ?>
										</option>

									<?php endwhile; ?>

								</select>
							</div>

							<div class="col-12 mt-4 col-sm-auto">
								<button type="submit" class="btn btn-primary btn-block">Sign</button>
							</div>
						</div>
					</form>
				</div>
			<?php } ?>
		<?php } ?>

		<div id="players">
			<div class="row players-row">

				<?php while($row = $players->fetch_assoc() ) : ?>

					<div class="col-lg-3 col-md-4 col-xs-4 thumb">
						<div class="overlay">
							<div class="text"> <?php echo($row["firstname"] . " " . $row["lastname"]); ?> </div>
							<div class="text2"> <?php echo($row["position"] . " for the " . $row["team"]); ?> </div>
						</div>
					    <img class="img-responsive" src= <?php echo("https://nba-players.herokuapp.com/players/" . $row["lastname"] . "/" . $row["firstname"]); ?>>
					</div>

				<?php endwhile; ?>

			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>