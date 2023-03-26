<?php
session_start();
// Change this to your connection info.
include "connectDB.php"; 
include "checkPOST.php";
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
    $_SESSION["login_error"] = "Please input a username and password!";
    exit();
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM account WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        // if (password_verify($_POST['password'], $password)) {
        if ($_POST['password'] === $password) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $id;
            echo "<h1>success</h1>";
            header('Location: home.php');
        } else {
            // Incorrect password
            $_SESSION["login_error"] = "Incorrect password";
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
