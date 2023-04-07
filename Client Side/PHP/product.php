<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    $_SESSION['login_error'] = "You do not have this permission, please sign in";
	header('Location: login.php'); 
	exit;
}
include "connectDB.php"; 
include "incrementSearchCount.php";

$stmt = $con->prepare("SELECT p.id AS product_id, pc.name AS product_category, p.imgsrc AS product_img, pp.price AS product_price, p.description AS product_desc, pp.chain_location_id AS location_id
        FROM product p
        JOIN (
            SELECT product_id, chain_location_id, MAX(created_at) AS latest_date
            FROM product_price
            JOIN chain_location ON product_price.chain_location_id = chain_location.id
            JOIN chain ON chain_location.chain_id = chain.id
            WHERE chain.name = ? AND chain_location.name = ?
            GROUP BY product_id, chain_location_id
        ) latest_prices ON p.id = latest_prices.product_id 
        JOIN product_price pp ON pp.product_id = p.id AND pp.chain_location_id = latest_prices.chain_location_id AND pp.created_at = latest_prices.latest_date
        JOIN chain_location cl ON pp.chain_location_id = cl.id
        JOIN chain c ON c.id = cl.chain_id 
        JOIN product_category pc ON pc.id = p.category_id
        WHERE p.name = ?");

$search = $_GET["search"];
$product_name = $_GET["product_name"]; 
$chain = $_GET["chain"]; 
$chain_location = $_GET["chain_location"];
$product_category = $_GET["product_category"];
$product_name_url = rawurlencode($product_name);
$search_url = rawurlencode($search);
$product_url_query = "?product_name=$product_name_url&chain=$chain&chain_location=$chain_location&product_category=$product_category&search=$search_url";

$stmt->bind_param('sss', $chain, $chain_location, $product_name);

$stmt->execute();

$stmt->bind_result($product_id, $product_exact_category, $product_img, $product_latest_price, $product_desc, $location_id);

$stmt->fetch();

$stmt->close();
// increment the search count when user has selected this product
incrementSearchCount($product_name);

$stmt2 = $con->prepare("SELECT c.id as commentID, a.username AS username, c.comment AS comment_desc, c.rating AS comment_rating
    FROM account a
    JOIN comments c ON c.account_id = a.id
    JOIN product p ON p.id = c.product_id
    WHERE p.name = ? LIMIT 2");
// In this case we can use the search to get the comment info.
$stmt2->bind_param('s', $product_name);
$stmt2->execute();
$result2 = $stmt2->get_result();

$stmt2->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script> 
            var product_id = <?php echo $product_id; ?>; 
            var location_id = <?php echo $location_id; ?>;  
            console.log(product_id);
            $.ajax({ 
                url: 'getProductChartData.php', 
                method: 'POST', 
                data: {product_id: product_id, location_id: location_id},
                success: function(data) { 
                    var product_price_data = JSON.parse(data);
                    var chartCanvas = document.getElementById('productChart').getContext('2d');
                    var productChart = new Chart(chartCanvas, {
                        type: 'line',
                        data: {
                        labels: product_price_data.dates,
                        datasets: [{
                            label: 'Price History',
                            data: product_price_data.prices,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1,
                        }]
                        },
                        options: {
                            scales: {
                                y: {
                                beginAtZero: true, 
                                grid: {color: 'black'}, 
                                ticks: {color: 'black'}
                                },
                                x: { 
                                 grid: {color: 'black'},
                                 ticks: {color: 'black'}
                                },
                            }
                        }
                    });
                }, 
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }});
        </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        //jQuery code for AJAX
        $(document).ready(function(){
            var commentCount = 2;
            $("#btn").click(function(){
                commentCount = commentCount + 2;
                $("#comments").load("load-comments.php", {
                    commentNewCount: commentCount,
                    product_name: "<?php echo $product_name; ?>",
                    product_url_query: "<?php echo $product_url_query; ?>"              
                 }); 
            });
        }); 
    </script>
</head>
<header>
        <?php include "navbar.php"; ?>
</header>
<body>
    <div id="prodinfo">
        <p id="prodname">Product Name: <?=$product_name?></p>
        <p id="prodname">Product Category: <?=$product_exact_category?></p>
        <p id="prodname">Sourced From: <?=$chain?> in <?=$chain_location?></p>
        <p id="description">Description: <?=$product_desc?></p>
        <p id="price">Latest Price: $<?=$product_latest_price?></p>
    </div>
    <figure class="productfig">
        <div class="card">
            <p><img class="card-img" src=<?=$product_img?>></p>
        </div>
    </figure>
    <div> 
        <h4>Add a Comment:</h4>
        <?php       
            if (isset($_SESSION['loggedin'])) {
                    echo '<form method="post" action="enterComment.php?product_id='.$product_id.'&account_id='.$_SESSION["id"].'">
                        <p>
                            <input type="hidden" id="productURL" name="productURL" value="'.$product_url_query.'">
                            <label for="rating">Rating /5: </label>
                            <select name="rating" id="rating" required>
                                <option value=1>1 star</option>
                                <option value=2>2 star</option>
                                <option value=3>3 star</option>
                                <option value=4>4 star</option>
                                <option value=5>5 star</option>
                            </select>
                        </p>
                        <p>
                            <label for="comment">Comment: </label>
                            <textarea id="comment" name="comment" rows="5" cols="40" required></textarea>
                        </p>
                        <button type="submit">Post</button> | 
                        <button type="reset">Clear</button> |';?> 
                        <button onclick="location.href = 'browse.php?search=<?=$search?>&chain=<?=$chain?>&chain_location=<?=$chain_location?>&product_category=<?=$product_category?>';">back to browse</button>
                        <?php echo "</form>";} ?>
        <form method="post" action="addToBasket.php">
            <label for="quantity">Quantity</label>
            <input type="number" step="1" name="quantity" value="1" required> 
            <?php echo '<input type="hidden" id="product_id" name="product_id" value="'.$product_id.'"> 
                        <input type="hidden" id="location_id" name="location_id" value="'.$location_id.'">
                        <input type="hidden" id="chain.name" name="location_id" value="'.$location_id.'">  
                        <input type="hidden" id="price" name="price" value="'.$product_latest_price.'">'; ?>
            <button type="submit">Add to your Basket</button>
        </form>
    </div>
    <div class="productChartWrapper"> 
        <canvas id="productChart"></canvas> 
    </div>
    <div class = "comments">
            <div id="comments">
            <?php
   if (isset($_SESSION["id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true){
    echo "<h4>Comments:</h4>
    <table>
        <tr>
            <th>Username</th>
            <th>Rating</th>
            <th>Comments</th>
        </tr>";
        if (mysqli_num_rows($result2)>0){
    while($row = $result2->fetch_assoc()) {
        echo '<tr>
                <td>'.$row["username"].'</td>
                <td>'.$row["comment_rating"].'</td>
                <td>'.$row["comment_desc"].'</td>
                <td><form method="post" action="deleteComment.php"> 
                <input type="hidden" id="commentID" name="commentID" value="'.$row["commentID"].'"> 
                <input type="hidden" id="productURL" name="productURL" value="'.$product_url_query.'">
                <button type="submit">Delete Comment</button>
                </form></td></tr>';}
    }
    else echo "no comments";
}
    else{
        echo "<h4>Comments:</h4>
    <table>
        <tr>
            <th>Username</th>
            <th>Rating</th>
            <th>Comments</th>
        </tr>";
        if (mysqli_num_rows($result2)>0){
        while($row = $result2->fetch_assoc()) {
            echo '<tr>
                    <td>'.$row["username"].'</td>
                    <td>'.$row["comment_rating"].'</td>
                    <td>'.$row["comment_desc"].'</td>
                    ';if($_SESSION["username"] === $row["username"]) echo '<td><form method="post" action="deleteComment.php"> 
                    <input type="hidden" id="commentID" name="commentID" value="'.$row["commentID"].'"> 
                    <input type="hidden" id="productURL" name="productURL" value="'.$product_url_query.'">
                    <button type="submit">Delete Comment</button>
                    </form></td></tr>';
                    else echo'
                    </tr>';}
    }
    else
    echo "no comments";
}
    ?>
    </table>
    </div>
    </div>
    <button id="btn">Show more comments</button>
</body>