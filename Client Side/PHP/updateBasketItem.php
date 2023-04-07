<?php
include "connectDB.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); 

$quantity = $_POST['quantity'];
$basket_item_id = $_POST['basket_item_id'];

$stmt = $con->prepare('UPDATE basket_item SET quantity = ? WHERE id = ?');
$stmt->bind_param('ii', $quantity, $basket_item_id); 
if($stmt->execute()){
    header("Location: accountBasket.php");
}
else {
    echo 'error';
}

$stmt->close();
$con->close();
?>