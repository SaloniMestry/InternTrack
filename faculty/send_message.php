<?php
session_start();
include("../config/db.php");

$sender_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];
$message = mysqli_real_escape_string($conn, $_POST['message']);

if(!empty($message)){
    mysqli_query($conn, "INSERT INTO messages (sender_id, receiver_id, message, created_at) 
    VALUES ('$sender_id', '$receiver_id', '$message', NOW())");
}
?>
