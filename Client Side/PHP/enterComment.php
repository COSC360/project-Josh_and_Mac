<?php
include "connectDB.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$account_id = $_GET['account_id'];
$product_id = $_GET['product_id']; 
$product_url = $_POST['productURL'];
$desc = $_POST['comment']; 
$rating = $_POST['rating'];
$stmt3 = $con->prepare('INSERT INTO comments (product_id, account_id, comment, rating) VALUES (?, ?, ?, ?)');
$stmt3->bind_param('ssss', $product_id, $account_id, $desc, $rating);
if($stmt3->execute()){
   header("Location: product.php$product_url");
}
else {
    echo 'error';
}

$stmt3->close();
$con->close();
?>