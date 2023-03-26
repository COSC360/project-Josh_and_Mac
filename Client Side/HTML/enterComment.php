<?php
include "connectDB.php";
    
//if(($_POST["rating"]!==null && $_POST["comment"]!==null)){
$stmt3 = $con->prepare('INSERT INTO comments (rating, comment, name, username) VALUES ("'.$_REQUEST["rating"].'", "'.$_REQUEST["comment"].'", ?, "'.$_SESSION["username"].'")');
// In this case we can use the search to get the comment info.
$search = $_GET['search'];
$stmt3->bind_param('s', $search);
if($stmt3->execute()){
   header('Location: product.php?name='.$search.'');
   echo 'delete success?';
}
else{
    echo 'error';
}

$stmt3->close();
?>