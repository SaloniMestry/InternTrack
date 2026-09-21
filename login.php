<?php
session_start();
include 'config/db.php';

$error = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        // Verify hashed password
        if(password_verify($password, $row['password']))
        {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            if($row['role'] == 'student')
            {
                header("Location: student/dashboard.php");
            }
            else
            {
                header("Location: faculty/dashboard.php");
            }

            exit();
        }
        else
        {
            $error = "Invalid password!";
        }
    }
    else
    {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - InternTrack</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#020617;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    overflow:hidden;
}

/* BACKGROUND */

.bg{
    position:fixed;
    width:100%;
    height:100%;
    z-index:-1;
}

.glow{
    position:absolute;
    border-radius:50%;
    filter:blur(120px);
    opacity:0.5;
}

.glow1{
    width:350px;
    height:350px;
    background:#3b82f6;
    top:-100px;
    left:-100px;
}

.glow2{
    width:300px;
    height:300px;
    background:#22c55e;
    bottom:-100px;
    right:-80px;
}

/* CARD */

.card{
    width:420px;
    padding:45px;
    border-radius:28px;
    background:rgba(15,23,42,0.75);
    backdrop-filter:blur(16px);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:0 20px 60px rgba(0,0,0,0.45);
    color:white;
}

.card h1{
    text-align:center;
    margin-bottom:10px;
}

.card p{
    text-align:center;
    color:#94a3b8;
    margin-bottom:30px;
}

.input-group{
    margin-bottom:20px;
}

.input-group label{
    display:block;
    margin-bottom:8px;
    color:#cbd5e1;
}

.input-group input{
    width:100%;
    padding:14px;
    border:none;
    outline:none;
    border-radius:14px;
    background:#0f172a;
    color:white;
    font-size:15px;
    border:1px solid rgba(255,255,255,0.08);
}

.btn{
    width:100%;
    padding:15px;
    border:none;
    border-radius:14px;
    background:linear-gradient(135deg,#3b82f6,#06b6d4);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    transform:translateY(-3px);
}

.error{
    text-align:center;
    margin-bottom:20px;
    color:#ef4444;
}

.bottom{
    margin-top:20px;
    text-align:center;
    color:#94a3b8;
}

.bottom a{
    color:#60a5fa;
    text-decoration:none;
}

</style>
</head>
<body>

<div class="bg">
    <div class="glow glow1"></div>
    <div class="glow glow2"></div>
</div>

<div class="card">

    <h1>Welcome Back</h1>

    <p>Login to continue to InternTrack</p>

    <?php if($error!=""){ ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn">
            Login
        </button>

    </form>

    <div class="bottom">
        Don't have an account?
        <a href="register.php">Register</a>
    </div>

</div>

</body>
</html>