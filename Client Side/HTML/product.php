<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php'); 
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

$stmt = $con->prepare('SELECT * FROM product WHERE name LIKE ?');
// In this case we can use the search to get the product info.
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

function insertComment(){
    include "connectDB.php";
//if(($_POST["rating"]!==null && $_POST["comment"]!==null)){
$stmt3 = $con->prepare('INSERT INTO comments (rating, comment, name, username) VALUES ("'.$_POST["rating"].'", "'.$_POST["comment"].'", ?, "'.$_SESSION["username"].'")');
// In this case we can use the search to get the comment info.
$stmt3->bind_param('s', $search);
$stmt3->execute();

$stmt3->close();
//}
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
        <?php include "navbar.php"; ?>
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
            //$_SESSION["is_admin"] = true; // added until admin functionality is implemented
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
                    ';if($_SESSION["username"] === $row["username"]) echo '<td><a href="deleteComment.php?comid='.$row["comid"].'">Delete Comment</a></td></tr>';
                    else echo'
                    </tr>';}
    }
    ?>
    <?php       
    //$_SESSION['loggedin'] = true; // won't work unless specified here?
    if (isset($_SESSION['loggedin'])){
        echo '<form method="post" action="enterComment.php?search='.$search.'">
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
                <textarea id="comment" name="comment" rows="5" cols="40" required></textarea>
            </p>
            <button type="submit">Post</button> | 
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