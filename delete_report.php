<?php
session_start();
include('config/db.php');

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // fetch report
    $res = $conn->query("SELECT * FROM weekly_reports WHERE report_id=$id");
    $row = $res->fetch_assoc();

    if(!$row){
        die("Report not found");
    }

    // delete file
    $file = "uploads/" . $row['report_file'];
    if(file_exists($file)){
        unlink($file);
    }

    // delete feedback first (important)
    $conn->query("DELETE FROM feedback WHERE report_id=$id");

    // delete report
    $conn->query("DELETE FROM weekly_reports WHERE report_id=$id");

    // go back
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
