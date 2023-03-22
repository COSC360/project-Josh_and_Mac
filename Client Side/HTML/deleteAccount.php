<?php
include "connectDB.php";
session_start();
if (isset($_SESSION["id"]) && isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"])===true){
$stmt = $con->prepare('DELETE FROM account WHERE id = ?');
$stmt2 = $con->prepare('DELETE FROM comments WHERE name = ?');
// In this case we can use the search to get the account info.
$cid = $_SESSION['id'];
$username = $_SESSION['name'];
$stmt->bind_param('i', $cid);
$stmt2->bind_param('s', $username);
//$stmt->execute();
if($stmt->execute() && $stmt2->execute()){
    echo "<h3>Customer account deleted successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";
        session_destroy();
        header('Location: login.php');

} else{
    echo "ERROR "
        . mysqli_error($con);
}
}
else echo "Not logged in";

 
// Close connection
mysqli_close($con);