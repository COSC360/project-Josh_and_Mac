<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if (!isset($_SESSION['loggedin'])) {
        $_SESSION['login_error'] = "You do not have this permission, please sign in";
        header('Location: login.php'); 
        exit;
    }

    include "connectDB.php"; 

    if(isset($_POST['chain']) && isset($_POST['chain_location'])) { 
        $chain = $_POST['chain']; 
        $chain_location = $_POST['chain_location'];  
    } else { 
        $chain = "saveonfoods"; 
        $chain_location = "kelowna";  
    }
    $account_id = $_SESSION['id'];

    $sql = "SELECT b.id AS basket_item_id, p.name AS product_name, p.imgsrc AS product_img, pp.price AS product_price, b.account_id, b.quantity as product_quantity
    FROM basket_item b JOIN product p ON b.product_id = p.id 
    JOIN chain_location cl ON b.chain_location_id = cl.id 
    JOIN chain c ON cl.chain_id = c.id 
    JOIN (
        SELECT product_id, chain_location_id, MAX(created_at) AS latest_date
        FROM product_price
        JOIN chain_location ON product_price.chain_location_id = chain_location.id
        JOIN chain ON chain_location.chain_id = chain.id
        WHERE chain.name = ? AND chain_location.name = ?
        GROUP BY product_id, chain_location_id
    ) latest_prices ON p.id = latest_prices.product_id 
    JOIN product_price pp ON pp.product_id = p.id 
    AND pp.created_at = latest_prices.latest_date
    AND pp.chain_location_id = latest_prices.chain_location_id  
    WHERE b.account_id = ?"; 

    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssi', $chain, $chain_location, $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
?> 

<!DOCTYPE html>
<html>
<head>
	<title>Browse</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
</head>
<header>
    <?php include "navbar.php" ?>
</header>
<body>
    <div>
        <h3>Select a Chain & Location to compare prices</h3>
        <form method="post" action="accountBasket.php">
            <select name="chain" id="chain" required> 
                <option value="saveonfoods"<?php if($chain == 'saveonfoods') { echo ' selected'; } ?>>Save-On-Foods</option>
                <option value="walmart" <?php if($chain == 'walmart') { echo ' selected'; } ?>>Walmart</option> 
                <option value="superstore"<?php if($chain == 'superstore') { echo ' selected'; } ?>>Superstore</option>
            </select>
            <select name="chain_location" id="chain_location" required> 
                <option value="kelowna"<?php if($chain_location == 'kelowna') { echo ' selected'; } ?>>Kelowna</option>
                <option value="westkelowna"<?php if($chain_location == 'westkelowna') { echo ' selected'; } ?>>West Kelowna (West Bank)</option>
                <option value="vernon"<?php if($chain_location == 'vernon') { echo ' selected'; } ?>>Vernon</option>
            </select>
            <button type="submit">Submit</button>
        </form>
        <button onclick="location.href = 'browse.php?search=&chain=<?=$chain?>&chain_location=<?=$chain_location?>&product_category=all';">back to browse</button>
    </div>
    

    <?php
    $rowcount = mysqli_num_rows($result);  
    if(empty($rowcount)){ 
        echo " <div><h3>You haven't added any items to your basket!</h3></div>";
    } else { 
        echo"<div><h3>Your Saved Items</h3></div>";
        while($row = $result->fetch_assoc()) {
                $totalprice = $row["product_quantity"] * $row["product_price"];
                $formatted = sprintf("%0.2f", $totalprice);
                echo '<div class="col">
                    <div class="card">
                        <h5>'.$row["product_name"].'</h5>
                        <img class="card-img" src='.$row["product_img"].'>
                        <div>Quantity: x'.$row["product_quantity"].'</div>
                        <div>Total Price: $'.$formatted.'</div>
                        <form method="post" action="deleteFromBasket.php"> 
                            <input type="hidden" id="basket_item_id" name="basket_item_id" value="'.$row["basket_item_id"].'"> 
                            <button type="submit">Delete Item</button>
                        </form>
                        <form method="post" action="updateBasketItem.php"> 
                            <input type="hidden" id="basket_item_id" name="basket_item_id" value="'.$row["basket_item_id"].'"> 
                            <input type="number" step="1" name="quantity" value="1">  
                            <button type="submit">Update Quantity</button>
                        </form>
                    </div> 
                </div>';
            
    }} 
    mysqli_free_result($result);
    ?>
</html>

