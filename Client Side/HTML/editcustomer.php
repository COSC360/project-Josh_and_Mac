<!DOCTYPE html>
<html>
<head>
	<title>Edit Customer Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <script type="text/javascript" src="../script/validation.js"></script>
</head>
<header>
    <div class="flex-container">    
       <?php include "navbar.php"?>
    </div>
</header>
<body>
	<h1>Edit Customer Information</h1>
	<div>
		<div class="columnleft">
			<form method="get" action="http://www.randyconnolly.com/tests/process.php" id="loginForm">
                    <p>
                        <label for="username">Username: </label>
                        <input type="text" id="username" name="username">
                    </p>
                    <p>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name">
                    </p>
                    <p>
                        <label for="email">Email: </label>
                        <input type="text" id="username" name="username">
                    </p>
                    <p>
                        <label for="store">Favorite Store: </label>
                        <input type="text" id="store" name="tore">
                    </p>
                    <p>
                        <label for="updates">Email Updates: </label>
                        <input type="checkbox" id="updates" name="updates">
                    </p>
                    <button type="submit">Submit</button>
			</form>
            <button onclick="location.href = 'customer.php';">Back</button>
            <button onclick="location.href = 'changepassword.php';">Change Password</button>

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