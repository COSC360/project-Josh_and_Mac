<?php
    session_start();
    include "connectDB.php";
    include "checkPOST.php"; 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $username = $_POST['newusername'];
    $password =  $_POST['newpassword'];
    $email = $_POST['email']; 

    // Check if username already exists
    $sql = "SELECT COUNT(*) as count FROM account WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];

 if($count > 0) {
    $_SESSION["newuser_msg"] = "User already exists with username: $username";
    header("Location: login.php");
    } else if (isset($_POST['updates'])) { 
        $updates = $_POST['updates'];
        $sql = "INSERT INTO account (username, password, email, updates) VALUES (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $hashedPassword = md5($password); 
        $stmt->bind_param('ssss', $username, $hashedPassword, $email, $updates);
        if($stmt->execute()){ 
            $_SESSION["newuser_msg"] = "Successfully created account for user: $username";
            header("Location: login.php");
        } else { 
                $_SESSION["newuser_msg"] = $sql." -> ".$con->error; 
                header("Location: login.php");
            }    
    } else { 
        $sql = "INSERT INTO account (username, password, email) VALUES (?,?,?)";
        $stmt = $con->prepare($sql);
        $hashedPassword = md5($password); 
        $stmt->bind_param('sss', $username, $hashedPassword, $email);
        if($stmt->execute()){ 
            $_SESSION["newuser_msg"] = "Successfully created account for user: $username";
            header("Location: login.php");
        } else { 
                $_SESSION["newuser_msg"] = $sql." -> ".$con->error; 
                header("Location: login.php");
            }    
    } 
    
    // Close connection and stmt
    $con->close();
    $stmt->close();
    ?>