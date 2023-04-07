<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connectDB.php"; 
include "checkPOST.php";
if (empty($_POST['username']) | empty($_POST['password'])) {
    $_SESSION["login_error"] = "Please input a username and password!";
    exit();
}
if ($stmt = $con->prepare('SELECT id, password, is_admin FROM account WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $isadmin);
        $stmt->fetch();
        if (md5($_POST['password']) === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $id;
            if($isadmin === 1) { 
                $_SESSION['is_admin'] = TRUE;
            }
            echo "<h1>success</h1>";
            header('Location: home.php');
        } else {
            // Incorrect password
            $_SESSION["login_error"] = "Incorrect password: $hashedPassword";
            header('Location: login.php');
        }
    } else {
        // Incorrect username
        $_SESSION["login_error"] = "No username found"; 
        header('Location: login.php');
    }

	$stmt->close();
}
?>
