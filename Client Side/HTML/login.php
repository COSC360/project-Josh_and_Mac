<!DOCTYPE html>
<html>
<head>
	<title>Login / Signup</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <!-- <script type="text/javascript" src="../script/validation.js"></script> -->
</head>
<header>
   <?php session_start(); include "navbar.php";?>
</header>
<body>
	<h1>Login/Sign Up</h1>
	<div>
		<div class="columnleft">
			<form action="authenticate.php" method="post" id="loginForm">
                    <h2>Login</h2>
                    <p>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username">
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </p>
                    <button type="submit">Login</button>
                    <!-- <a href="#" class="btn btn-info" role="button">forgot password?</a>-->
                    <?php if(isset($_SESSION["login_error"])) { 
                        echo "<h3>".$_SESSION["login_error"]."</h3>";
                        unset($_SESSION["login_error"]);
                        }
                    ?>
			</form>
		</div>
		<div class="columnright">
			<form method="post" action="newuser.php" id="signupForm">
                    <h2>Create a Free Account</h2> 
                    <p>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" >
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" >
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" >
                    </p>
                    <p>
                        <label for="updates">Receive Email Updates?</label>
                        <input type="checkbox" name="updates" value=1>
                    </p>
                    <button type="submit">Register</button>
                    <button type="reset">Clear</button>
                    <?php if(isset($_SESSION["newuser_msg"])) { 
                        echo "<h3>".$_SESSION["newuser_msg"]."</h3>";
                        unset($_SESSION["newuser_msg"]);
                        }
                    ?>
			</form>
        </div> 
        </div>
        </body>
        <footer>
            <p>
                <a href="home.html">Home</a> |
                <a href="browse.html">Browse</a>
            </p>
            <p>
                <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
            </p>
        </footer>
        </html>