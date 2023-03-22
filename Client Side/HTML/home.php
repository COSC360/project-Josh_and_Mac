<?php
session_start();
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
        <?php include "navbar.php"; ?>
</header>
<body>
    <div>
        <h3>Find a Product</h3>
            <form method="post" action="browse.php">
                <input placeholder="Search for..." type="text" id="search" name="search">
                <select name="chain" id="chain" required>
                    <option value="" selected disabled hidden>Grocery Store Chain</option>
                    <option value="superstore">Superstore</option>
                    <option value="saveonfoods">Save-On-Foods</option>
                    <option value="walmart">Walmart</option>
                    <option value="sobeys">Safeway/Sobeys</option>
                </select>
                <select name="chain_location" id="chain_location" required>
                    <option value="" selected disabled hidden>Location</option>
                    <option value="kelowna">Kelowna</option>
                    <option value="calgary">Calgary</option>
                    <option value="vernon">Vernon</option>
                    <option value="vancouver">Vancouver</option>
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
            Get started now! <a href="login.html"> Create a free account</a>
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
        <h4>Top Product!</h4>
        <p>Gala Apples $1.35</p>
        </div>
        <div class="centre">
        <h4>Biggest Price Drop!</h4>
        <p>Green Beans $0.55</p>
     </div>
     <div class="right">
        <h4>Most Comments!</h4>
        <p>Bananas $0.87</p>
    </div>
    </div>
    </div>
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