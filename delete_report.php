<?php
session_start();
include('config/db.php');

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    
    $res = $conn->query("SELECT * FROM weekly_reports WHERE report_id=$id");
    $row = $res->fetch_assoc();

    if(!$row){
        die("Report not found");
    }

    
    $file = "uploads/" . $row['report_file'];
    if(file_exists($file)){
        unlink($file);
    }

    
    $conn->query("DELETE FROM feedback WHERE report_id=$id");
    
    $conn->query("DELETE FROM weekly_reports WHERE report_id=$id");

    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
