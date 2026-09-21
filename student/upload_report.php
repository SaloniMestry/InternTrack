<?php
session_start();
include('../config/db.php');

// check login
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

if(isset($_POST['submit'])){

    $week = $_POST['week_number'];
    $work = $_POST['work_done'];
    $skills = $_POST['skills_learned'];
    $problems = $_POST['problems'];

    // FILE UPLOAD
    $file = $_FILES['report_file'];

    $filename = time() . "_" . basename($file['name']); // unique name
    $target = "../uploads/" . $filename;

    // check file selected
    if(empty($file['name'])){
        echo "<script>alert('Please select a file');</script>";
    } else {

        // move file
        if(move_uploaded_file($file['tmp_name'], $target)){

            // insert into DB
            $sql = "INSERT INTO weekly_reports 
                    (student_id, week_number, work_done, skills_learned, problems, report_file, submission_date)
                    VALUES 
                    ('$student_id', '$week', '$work', '$skills', '$problems', '$filename', NOW())";

            if(mysqli_query($conn, $sql)){
                echo "<script>alert('Report uploaded successfully'); window.location='reports.php';</script>";
            } else {
                echo "<script>alert('Database error');</script>";
            }

        } else {
            echo "<script>alert('File upload failed');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Report</title>

    <style>
        body{
            font-family: Arial;
            background:#0f172a;
            color:white;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .form-box{
            background:#1e293b;
            padding:30px;
            border-radius:10px;
            width:400px;
        }

        input, textarea{
            width:100%;
            padding:10px;
            margin:8px 0;
            border:none;
            border-radius:5px;
        }

        button{
            width:100%;
            padding:10px;
            background:#22c55e;
            border:none;
            color:white;
            font-weight:bold;
            cursor:pointer;
        }

        button:hover{
            background:#16a34a;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h2>Upload Weekly Report</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="number" name="week_number" placeholder="Week Number" required>

        <textarea name="work_done" placeholder="Work Done" required></textarea>

        <textarea name="skills_learned" placeholder="Skills Learned" required></textarea>

        <textarea name="problems" placeholder="Problems Faced"></textarea>

        <input type="file" name="report_file" required>

        <button type="submit" name="submit">Upload Report</button>

    </form>
</div>

</body>
</html>
