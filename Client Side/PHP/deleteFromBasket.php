<?php
include "connectDB.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); 

$basket_item_id = $_POST['basket_item_id'];

$stmt = $con->prepare('DELETE FROM basket_item WHERE id = ?');
$stmt->bind_param('i', $basket_item_id); 
if($stmt->execute()){
    header("Location: accountBasket.php");
}
else {
    echo 'error';
}

$stmt->close();
$con->close();
?>