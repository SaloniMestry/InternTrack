<?php
$conn = $conn = $conn = new mysqli("localhost","root","","interntrack_db",3306);;

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}
?>