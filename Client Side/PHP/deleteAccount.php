<?php
include "connectDB.php";
session_start();
if (isset($_SESSION["id"]) && isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"])===true){
    $stmt = $con->prepare('DELETE FROM account WHERE id = ?');
    // In this case we can use the search to get the account info.
    $cid = $_SESSION['id'];
    $username = $_SESSION['username'];
    $stmt->bind_param('i', $cid);
    //$stmt->execute();
    if($stmt->execute()){
            session_destroy();
            $_SESSION["newuser_msg"] = "Account: $username has been deleted";
            header('Location: login.php');

    } else{
        echo "ERROR "
            . mysqli_error($con);
    }
}
else echo "Not logged in";

 
$stmt->close();
mysqli_close($con);
?>