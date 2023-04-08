<?php
    session_start();
    include "connectDB.php";

    $commentNewCount = $_POST['commentNewCount'];
    $product_name = $_POST['product_name'];
    $product_url_query = $_POST['product_url_query'];

    $stmt2 = $con->prepare("SELECT c.id as commentID, a.username AS username, c.comment AS comment_desc, c.rating AS comment_rating
    FROM account a
    JOIN comments c ON c.account_id = a.id
    JOIN product p ON p.id = c.product_id
    WHERE p.name = ? LIMIT $commentNewCount");
    $stmt2->bind_param('s', $product_name);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if (isset($_SESSION["id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true){
        echo "<h4>Comments:</h4>
        <table>
            <tr>
                <th>Username</th>
                <th>Rating</th>
                <th>Comments</th>
            </tr>";
            if (mysqli_num_rows($result2)>0){
        while($row = $result2->fetch_assoc()) {
            echo '<tr>
                    <td>'.$row["username"].'</td>
                    <td>'.$row["comment_rating"].'</td>
                    <td>'.$row["comment_desc"].'</td>
                    <td><form method="post" action="deleteComment.php"> 
                    <input type="hidden" id="commentID" name="commentID" value="'.$row["commentID"].'"> 
                    <input type="hidden" id="productURL" name="productURL" value="'.$product_url_query.'">
                    <button type="submit">Delete Comment</button>
                    </form></td></tr>';}
        }
        else echo "no comments";
    }
        else{
            echo "<h4>Comments:</h4>
        <table>
            <tr>
                <th>Username</th>
                <th>Rating</th>
                <th>Comments</th>
            </tr>";
            if (mysqli_num_rows($result2)>0){
            while($row = $result2->fetch_assoc()) {
                echo '<tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["comment_rating"].'</td>
                        <td>'.$row["comment_desc"].'</td>
                        ';if($_SESSION["username"] === $row["username"]) echo '<td><form method="post" action="deleteComment.php"> 
                        <input type="hidden" id="commentID" name="commentID" value="'.$row["commentID"].'"> 
                        <input type="hidden" id="productURL" name="productURL" value="'.$product_url_query.'">
                        <button type="submit">Delete Comment</button>
                        </form></td></tr>';
                        else echo'
                        </tr>';}
        }
        else
        echo "no comments";
    }
    $stmt2->close();
    ?>