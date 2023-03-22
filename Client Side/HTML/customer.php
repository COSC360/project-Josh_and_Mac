<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the home page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: home.html');
	//exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gptdb';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$stmt = $con->prepare('SELECT username, password, email, store, name, updates FROM account WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username, $password, $email, $store, $name, $updates);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <script type="text/javascript" src="../script/validation.js"></script>
</head>
<header>
    <?php include "navbar.php";?>
</header>
<body>
	<h1>Customer Information</h1>
	<div>
		<div class="columnleft">
			<table>
                <tr>
                    <td>Username: </td>
                    <td><?=$username?></td>
                </tr>
                <tr>
                    <td>Name: </td>
                    <td><?=$name?></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><?=$email?></td>
                </tr>
                <tr>
                    <td>Favorite Store: </td>
                    <td><?=$store?></td>
                </tr>
                <tr>
                    <td>Email Updates: </td>
                    <td><?=$updates?></td>
                </tr>
            </table>
            <button onclick="location.href = 'editcustomer.php';">Edit</button>
            <button onclick="location.href = 'home.php';">Back</button>
            <button onclick="location.href = 'changepassword.php';">Change Password</button>
            <button onclick="location.href = 'deleteAccount.php';">Delete Account</button>
			
		</div>
		
        </div>
        </body>
        <footer>
            <p>
                <a href="home.php">Home</a> |
                <a href="browse.php">Browse</a>
            </p>
            <p>
                <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
            </p>
        </footer>
        </html>