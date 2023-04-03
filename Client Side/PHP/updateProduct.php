<!-- CODE SQL TO UPDATE PRODUCT IN DB -->
<?php
session_start();
include "connectDB.php";

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL); 

        $product_id = $_GET['product_id'];
        $description = $_POST['description'];
        $name = $_POST['prodname'];
        // maybe price?
        
        $stmt = $con->prepare("UPDATE product SET name= ?, description= ? WHERE id = ?");
        $stmt->bind_param('ssi', $name, $description, $product_id);
        $stmt->execute();
        
        if($stmt->execute()){
            header("Location: editProduct.php?product_id=".$product_id."");
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($con);
        }
         
        // Close connection
        mysqli_close($con);
        ?>