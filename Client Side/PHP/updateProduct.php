<!-- CODE SQL TO UPDATE PRODUCT IN DB -->
<?php
session_start();
include "connectDB.php";

if(!$_SERVER['REQUEST_METHOD'] === 'POST') { 
    exit("POST MUST BE USED FOR THIS PHP REQUEST_METHOD FOR SECURITY REASONS");
}

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL); 

        $product_id = $_POST['product_id'];
        $description = $_POST['description'];
        $name = $_POST['prodname'];
        $newprice = $_POST['price'];
        $location_id = $_POST['location_id'];
        
        $stmt = $con->prepare("UPDATE product SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param('ssi', $name, $description, $product_id);

        $stmt2 = $con->prepare("INSERT INTO product_price(chain_location_id, product_id, price) VALUES (?,?,?)");
        $stmt2->bind_param('iid', $location_id, $product_id, $newprice);
        
        if($stmt->execute() && $stmt2->execute()) {
            header("Location: editProduct.php?product_id=".$product_id."");
        } else{
            echo "ERROR: Sorry $sql. "
                . mysqli_error($con);
        }
        
        mysqli_close($con);
        ?>