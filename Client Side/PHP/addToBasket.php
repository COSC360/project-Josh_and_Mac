<?php
include "connectDB.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); 

$account_id = $_SESSION['id'];
$product_id = $_POST['product_id']; 
$location_id = $_POST['location_id'];
$quantity = $_POST['quantity'];

$stmt = $con->prepare('INSERT INTO basket_item (account_id, product_id, chain_location_id, quantity) VALUES (?, ?, ?, ?)');
$stmt->bind_param('iiii', $account_id, $product_id, $location_id, $quantity); 
if($stmt->execute()){
    header("Location: accountBasket.php");
}
else {
    echo 'error';
}

$stmt->close();
$con->close();
?>