<?php
 
 $DATABASE_HOST = 'localhost';
 $DATABASE_USER = 'root';
 $DATABASE_PASS = '';
 $DATABASE_NAME = 'gptdb';
 $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
 if (mysqli_connect_errno()) {
     exit('Failed to connect to MySQL: ' . mysqli_connect_error());
 }
          
        // Taking all 5 values from the form data(input)
        $name =  $_REQUEST['name'];
        $username = $_REQUEST['username'];
        $password =  $_REQUEST['password'];
        $store = $_REQUEST['store'];
        $email = $_REQUEST['email'];
        $updates = $_REQUEST['updates'];
         
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO accounts (name, username, password, store, email, updates) VALUES ('$name',
            '$username','$password','$store','$email', '$updates')";
         
        if(mysqli_query($con, $sql)){
            echo "<h3>data stored in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>";
 
            echo nl2br("\n$name\n $username\n "
                . "$password\n $store\n $email\n $updates");
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($con);
        }
         
        // Close connection
        mysqli_close($con);
        ?>