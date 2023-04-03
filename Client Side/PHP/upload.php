<?php
include "connectDB.php";
session_start();
$id = $_SESSION['id'];

// Prepare statement for inserting file into database
$stmt = $con->prepare("UPDATE account SET filename=?, filedata=? WHERE id=?");

$target_file = basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file is an actual image or fake image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check === false) {
    echo "File is not an image.";
    exit;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    exit;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    exit;
}

// Read the file
$file_data = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

// Bind parameters to statement and execute
$stmt->bind_param("ssi", $target_file, $file_data, $id);
if ($stmt->execute()) {
    echo "The file " . htmlspecialchars($target_file) . " has been uploaded to the database.";
} else {
    echo "Sorry, there was an error uploading your file to the database.";
}

// Close statement and connection
$stmt->close();
$con->close();
?>