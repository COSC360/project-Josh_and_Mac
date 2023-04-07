<?php
include "connectDB.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

$product_id = $_POST['product_id']; 
$location_id = $_POST['location_id']; 

$stmt = $con->prepare('SELECT created_at, price FROM product_price WHERE chain_location_id = ?
        AND product_id = ? ORDER BY created_at DESC LIMIT 5'); 

$stmt->bind_param('ii', $location_id, $product_id); 

if($stmt->execute()) { 
    $dates = array(); 
    $prices = array(); 
    $result = $stmt->get_result();  
    while($row = $result->fetch_assoc()) { 
        $dates[] = date('Y-m-d H:i:s', strtotime($row['created_at'])); 
        $prices[] = $row['price']; 
    }
    $price_data = array('dates' => $dates, 'prices' => $prices);  
    echo json_encode($price_data);
} 

$stmt->close();
$con->close();
?>