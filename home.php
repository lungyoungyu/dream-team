<?php

    // Sessions
    require './config/config.php';
    $error = "";
    $nickname = "NBA";
    // If user is logged in, redirect user to home page. Don't allow them to see the login page.
    if( isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        header('Location: main.php');
    }
    else {
        // If user attempted to log in (aka submitted the form)
        if( isset($_POST['username']) && isset($_POST['password']) ){
            if( empty($_POST['username']) || empty($_POST['password']) ) {
                $error = "Please enter a username and password.";
            }
            else {
                if (isset($_POST['signup'])) {
                    // Authenticate this user by connection to the DB
                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    if($mysqli->connect_errno) {
                        exit();
                    }
                    $usernameInput = $mysqli->real_escape_string(strToLower($_POST["username"]));
                    $nickname = $_POST["username"];
                    // hash the password that user typed in
                    $passwordInput = hash("sha256", strtoLower($_POST["password"]));
                    // Look up the user table, see if there is a username/password match
                    $sql = "SELECT * FROM users 
                        WHERE username = '" . $usernameInput . "' AND password = '" . $passwordInput . "';";
                    $results = $mysqli->query($sql);
                    if(!$results) {
                        echo $mysqli->error;
                        exit();
                    }
                    if($results->num_rows > 0) {
                        $error = "Username and password have already been taken. Please choose another one.";
                    }
                    else {
                        $sql = "INSERT INTO users(username, password)
                                VALUES ('"  . $usernameInput . "', '" . $passwordInput . "');";
                        $results = $mysqli->query($sql);
                        if(!$results) {
                            echo $mysqli->error;
                        }

                        $_SESSION['logged_in'] = true;
                        $_SESSION['username'] = $usernameInput;
                        $_SESSION['display_name'] = $_POST["username"];
                        $_SESSION['password'] = $passwordInput;
                        header('Location: main.php');
                    }

                    // Close DB Connection
                    $mysqli->close();
                }
                else {
                    // Authenticate this user by connection to the DB
                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    if($mysqli->connect_errno) {
                        exit();
                    }
                    $usernameInput = $mysqli->real_escape_string(strToLower($_POST["username"]));
                    $nickname = $_POST["username"];
                    // hash the password that user typed in
                    $passwordInput = hash("sha256", strToLower($_POST["password"]));

                    // Look up the user table, see if there is a username/password match
                    $sql = "SELECT * FROM users 
                        WHERE username = '" . $usernameInput . "' AND password = '" . $passwordInput . "';";
                    $results = $mysqli->query($sql);
                    if(!$results) {
                        echo $mysqli->error;
                        exit();
                    }

                    if($results->num_rows > 0) {
                        // Log them in
                        $_SESSION['logged_in'] = true;
                        $_SESSION['username'] = $usernameInput;
                        $_SESSION['display_name'] = $_POST["username"];
                        $_SESSION['password'] = $passwordInput;
                        // Redirect user to the homepage
                        header('Location: main.php');
                    }
                    else {
                        $error = "Failed to login. Invalid username or password.";
                    }

                    // Close DB Connection
                    $mysqli->close();
                }
            }
        }
    }

    // Cookies
    setCookie($nickname);
    $expiration = time() + 1000;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Eric Yu">

        <title>DreamTeam | Login</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/home.css">
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-2"></div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                </div>
                <div class="col-lg-4 col-md-3 col-sm-2"></div>
            </div>
        </div>

        <main>
            <div class="row align-items-center justify-content-center">
                <div id="title">Welcome to <font color="DC470B">DreamTeam</font>.</div>
            </div>
            <div class="row align-items-center justify-content-center">
                <form id="form" action="home.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <button class="btn btn-primary" type="submit" name="signup">Sign Up</button>
                        <button class="btn btn-primary" type="submit" name="login">Log In</button>
                    </div>
                </form>
            </div>
            <div id="errMsg" class="row align-items-center justify-content-center text-danger" style="text-align: center;">
                <?php echo($error); ?>
            </div>
            <div class="row align-items-center justify-content-center">
                <a id="guest-link" href="main.php">Continue as Guest</a>
            </div>
        </main>

        <script type="text/javascript">
            // First line of defense - JavaScript. JS is commonly used to validate user input before it gets submitted.
            document.querySelector("#form").onsubmit = function(event) {
                var valid = true;

                // check username not empty
        		if ( document.querySelector("#username").value.trim().length < 1 ) {
                    valid = false;
                    document.querySelector("#errMsg").innerHTML = "Enter information into all fields."
                    event.preventDefault();
        		}

        		// Check that password not empty
        		if ( document.querySelector("#password").value.trim().length < 1 ) {
        			valid = false;
                    document.querySelector("#errMsg").innerHTML = "Enter information into all fields."
                    event.preventDefault();
        		}

        		return valid;
            }
        </script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
