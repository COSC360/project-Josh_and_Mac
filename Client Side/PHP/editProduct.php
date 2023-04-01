<?php
session_start();
include "connectDB.php";

if (!isset($_SESSION['loggedin'])) {
	header('Location: home.php');
	exit;
}
$product_id = $_GET['product_id'];
$stmt = $con->prepare('SELECT name, description FROM product WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $product_id);
$stmt->execute();
$stmt->bind_result($prodname, $description);
$stmt->fetch();
$stmt->close();
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
    <?php include "navbar.php"; 
    // if($updates == 1) { 
    //     $updateTitle = "Yes";
    // } else { 
    //     $updateTitle = "No";
    // }
    
    ?>
</header>
<body>
	<h1>Current Product Information</h1>
	<div>
		<div class="columnleft">
			<table>
                <tr>
                    <td>Product Name: </td>
                    <td><?=$prodname?></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><?=$description?></td>
                </tr>
                <tr>
                    <td>Current Price: </td>
                    <td>price</td>
                </tr>
            </table>
            <button onclick="location.href = 'home.php';">Back</button>
            <button onclick="location.href = 'deleteProduct.php';">Delete Product</button>
			
		</div>
		
        </div>
        <form method="post" action="updateProduct.php?product_id=<?php echo $product_id;?>" id="">
                        <label for="id">Product Id: <?php echo $product_id ?></label>
                    <p>
                        <label for="prodname">Product Name: </label>
                        <input type="text" id="prodname" name="prodname" placeholder = <?php echo $prodname;?>>
                    </p>
                    <p>
                        <label for="description">Description: </label>
                        <textarea id="description" name="description" rows="5" cols="40" placeholder=<?php echo $description;?>></textarea>
                    </p>
                    <p>
                        <label for="price">Price: </label>
                        <input type="text" id="price" name="price" placeholder="current price">
                    </p>
                    <button type="submit">Submit</button>
                    <input type="button" class="button"value="Back" onclick="history.back()">
			</form>
        </body>
        <footer>
            <p>
                <a href="home.php">Home</a> |
                <a href="browse.php">Browse</a>
            </p>
            <p>
                <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
            </p>
        </footer>
        </html>