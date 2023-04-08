<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connectDB.php";

if (!isset($_SESSION['loggedin'])) {
	header('Location: home.php');
	exit;
}
$id = $_SESSION['id'];

$stmt = $con->prepare('SELECT username, email, updates FROM account WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username, $email, $updates);
$stmt->fetch();
$stmt->close();

$sql = "SELECT filename, filedata FROM account WHERE id= $id";
$result = $con->query($sql);

// if ($result->num_rows > 0) {
//     // Output the image data
//     $row = $result->fetch_assoc();
//     $filename = $row["filename"];
//     $filedata = $row["filedata"];
//     $mime = mime_content_type($filename);
//     echo "<img src='data:$mime;base64," . base64_encode($filedata) . "' alt='$filename'>";
// } else {
//     echo "No image found for id $id.";
// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <script type="text/javascript" src="../script/validation.js"></script>
</head>
<header>
    <?php include "navbar.php"; 
    if($updates == 1) { 
        $updateTitle = "Yes";
    } else { 
        $updateTitle = "No";
    }
    
    ?>
</header>
<body>
	<h1>Customer Information</h1>
	<div>
		<div class="columnleft">
            <?php
    if ($result->num_rows > 0) {
    // Output the image data
    $row = $result->fetch_assoc();
    $filename = $row["filename"];
    $filedata = $row["filedata"];
    if ($filedata!=null) {
   echo '<img src="data:image/jpeg;base64,'.base64_encode($filedata).'"/>';
//    echo "<a href='uploadimg.html'>Change Profile Picture</a>";
    echo '<form action="upload.php" method="post" enctype="multipart/form-data">
    Change Profile Picture:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="Upload Image" name="submit">
  </form>';
    }
 else {
    //echo "No image found for id $id.";
    //echo "<a href='uploadimg.html'>Add Profile Picture</a>";
    echo '<form action="upload.php" method="post" enctype="multipart/form-data">
    Add Profile Picture:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="Upload Image" name="submit">
  </form>';
}
        }
?>
			<table>
                <tr>
                    <td>Username: </td>
                    <td><?=$username?></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><?=$email?></td>
                </tr>
                <tr>
                    <td>Email Updates: </td>
                    <td><?=$updateTitle?></td>
                </tr>
            </table>
            <button onclick="location.href = 'editcustomer.php';">Edit</button>
            <button onclick="location.href = 'home.php';">Back</button>
            <button onclick="location.href = 'changepassword.php';">Change Password</button>
            <button onclick="location.href = 'deleteAccount.php';">Delete Account</button>
			
		</div>
		
        </div>
        <?php if(isset($_SESSION["changePass_msg"])) { 
                        echo "<h3>".$_SESSION["changePass_msg"]."</h3>";
                        unset($_SESSION["changePass_msg"]);
                        }
                    ?>
        </body>
        <footer>
            <p>
                <a href="home.php">Home</a> |
                <a href="browse.php?search=&chain=saveonfoods&chain_location=kelowna&product_category=all">Browse</a>
            </p>
            <p>
                <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
            </p>
        </footer>
        </html>