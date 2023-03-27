<?php
// Will need admin flag added!!
// We need to use sessions, so you should always start sessions using the below code.
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// If the user is not logged in redirect to the home page...
if (!isset($_SESSION['loggedin']) | (!($_SESSION['is_admin']))) {
	header('Location: home.php');
	exit();
}

include "connectDB.php"; 
$stmt = $con->prepare('SELECT * FROM account');
// In this case we can use the account ID to get the account info.
//$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
//$stmt->bind_result($username, $password, $email, $store, $name, $updates);
// $stmt->fetch();
$result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <script type="text/javascript" src="../script/validation.js"></script>
</head>
<header>
    <?php include "navbar.php";?>
</header>
<body>
	<h1>Admin Portal</h1> 
    <?php if(isset($_SESSION["admin_msg"])) { 
        echo "<h3>".$_SESSION["admin_msg"]."</h3>"; 
        unset($_SESSION["admin_msg"]);
        }?>
	<div>
		<div class="columnleft">
			<table>
                <tr>
                    <th>Customer Id</th>
                    <th>Customer UserName</th>
                    <th>Email</th>
                    <th>Email Updates</th>
                </tr>
<?php
    $rowcount = mysqli_num_rows($result);  
    if(empty($rowcount)){ 
        echo " <div><h3>No Current Customers</h3></div>";
    } else { 
        echo"<div><h3>Current Customer List:</h3></div>";
        while($row = $result->fetch_assoc()) {
                echo '<tr>
                <td>'.$row["id"].'</td>
                <td>'.$row["username"].'</td>
                <td>'.$row["email"].'</td>
                <td>'.$row["updates"].'</td>
                <td><a href="deleteCustomerAdmin.php?id='.$row["id"].'&username='.$row["username"].'">Delete</a></td>
                </tr>';
    }}mysqli_free_result($result);
    ?>
            </table>
            <button onclick="location.href = 'home.php';">Back</button>
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