<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the home page...
if (isset($_SESSION['loggedin'])) {
	//header('Location: home.html');
	//exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gptdb';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM product WHERE name LIKE ?');
// In this case we can use the search to get the account info.
$search = '%'.$_POST['search'].'%';
$stmt->bind_param('s', $search);
$stmt->execute();
$result = $stmt->get_result();
//$stmt->bind_result($id, $name, $description, $category, $monPrice, $tuePrice, $wedPrice, $thrPrice, $friPrice, $satPrice, $sunPrice, $imgsrc);
//$stmt->fetch();
// while($row = $result->fetch_assoc()) {
//     echo "<tr><td>".$row["name"]."</td><td>".$row["monPrice"]."</td></tr>";
// }
$stmt->close();

$search = $_POST['search'];
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
    <div class="flex-container">    
        <div><a href="home.html">X-TREME GPT (grocery price tracker)</a></div>
        
        <button onclick="location.href = 'login.html';" id="login">login / sign up</button>
    </div>
</header>
<body>
    <div>
        <h3>Find a Product</h3>
        <form method="post" action="browse.php">
            <input placeholder="Search for..." type="text" id="search" name="search" required>
            <select name="store" id="store" required>
                <option value="superstore">Superstore</option>
                <option value="saveon">Save-On-Foods</option>
                <option value="walmart">Walmart</option>
                <option value="sobeys">Safeway/Sobeys</option>
            </select>
            <select name="city" id="city" required>
                <option value="kelowna">Kelowna</option>
                <option value="calgary">Calgary</option>
                <option value="vernon">Vernon</option>
                <option value="vancouver">Vancouver</option>
            </select>
            <button type="submit">Submit</button>
            <button onclick="location.href='browse.html';" id="browseButton">Browse all items</button>
        </form>
    </div>
    <div>
        <h3>Search Results for <?=$search?></h3>
    </div>
    <?php
    while($row = $result->fetch_assoc()) {
        echo ' <div class="col">
        <div class="card">
            <h5>'.$row["name"].'</h5>
            <img class="card-img" src='.$row["imgsrc"].'>
            <div class="cardPrices">Price per: $'.$row["monPrice"].'</div>
            <div class="unitSize">$5.50/kg</div>
            <div class="link"><a href="product.php?name='.$row["name"].'">Product </a><a href=""> Basket </a><a href=""> Store</a></div>
        </div>
    </div>';
    }?>
    
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