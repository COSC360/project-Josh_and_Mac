<?php
session_start();
include "connectDB.php";

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL); 

        $username = $_POST['username'];
        $email = $_POST['email'];
        $updates = $_POST['updates'];
        $id = $_SESSION['id'];

        if($updates == NULL) { 
            $updates = 0;
        } 
        // Check if username already exists
        $sql = "SELECT COUNT(*) as count FROM account WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc()['count'];

        if($count > 0) {
            $_SESSION["edituser_msg"] = "User already exists with username: $username";
            header("Location: editcustomer.php");
        } else {
            $stmt = $con->prepare("UPDATE account SET username=?, email =?, updates =? WHERE id = ?");
            $stmt->bind_param('ssss', $username, $email, $updates, $id);
            $stmt->execute();
            if($stmt->execute()){
                header("Location: customer.php");
            } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($con);
            }
        }
         
        // Close connection
        mysqli_close($con);
        ?>