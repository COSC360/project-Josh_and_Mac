<?php 
if(!$_SERVER['REQUEST_METHOD'] === 'POST') { 
    exit("POST MUST BE USED FOR THIS PHP REQUEST_METHOD FOR SECURITY REASONS");
}
?>