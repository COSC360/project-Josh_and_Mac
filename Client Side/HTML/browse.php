<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connectDB.php"; 

$chain = $_GET['chain']; 
$chain_location = $_GET['chain_location']; 
$product_category = $_GET['product_category'];
$search = $_GET['search']; 

if(empty($search) | (strcasecmp($search, 'all') == 0)) { 
    if($product_category == 'all') {  
        $sql = "SELECT p.name AS product_name, p.imgsrc AS product_img, pp.price AS product_price
        FROM product p
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
        JOIN product_category pc ON pc.id = p.category_id";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ss', $chain, $chain_location);
        $searchTitle = "All Items at $chain, $chain_location";
    } else {
        $sql = "SELECT p.name AS product_name, p.imgsrc AS product_img, pp.price AS product_price
        FROM product p
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
        JOIN product_category pc ON pc.id = p.category_id
        WHERE pc.name = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sss', $chain, $chain_location, $product_category);
        $searchTitle = "All Items in category: $product_category at $chain, $chain_location";
    }
} else { 
    if($product_category == 'all') {  
        $sql = "SELECT p.name AS product_name, p.imgsrc AS product_img, pp.price AS product_price
        FROM product p
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
        JOIN product_category pc ON pc.id = p.category_id
        WHERE p.name LIKE ?";
        $searchTitle = "$search at $chain, $chain_location";
        $sanatizedSearch = '%'.trim($search).'%';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sss', $chain, $chain_location, $sanatizedSearch);
    } else {
        $sql = "SELECT p.name AS product_name, p.imgsrc AS product_img, pp.price AS product_price
        FROM product p
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
        JOIN product_category pc ON pc.id = p.category_id
        WHERE p.name LIKE ? AND pc.name = ?";
        $searchTitle = "$search in category: $product_category at $chain, $chain_location";
        $sanatizedSearch = '%'.trim($search).'%';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssss', $chain, $chain_location, $sanatizedSearch, $product_category);
    }
}
// execute statement, save result send and close statement
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
        <h3>Find a Product</h3>
        <form method="" action="browse.php">
            <input placeholder="Search for..." type="text" id="search" name="search" value="<?=$search?>">
            <select name="chain" id="chain" required>
                <!-- Saving select data from previous post request-->
                <option value="saveonfoods"<?php if($chain == 'saveonfoods') { echo ' selected'; } ?>>Save-On-Foods</option>
                <option value="walmart" <?php if($chain == 'walmart') { echo ' selected'; } ?>>Walmart</option> 
                <option value="superstore"<?php if($chain == 'superstore') { echo ' selected'; } ?>>Superstore</option>
            </select>
            <select name="chain_location" id="chain_location" required> 
                <!-- Saving select data from previous post request-->
                <option value="kelowna"<?php if($chain_location == 'kelowna') { echo ' selected'; } ?>>Kelowna</option>
                <option value="westkelowna"<?php if($chain_location == 'westkelowna') { echo ' selected'; } ?>>West Kelowna (West Bank)</option>
                <option value="vernon"<?php if($chain_location == 'vernon') { echo ' selected'; } ?>>Vernon</option>
            </select>
            <select name="product_category" id="product_category">
                    <option value="all" <?php if($product_category == 'all') { echo ' selected'; } ?>>All</option>
                    <option value="fruit" <?php if($product_category == 'fruit') { echo ' selected'; } ?>>Fruits</option>
                    <option value="vegetable" <?php if($product_category == 'vegetable') { echo ' selected'; } ?>>Vegetables</option>
                    <option value="dairy" <?php if($product_category == 'dairy') { echo ' selected'; } ?>>Dairy</option>
                    <option value="meat" <?php if($product_category == 'meat') { echo ' selected'; } ?>>Meat</option>
                </select>
            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    $rowcount = mysqli_num_rows($result);  
    if(empty($rowcount)){ 
        echo " <div><h3>No Search Results found for ".$searchTitle."</h3></div>";
    } else { 
        echo"<div><h3>Search Results for ".$searchTitle."</h3></div>";
        while($row = $result->fetch_assoc()) {
                echo '<div class="col">
                    <div class="card">
                        <h5>'.$row["product_name"].'</h5>
                        <img class="card-img" src='.$row["product_img"].'>
                        <div class="cardPrices">Price: $'.$row["product_price"].'</div>
                        <div class="link">
                            <a href="product.php?product_name='.$row["product_name"].'&chain='.$chain.'&chain_location='.$chain_location.'&product_category='.$product_category.'&search='.$search.'">Product Page</a>
                            <a href="">Basket</a>
                        </div>
                </div></div>';
            
    }} 
    mysqli_free_result($result);
    ?>
     <!--  <div class="link"><a href="product.php?name='.$row["name"].'">Product </a><a href=""> Basket </a><a href=""> Store</a></div>
    <footer>
        <p>
            <a href="home.html">Home</a> |
            <a href="browse.html">Browse</a>
        </p>
        <p>
            <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
        </p>
    </footer>-->
</html>