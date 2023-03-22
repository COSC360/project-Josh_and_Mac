<?php
include "connectDB.php";
session_start();
if (isset($_SESSION["id"]) && isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"])===true){
$stmt = $con->prepare('DELETE FROM account WHERE id = ?');
// In this case we can use the search to get the account info.
$cid = $_SESSION['id'];
$stmt->bind_param('i', $cid);
//$stmt->execute();
if($stmt->execute()){
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