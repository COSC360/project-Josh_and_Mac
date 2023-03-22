<?php
// will need admin flag applied
// if (isset($_SESSION["id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true)
include "connectDB.php";
$stmt = $con->prepare('DELETE FROM comments WHERE comid = ?');

// In this case we can use the search to get the account info.
$comid = $_GET['comid'];

$stmt->bind_param('i', $comid);

//$stmt->execute();
if($stmt->execute()){
    echo "<h3>Comment deleted successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";
} else{
    echo "ERROR "
        . mysqli_error($con);
}
 
// Close connection
mysqli_close($con);