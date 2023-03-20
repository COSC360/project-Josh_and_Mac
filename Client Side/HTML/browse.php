<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include "connectDB.php"; 
$chain = $_POST['chain']; 
$chain_location = $_POST['chain_location']; 
if(empty($_POST['search'])){ 
    $stmt = $con->prepare('SELECT * FROM product');
    $searchTitle = "All Items in ".$chain." at location: ".$chain_location;
} else { 
    $stmt = $con->prepare('SELECT * FROM product WHERE name LIKE ?');
    $search = '%'.trim($_POST['search']).'%';
    echo "<h3>".$chain."</h3>"; 
    echo "<h3>".$chain_location."</h3>"; 
    echo "<h3>".$search."</h3>";
    $stmt->bind_param('s', $search);
    $searchTitle = $_POST['search']." in ".$chain." at location: ".$chain_location;
}
$stmt->execute();
$result = $stmt->get_result();
//$stmt->bind_result($id, $name, $description, $category, $monPrice, $tuePrice, $wedPrice, $thrPrice, $friPrice, $satPrice, $sunPrice, $imgsrc);
//$stmt->fetch();
// while($row = $result->fetch_assoc()) {
//     echo "<tr><td>".$row["name"]."</td><td>".$row["monPrice"]."</td></tr>";
// }
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
        <form method="post" action="browse.php">
            <input placeholder="Search for..." type="text" id="search" name="search">
            <select name="chain" id="chain" required>
                <option value="superstore"<?php if($_POST['chain'] == 'superstore') { echo ' selected'; } ?>>Superstore</option>
                <option value="saveonfoods"<?php if($_POST['chain'] == 'saveonfoods') { echo ' selected'; } ?>>Save-On-Foods</option>
                <option value="walmart" <?php if($_POST['chain'] == 'walmart') { echo ' selected'; } ?>>Walmart</option>
                <option value="sobeys" <?php if($_POST['chain'] == 'sobeys') { echo ' selected'; } ?>>Safeway/Sobeys</option>
            </select>
            <select name="chain_location" id="chain_location" required>
                <option value="kelowna"<?php if($_POST['chain_location'] == 'kelowna') { echo ' selected'; } ?>>Kelowna</option>
                <option value="calgary"<?php if($_POST['chain_location'] == 'calgary') { echo ' selected'; } ?>>Calgary</option>
                <option value="vernon"<?php if($_POST['chain_location'] == 'vernon') { echo ' selected'; } ?>>Vernon</option>
                <option value="vancouver"<?php if($_POST['chain_location'] == 'vancouver') { echo ' selected'; } ?>>Vancouver</option>
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
                        <h5>'.$row["name"].'</h5>
                        <img class="card-img" src='.$row["imgsrc"].'>
                        <div class="cardPrices">Price per: $'.$row["monPrice"].'</div>
                        <div class="unitSize">$5.50/kg</div>
                        <div class="link"><a href="product.php?name='.$row["name"].'">Product </a><a href=""> Basket </a><a href=""> Store</a></div>
                </div></div>';
            
    }} mysqli_free_result($result);
    ?>
    
    <!-- <div class="col">
        <div class="card">
            <h5>Granny Smith Apple</h5>
            <img class="card-img" src="https://assets.shop.loblaws.ca/products/20253488001/b1/en/front/20253488001_front_a01_@2.png">
            <div class="cardPrices">$1.45</div>
            <div class="unitSize">$5.20/kg</div>
            <div class="link"><a href="">Product </a><a href=""> Basket </a><a href=""> Store</a></div>
        </div>
    </div> -->
    <footer>
        <p>
            <a href="home.html">Home</a> |
            <a href="browse.html">Browse</a>
        </p>
        <p>
            <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
        </p>
    </footer>
</body>
</html>