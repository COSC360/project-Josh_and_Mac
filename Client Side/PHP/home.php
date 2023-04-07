<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connectDB.php"; 


// Execute the SQL statement
$sql = "SELECT * FROM product ORDER BY search_count DESC LIMIT 1";
$result = mysqli_query($con, $sql);

// Check if the query was successful or not
if(mysqli_num_rows($result) > 0) {
    // Print the first row of the result set
    $row = mysqli_fetch_assoc($result);
    $product_id = $row["id"];
    $product_name = $row["name"];
    $img1 = $row["imgsrc"];
} else {
    //echo "No products found";
}

// Execute the SQL statement to obtain product_id for most commented prodcut
$sql2 = $sql = "SELECT product_id, COUNT(comment) AS comment_count FROM comments GROUP BY product_id ORDER BY comment_count DESC";
$result2 = mysqli_query($con, $sql2);
$product_name_comment = NULL;
// Check if the query was successful or not
if(mysqli_num_rows($result2) > 0) {
    // Print the product ID with the highest number of comments
    $row = mysqli_fetch_assoc($result2);
    $comment_pid = $row["product_id"];

    $sql3 = "SELECT * FROM product WHERE id = $comment_pid";
    $result3 = mysqli_query($con, $sql3);

    // Check if the query was successful or not
    if(mysqli_num_rows($result3) > 0) {
        // Print the first row of the result set
        $row = mysqli_fetch_assoc($result3);
        $product_id_comment= $row["id"];
        $product_name_comment = $row["name"];
        $img_comment = $row["imgsrc"];
    } else {
        //echo "No products found";
    }
} else {
    echo "No comments found";
}

// Close the database connection
mysqli_close($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
</head>
<header>
        <?php include "navbar.php";?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</header>
<body>
    <div>
        <h3>Find a Product</h3>
            <form method="get" action="browse.php">
                <input placeholder="Search for..." type="text" id="search" name="search">
                <select name="chain" id="chain" required>
                    <option value="" selected disabled hidden>Grocery Store Chain</option>
                    <option value="saveonfoods">Save-On-Foods</option>
                    <option value="walmart">Walmart</option>
                    <option value="superstore">Superstore</option>
                </select>
                <select name="chain_location" id="chain_location" required>
                <option value="" selected disabled hidden>Chain Location</option>
                    <option value="kelowna">Kelowna</option>
                    <option value="westkelowna">West Kelowna (WestBank)</option>
                    <option value="vernon">Vernon</option>
                </select> 
                <select name="product_category" id="product_category">
                    <option value="all" selected>All</option>
                    <option value="fruit">Fruits</option>
                    <option value="vegetable">Vegetables</option>
                    <option value="dairy">Dairy</option>
                    <option value="meat">Meat</option>
                </select>
                <button type="submit">Search</button>
            </form>
    <div class="container">
        <div>
        <p class="lead">Welcome to X-TREME GPT, your source for x-treme grocery price tracking to help save your hard earned cash!</p>
        <h4>View Price History</h4>
        <p>
            X-TREME GPT allows you to view price history of your grocery products.
        </p>
        <h4>Watch and See</h4>
        <p>
            Add items to basket and track prices. Check to see what products are on sale, and stock up when prices are low!
        </p>
        <h4>Compare</h4>
        <p>
            Search products and compare across different stores and locations
        </p>
        <p>
            Get started now! <a href="login.php"> Create a free account</a>
        </p>
     </div>
     <hr>
     <div>
        <div>
        <p class="left">View Product details and price history</p>
        </div>
        <div>
        <p class="centre">Add or remove items from your basket</p>
        </div>
        <div>
        <p class="right">Buy direct from grocery store website</p>
        </div>
     </div>
        <div class="left">
        <h4>Most Popular Product!</h4>
        <p><?php echo '<div class="col">
                    <div class="card">
                        <h5>'.$product_name.'</h5>
                        <img class="card-img" src='.$img1.'>
                </div>
                </div>'; ?></p>
        </div>
        <div class="centre">
        <h4>Biggest Price Drop!</h4>
        <p>	<canvas id="scatterPlot"></canvas>
	<script>
		// Define the data for the scatter plot
        // Use this template and fill the x,y data with price/timestamp and apply for each product displayed!
		var data = {
			datasets: [{
				label: 'Product Price',
				data: [
					{ x: 10, y: 20 },
					{ x: 20, y: 30 },
					{ x: 30, y: 40 },
					{ x: 40, y: 50 },
					{ x: 50, y: 60 }
				]
			}]
		};
		
		// Get the canvas element and context
		var canvas = document.getElementById("scatterPlot");
		var ctx = canvas.getContext("2d");
		
		// Create the scatter plot
		var scatterPlot = new Chart(ctx, {
			type: 'scatter',
			data: data,
			options: {
				scales: {
					xAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Date'
						}
					}],
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Price ($)'
						}
					}]
				}
			}
		});
	</script></p>
     </div>
     <div class="right">
        <h4>Most Comments!</h4>
        <p><?php if($product_name_comment != NULL){
            echo '<div class="col">
                    <div class="card">
                        <h5>'.$product_name_comment.'</h5>
                        <img class="card-img" src='.$img_comment.'>
                </div>
                </div>';}
                else
                    echo 'No comments yet!'; ?></p></p>
    </div>
    </div>
    </div>
    <footer>
        <p>
            <a href="home.php">Home</a> |
            <a href="browse.php">Browse</a>
        </p>
        <p>
            <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
        </p>
    </footer>
</body>
</html>