<?php
session_start();
include "connectDB.php";

if (!isset($_SESSION['loggedin'])) {
	header('Location: home.php');
	exit;
}
$stmt = $con->prepare('SELECT username, email, updates FROM account WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username, $email, $updates);
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
    <?php include "navbar.php"; 
    if($updates == 1) { 
        $updateTitle = "Yes";
    } else { 
        $updateTitle = "No";
    }
    
    ?>
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
                    <td>Email: </td>
                    <td><?=$email?></td>
                </tr>
                <tr>
                    <td>Email Updates: </td>
                    <td><?=$updateTitle?></td>
                </tr>
            </table>
            <button onclick="location.href = 'editcustomer.php';">Edit</button>
            <button onclick="location.href = 'home.php';">Back</button>
            <!--<button onclick="location.href = 'changepassword.php';">Change Password</button>-->
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