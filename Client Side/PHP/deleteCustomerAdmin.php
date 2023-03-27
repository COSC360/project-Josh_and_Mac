<?php
session_start();

if (!isset($_SESSION['loggedin']) | (!($_SESSION['is_admin']))) {
	header('Location: home.php');
	exit();
}

include "connectDB.php";

$stmt = $con->prepare('DELETE FROM account WHERE id = ?');
$cid = $_GET['id'];
$username = $_GET['username'];
$stmt->bind_param('i', $cid);
if($stmt->execute()){
    $_SESSION["admin_msg"] = "Successfully deleted User: $username";
    header("Location: admin.php");
}
 
// Close connection
mysqli_close($con);