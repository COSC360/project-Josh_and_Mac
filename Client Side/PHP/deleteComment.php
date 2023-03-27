<?php
include "connectDB.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$stmt = $con->prepare('DELETE FROM comments WHERE id = ?');
$comment_id = $_POST["commentID"];
$product_url = $_POST["productURL"];
$stmt->bind_param('i', $comment_id);

if($stmt->execute()){
    header("Location: product.php$product_url");
} else{
    echo "<h1>error</h1>";
    echo "<h1>$product_url</h1>";
}
 
$stmt->close();
mysqli_close($con);