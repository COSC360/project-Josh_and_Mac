<?php
include "connectDB.php";
          
        // Taking all 5 values from the form data(input)
        $name =  $_REQUEST['name'];
        $username = $_REQUEST['username'];
        $store = $_REQUEST['store'];
        $email = $_REQUEST['email'];
        $updates = $_REQUEST['updates'];
         
        // Performing insert query execution
        // here our table name is college
        $id = $_SESSION['id'];
        $sql = "UPDATE account SET name ='$name', username='$username', store='$store', email ='$email', updates ='$updates' WHERE id = $id";
         
        if(mysqli_query($con, $sql)){
            echo "<h3>data updated in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>";
 
            echo nl2br("\n$name\n $username\n "
                . "$store\n $email\n $updates");
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($con);
        }
         
        // Close connection
        mysqli_close($con);
        ?>