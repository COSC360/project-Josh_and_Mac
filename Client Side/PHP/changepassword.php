<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <script type="text/javascript" src="../script/validation.js"></script>
</head>
<header>
    <?php include "navbar.php";?>
</header>
<body>
	<h1>Change Password</h1>
	<div>
		<div class="columnleft">
			<form method="get" action="http://www.randyconnolly.com/tests/process.php" id="loginForm">
                    <p>
                        <label for="username">Username: </label>
                        <input type="text" id="username" name="username">
                    </p>
                    <p>
                        <label for="oldpassword">Old Password: </label>
                        <input type="password" id="oldpassword" name="oldpassword">
                    </p>
                    <p>
                        <label for="newpassword">New Password: </label>
                        <input type="password" id="newpassword" name="newpassword">
                    </p>
                    <p>
                        <label for="confirmpass">Confirm New Password: </label>
                        <input type="password" id="confirmpass" name="confirmpass">
                    </p>
                    <button type="submit">Submit</button>
			</form>
            <button onclick="location.href = 'editcustomer.php';">Back</button>
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