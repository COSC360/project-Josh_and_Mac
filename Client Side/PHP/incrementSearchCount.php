<?php
function incrementSearchCount($product_name) {
    // Connect to the database
    include "connectDB.php"; 
    
    // Increment the search count for the product
    $sql = "UPDATE product SET search_count = search_count + 1 WHERE name = '$product_name'";
    mysqli_query($con, $sql);
    
    // Check if the query was successful or not
    // commented to hide display from user but used for checking during development
    // if(mysqli_affected_rows($con) > 0) {
    //     echo "Search count incremented successfully!";
    // } else {
    //     echo "Error: Could not increment search count";
    // }
    
    // Close the database connection
    mysqli_close($con);
}
?>