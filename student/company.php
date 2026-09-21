<?php
include("../config/db.php");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $email = $_POST['email'];

    mysqli_query($conn, "INSERT INTO companies (name, location, contact_email)
    VALUES ('$name','$location','$email')");

    echo "<script>alert('Company Saved');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Company</title>
<link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<div class="main">

<h2>🏢 Add Company</h2>

<div class="card" style="max-width:500px;">

<form method="POST">

<label>Company Name</label>
<input type="text" name="name" required>

<label>Location</label>
<input type="text" name="location">

<label>Email</label>
<input type="email" name="email">

<button name="submit">Save Company</button>

</form>

</div>

</div>

</body>
</html>
