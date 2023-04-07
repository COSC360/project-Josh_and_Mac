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
    $stmt->execute([$username, $hashedpassword]);
    $user = $stmt->fetch();
    $stmt->close();
    
    // check if a user was found
    if ($user) {

        // if user found, update password
        $stmt2 = $con->prepare("UPDATE account SET password = '$newpasshash' WHERE username = ?");
        $stmt2->execute([$username]);
        $stmt2->close();
        // display success
        echo "password updated successfully :)";
        exit;
        }
        else
            // display invalid credentials
            echo 'username and/or password are invalid :(';
        mysqli_close($con);
    }
    else echo 'wrong request or fields not set';
    ?> 