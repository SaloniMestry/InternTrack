<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION['user_id'];


$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$id'");
$user = mysqli_fetch_assoc($result);


if (isset($_POST['save'])) {

    $contact = $_POST['contact'];
    $class = $_POST['class'];
    $mentor = $_POST['mentor_name'];
    $supervisor = $_POST['supervisor_name'];

    $sql = "UPDATE users SET 
            contact='$contact',
            class='$class',
            mentor_name='$mentor',
            supervisor_name='$supervisor'
            WHERE user_id='$id'";

    if (mysqli_query($conn, $sql)) {
        $msg = "Profile updated successfully!";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Profile</title>

<style>
body{
    font-family:Arial;
    background:#0f172a;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.card{
    width:450px;
    padding:25px;
    background:rgba(255,255,255,0.05);
    border-radius:15px;
}

input, select{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:none;
    border-radius:8px;
    outline:none;
    box-sizing:border-box;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:linear-gradient(135deg,#3b82f6,#06b6d4);
    color:white;
    font-weight:bold;
    cursor:pointer;
    box-sizing:border-box;
}

label{
    display:block;
    margin-top:10px;
    font-weight:bold;

}
</style>

</head>

<body>

<div class="card">

<h2>My Personal Details</h2>

<?php if(isset($msg)) echo "<p>$msg</p>"; ?>

<form method="POST">

    <label>Contact Number</label>
    <input type="text" name="contact"
           value="<?= htmlspecialchars($user['contact'] ?? '') ?>"
           placeholder="Enter mobile number">

    <label>Class</label>
    <select name="class" required>
        <option value="">Select Class</option>
        <option value="MCA FY" <?= ($user['class'] ?? '')=='MCA FY'?'selected':'' ?>>MCA FY</option>
        <option value="MCA SY" <?= ($user['class'] ?? '')=='MCA SY'?'selected':'' ?>>MCA SY</option>
    </select>

    <label>Mentor Name</label>
    <input type="text" name="mentor_name"
           value="<?= htmlspecialchars($user['mentor_name'] ?? '') ?>"
           placeholder="Enter mentor name">

    <label>Supervisor Name</label>
    <input type="text" name="supervisor_name"
           value="<?= htmlspecialchars($user['supervisor_name'] ?? '') ?>"
           placeholder="Enter supervisor name">

    <button type="submit" name="save">Save Details</button>

</form>

</div>

</body>
</html>
