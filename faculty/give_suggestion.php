<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='faculty'){
    header("Location: ../login.php");
    exit();
}

$faculty_id = $_SESSION['user_id'];

$report_id = $_GET['report_id'] ?? 0;
$student_id = $_GET['student_id'] ?? 0;

$message = "";

/* SUBMIT FEEDBACK */
if(isset($_POST['submit']))
{
    $suggestion = mysqli_real_escape_string($conn,$_POST['suggestion']);

    $sql = "INSERT INTO suggestions(student_id,faculty_id,report_id,suggestion)
            VALUES('$student_id','$faculty_id','$report_id','$suggestion')";

    if(mysqli_query($conn,$sql)){
        $message = "Suggestion submitted successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Give Suggestion</title>

<style>

body{
    font-family:Arial;
    background:#0f172a;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.card{
    width:500px;
    padding:23px;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    border-radius:20px;
}

h2{
    margin-bottom:15px;
}

textarea{
    width:94%;
    height:130px;
    padding:12px;
    border-radius:10px;
    border:none;
    outline:none;
    font-size:14px;
    resize:none;
    background:#0f172a;
    color:white;
    border:1px solid rgba(255,255,255,0.1);
}

button{
    width:98%;
    padding:12px;
    margin-top:15px;
    border:none;
    border-radius:10px;
    background:linear-gradient(135deg,#3b82f6,#06b6d4);
    color:white;
    font-weight:bold;
    cursor:pointer;
    font-size:14px;
}

button:hover{
    transform:translateY(-2px);
    transition:0.2s;
}

.message{
    color:#22c55e;
    margin-bottom:10px;
}

</style>

</head>

<body>

<div class="card">

    <h2>Give Feedback</h2>

    <?php if($message!=""){ ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <textarea name="suggestion" placeholder="Write your feedback..." required></textarea>

        <button type="submit" name="submit">
            Submit Suggestion
        </button>

    </form>

</div>

</body>
</html>