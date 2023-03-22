<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the home page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: home.html'); 
	exit;
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
$search = $_GET['name'];
$stmt->bind_param('s', $search);
$stmt->execute();
$stmt->bind_result($id, $name, $description, $category, $monPrice, $tuePrice, $wedPrice, $thrPrice, $friPrice, $satPrice, $sunPrice, $imgsrc);
$stmt->fetch();
$stmt->close();

$stmt2 = $con->prepare('SELECT * FROM comments WHERE name LIKE ?');
// In this case we can use the search to get the comment info.
$stmt2->bind_param('s', $search);
$stmt2->execute();
$result2 = $stmt2->get_result();

$stmt2->close();

if(($_POST["rating"]!==null && $_POST["comment"]!==null)){
$stmt3 = $con->prepare('INSERT INTO comments (rating, comment, name, username) VALUES ("'.$_POST["rating"].'", "'.$_POST["comment"].'", ?, "'.$_SESSION["name"].'")');
// In this case we can use the search to get the comment info.
$stmt3->bind_param('s', $search);
$stmt3->execute();

$stmt3->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
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
    <div id="prodinfo">
        <p id="prodname">Product Name: <?=$name?></p>
        <p id="description">Description: <?=$description?></p>
        <p id="price">Price: $<?=$monPrice?></p>
    </div>
    <figure class="productfig">
        <div class="card">
            <p><img class="card-img" src=<?=$imgsrc?>></p>
        </div>
        <p><form method="post" action="product.php">
            <label for="pricealert">set alert price: </label>
            <input type="number" min="0" step="0.01" id="pricealert" name="pricealert">
            <button type="submit">Submit</button>
        </form></p>
        <p> 
        <a href="basket.html">Basket</a>
        <a href="store.html">Store</a>
        </p>
    </figure>
    <div class = "comments">
        <h4>Comments:</h4>
        <table>
            <tr>
                <th>Username</th>
                <th>Rating</th>
                <th>Comments</th>
            </tr>
            <?php
    if (isset($_SESSION["id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true){
    while($row = $result2->fetch_assoc()) {
        echo '<tr>
                <td>'.$row["username"].'</td>
                <td>'.$row["rating"].'</td>
                <td>'.$row["comment"].'</td>
                <td><a href="deleteComment.php?comid='.$row["comid"].'">Delete Comment</a></td>
                </tr>';}
    }
    else{
        while($row = $result2->fetch_assoc()) {
            echo '<tr>
                    <td>'.$row["username"].'</td>
                    <td>'.$row["rating"].'</td>
                    <td>'.$row["comment"].'</td>
                    </tr>';}
    }
    ?>
    <?php        
    if (isset($_SESSION["id"]) && isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true){
        echo '<form method="post" action="product.php?name=<?=$search?>">
            <p>
                <label for="rating">Rating /5: </label>
                <select name="rating" id="rating" required>
                    <option value="1">1 star</option>
                    <option value="2">2 star</option>
                    <option value="3">3 star</option>
                    <option value="4">4 star</option>
                    <option value="5">5 star</option>
                </select>
            </p>
            <p>
                <label for="comment">Comment: </label>
                <textarea id="comment" name="comment" rows="5" cols="40"></textarea>
            </p>
            <button type="submit" onclick=>Post</button> | 
            <button type="reset">Clear</button>
        </form>';
    }
        ?>
    </div>
    <div class="chart">
        <p>
            Insert price chart here
        </p>
    </div>
    <button onclick="location.href = 'browse.html';">back to browse</button>
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