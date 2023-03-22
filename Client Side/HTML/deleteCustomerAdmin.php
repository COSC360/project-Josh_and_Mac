<?php
// will need admin flag applied
// if (isset($_SESSION["id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true)
include "connectDB.php";
$stmt = $con->prepare('DELETE FROM account WHERE id = ?');
$stmt2 = $con->prepare('DELETE FROM comments WHERE name = ?');
// In this case we can use the search to get the account info.
$cid = $_GET['id'];
$username = $_GET['username'];
$stmt->bind_param('i', $cid);
$stmt2->bind_param('s', $username);
//$stmt->execute();
if($stmt->execute() && $stmt2->execute()){
    echo "<h3>Customer account deleted successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";
} else{
    echo "ERROR "
        . mysqli_error($con);
}
 
// Close connection
mysqli_close($con);