<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connectDB.php"; 

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['username']) && isset($_GET['oldpassword']) && isset($_GET['newpassword'])){
    // obtain the post data
    $username = $_GET["username"];
    $oldpassword = $_GET["oldpassword"];
    $hashedpassword = md5($oldpassword);
    $newpassword = $_GET["newpassword"];
    $newpasshash = md5($newpassword);

    // check to see if user exists with username and/or email
    $stmt = $con->prepare("SELECT * FROM account WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $hashedpassword);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowcount = mysqli_num_rows($result);  
    
    // check if a user was found
    if ($rowcount == 1) {
        // if user found, update password
        $stmt2 = $con->prepare("UPDATE account SET password = ? WHERE username = ?");
        $stmt2->bind_param("ss", $newpasshash, $username);
        $stmt2->execute();
        $stmt2->close();
        $_SESSION["changePass_msg"] = "password updated successfully :)";
        header("location: customer.php");
        exit;
        } else
            // display invalid credentials
            $_SESSION["changePass_msg"] = 'username and/or password are invalid :(';
            header("location: customer.php");
        
        mysqli_close($con);
    }
    else echo 'wrong request or fields not set';
    ?> 