<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connectDB.php";

if (!isset($_SESSION['loggedin']) || !$_SESSION['is_admin']) {
	header('Location: home.php');
	exit;
}
$product_id = $_GET['product_id']; 

if(isset($_GET['chain']) && isset($_GET['chain_location'])) {  
    $chain = $_GET['chain'];  
    $chain_location = $_GET['chain_location'];
} else { 
    $chain = NULL;  
    $chain_location = NULL;
}

if($chain != NULL & $chain_location != NULL) {  
    $current_price_query = "SELECT p.name as name, p.description AS description, pp.price AS product_price, p.imgsrc AS product_img, pp.chain_location_id AS location_id
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
    AND pp.chain_location_id = latest_prices.chain_location_id WHERE p.id = ?"; 

    $stmt = $con->prepare($current_price_query);
    $stmt->bind_param('ssi', $chain, $chain_location, $product_id);
    $stmt->execute();
    $stmt->bind_result($prodname, $description, $prodprice, $imgsrc, $location_id);
    $stmt->fetch();
    $stmt->close(); 
    
} else { 
    $stmt = $con->prepare('SELECT name, description, imgsrc FROM product WHERE id = ?');
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $stmt->bind_result($prodname, $description, $imgsrc);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <script type="text/javascript" src="../script/validation.js"></script>
</head>
<header>
    <?php include "navbar.php"; ?>
</header>
<body>
    <h3>Please enter a Grocery Store and a respective location to check current price / update</h3> 
    <form method="get" action="editProduct.php">
            <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
            <select name="chain" id="chain" required> 
                <option value="" selected disabled hidden>Grocery Store Chain</option>
                <option value="saveonfoods"<?php if($chain == 'saveonfoods') { echo ' selected'; } ?>>Save-On-Foods</option>
                <option value="walmart" <?php if($chain == 'walmart') { echo ' selected'; } ?>>Walmart</option> 
                <option value="superstore"<?php if($chain == 'superstore') { echo ' selected'; } ?>>Superstore</option>
            </select>
            <select name="chain_location" id="chain_location" required> 
                <option value="" selected disabled hidden>Location</option>
                <option value="kelowna"<?php if($chain_location == 'kelowna') { echo ' selected'; } ?>>Kelowna</option>
                <option value="westkelowna"<?php if($chain_location == 'westkelowna') { echo ' selected'; } ?>>West Kelowna (West Bank)</option>
                <option value="vernon"<?php if($chain_location == 'vernon') { echo ' selected'; } ?>>Vernon</option>
            </select>
        <button type="submit">Submit</button>
    </form>
	<div>
		<div class="columnleft">
			<table>
                <tr>
                    <td>Product: </td>
                    <td><?=$prodname?></td>
                </tr>
                <tr>
                    <td>Product Image: </td>
                    <td><img src="<?=$imgsrc?>" alt=""></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><?=$description?></td>
                </tr>
                <?php  
                    if($chain != NULL & $chain_location != NULL) { 
                        echo "<tr><td>Grocery: </td>
                              <td>$chain at $chain_location</td></tr>"; 
                        echo "<tr><td>Current Price: </td>
                              <td>$$prodprice</td></tr>"; 
                    }
                ?>
            </table>
            <button onclick="location.href = 'admin.php';">Back</button>
		</div>
		
        </div>
        <?php if($chain != NULL & $chain_location != NULL) {  
            echo ' <form method="post" action="updateProduct.php?">
                    <label>Product Id: '.$product_id.'</label>
                    <p>
                        <input type="hidden" name="product_id" value="'.$product_id.'"> 
                        <input type="hidden" name="location_id" value="'.$location_id.'>">
                        <label for="prodname">Product Name: </label>
                        <input type="text" id="prodname" name="prodname" placeholder = "'.$prodname.'" required>
                    </p>
                    <p>
                        <label for="description">Description: </label>
                        <textarea id="description" name="description" rows="5" cols="40" placeholder="'.$description.'" required></textarea>
                    </p>
                    <p>
                        <label for="price">Price: </label>
                        <input type="number" id="price" step= "0.01" name="price" placeholder=$'.$prodprice.' required>
                    </p>
                    <button type="submit">Submit</button>
			</form>';
        }?>
        </body>
        <footer>
            <p>
                <a href="home.php">Home</a> |
                <a href="browse.php?search=&chain=saveonfoods&chain_location=kelowna&product_category=all">Browse</a>
            </p>
            <p>
                <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
            </p>
        </footer>
        </html>