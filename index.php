<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>InternTrack</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{
    font-family:'Poppins',sans-serif;
    background:#020617;
    color:white;
    overflow-x:hidden;
}

/* ===================== BACKGROUND ===================== */

.background{
    position:fixed;
    width:100%;
    height:100%;
    z-index:-1;
    overflow:hidden;
}

.glow{
    position:absolute;
    border-radius:50%;
    filter:blur(120px);
    opacity:0.45;
    animation:float 12s infinite ease-in-out;
}

.glow1{
    width:420px;
    height:420px;
    background:#3b82f6;
    top:-100px;
    left:-100px;
}

.glow2{
    width:350px;
    height:350px;
    background:#06b6d4;
    bottom:-120px;
    right:-50px;
    animation-delay:2s;
}

.glow3{
    width:300px;
    height:300px;
    background:#22c55e;
    top:45%;
    left:40%;
    animation-delay:4s;
}

@keyframes float{
    0%{
        transform:translateY(0px);
    }
    50%{
        transform:translateY(-50px);
    }
    100%{
        transform:translateY(0px);
    }
}

/* ===================== NAVBAR ===================== */

.navbar{
    width:100%;
    padding:22px 80px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:fixed;
    top:0;
    z-index:100;
    background:rgba(2,6,23,0.55);
    backdrop-filter:blur(18px);
    border-bottom:1px solid rgba(255,255,255,0.06);
}

.logo{
    font-size:34px;
    font-weight:700;
    background:linear-gradient(135deg,#60a5fa,#22c55e);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.nav-links{
    display:flex;
    gap:35px;
    align-items:center;
}

.nav-links a{
    color:#cbd5e1;
    text-decoration:none;
    font-size:15px;
    transition:0.3s;
}

.nav-links a:hover{
    color:white;
}

.login-btn{
    padding:13px 28px;
    border-radius:14px;
    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:white;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}

.login-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 30px rgba(34,197,94,0.3);
}

/* ===================== HERO ===================== */

.hero{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:120px 20px 80px;
}

.hero-content{
    max-width:1050px;
}

.badge{
    display:inline-block;
    padding:10px 20px;
    border-radius:50px;
    background:rgba(59,130,246,0.12);
    border:1px solid rgba(59,130,246,0.2);
    color:#93c5fd;
    margin-bottom:30px;
    font-size:14px;
}

.hero h1{
    font-size:58px;
    line-height:1.2;
    margin-bottom:25px;
    font-weight:700;
}

.gradient-text{
    background:linear-gradient(135deg,#60a5fa,#22c55e);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.hero p{
    max-width:780px;
    margin:auto;
    color:#cbd5e1;
    line-height:1.9;
    font-size:20px;
    margin-bottom:40px;
}

.hero-buttons{
    display:flex;
    justify-content:center;
    gap:20px;
    flex-wrap:wrap;
}

.primary-btn{
    padding:18px 40px;
    border-radius:18px;
    background:linear-gradient(135deg,#3b82f6,#06b6d4);
    color:white;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}

.secondary-btn{
    padding:18px 40px;
    border-radius:18px;
    border:1px solid rgba(255,255,255,0.12);
    background:rgba(255,255,255,0.03);
    color:white;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}

.primary-btn:hover,
.secondary-btn:hover{
    transform:translateY(-5px);
}

/* ===================== FEATURES ===================== */

.features{
    padding:100px 80px;
}

.section-title{
    text-align:center;
    font-size:50px;
    margin-bottom:18px;
}

.section-subtitle{
    text-align:center;
    color:#94a3b8;
    margin-bottom:60px;
    font-size:18px;
}

.feature-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:30px;
}

.feature-card{
    padding:45px;
    border-radius:28px;
    background:rgba(15,23,42,0.6);
    border:1px solid rgba(255,255,255,0.06);
    backdrop-filter:blur(14px);
    transition:0.4s;
}

.feature-card:hover{
    transform:translateY(-12px);
    box-shadow:0 20px 50px rgba(0,0,0,0.4);
}

.icon{
    width:70px;
    height:70px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:34px;
    margin-bottom:25px;
    background:linear-gradient(135deg,#3b82f6,#06b6d4);
}

.feature-card h3{
    font-size:28px;
    margin-bottom:15px;
}

.feature-card p{
    color:#cbd5e1;
    line-height:1.9;
}

/* ===================== STATS ===================== */

.stats{
    padding:20px 80px 100px;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
}

.stat-card{
    padding:40px;
    border-radius:24px;
    text-align:center;
    background:rgba(15,23,42,0.6);
    border:1px solid rgba(255,255,255,0.06);
    backdrop-filter:blur(14px);
}

.stat-card h2{
    font-size:46px;
    margin-bottom:12px;
    color:#60a5fa;
}

.stat-card p{
    color:#cbd5e1;
}

/* ===================== CTA ===================== */

.cta{
    padding:100px 20px;
}

.cta-box{
    max-width:1000px;
    margin:auto;
    padding:70px;
    border-radius:32px;
    text-align:center;
    background:linear-gradient(135deg,
    rgba(59,130,246,0.15),
    rgba(34,197,94,0.12));
    border:1px solid rgba(255,255,255,0.08);
    backdrop-filter:blur(20px);
}

.cta-box h2{
    font-size:52px;
    margin-bottom:20px;
}

.cta-box p{
    color:#cbd5e1;
    line-height:1.9;
    margin-bottom:35px;
}

/* ===================== FOOTER ===================== */

.footer{
    padding:35px;
    text-align:center;
    border-top:1px solid rgba(255,255,255,0.05);
    color:#94a3b8;
}

/* ===================== RESPONSIVE ===================== */

@media(max-width:900px){

    .navbar{
        padding:20px;
    }

    .nav-links{
        display:none;
    }

    .hero h1{
        font-size:38px;
    }

    .hero p{
        font-size:16px;
    }

    .features,
    .stats{
        padding:80px 20px;
    }

    .cta-box{
        padding:40px 25px;
    }

    .cta-box h2{
        font-size:36px;
    }
}

</style>
</head>
<body>

<!-- BACKGROUND -->

<div class="background">
    <div class="glow glow1"></div>
    <div class="glow glow2"></div>
    <div class="glow glow3"></div>
</div>

<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">
        InternTrack
    </div>

    <div class="nav-links">
        <a href="#features">Features</a>
        <a href="#stats">Statistics</a>
        <a href="#contact">Contact</a>

     <div style="display:flex; gap:15px; align-items:center;">

    <div style="display:flex; gap:15px; align-items:center;">

    <a href="login.php" class="login-btn">
        Login
    </a>

    <a href="register.php" class="login-btn"
       style="background:linear-gradient(135deg,#3b82f6,#06b6d4);">
        Register
    </a>

</div>


</div>   
    </div>

</div>

<!-- HERO -->

<section class="hero">

    <div class="hero-content">

        <div class="badge">
            🚀 Modern Internship Management Platform
        </div>

        <h1>
            Internship Tracking
            <span class="gradient-text">Reimagined</span>
        </h1>

        <p>
            A powerful digital platform designed for students and faculty
            to manage internship reports, monitor progress, review submissions,
            track deadlines, and simplify academic internship workflows.
        </p>

        <div class="hero-buttons">

            <a href="login.php" class="primary-btn">
                Get Started
            </a>

            <a href="#features" class="secondary-btn">
                Explore Features
            </a>

        </div>

    </div>

</section>

<!-- FEATURES -->

<section class="features" id="features">

    <h2 class="section-title">
        Powerful Features
    </h2>

    <p class="section-subtitle">
        Everything needed to simplify internship management
    </p>

    <div class="feature-grid">

        <div class="feature-card">
            <div class="icon">📄</div>

            <h3>Weekly Reports</h3>

            <p>
                Upload and manage internship reports digitally with
                smooth faculty review and organized storage.
            </p>
        </div>

        <div class="feature-card">
            <div class="icon">💬</div>

            <h3>Faculty Feedback</h3>

            <p>
                Faculty can provide suggestions, comments,
                and performance feedback directly in the system.
            </p>
        </div>

        <div class="feature-card">
            <div class="icon">📅</div>

            <h3>Deadline Tracking</h3>

            <p>
                Stay updated with important internship milestones,
                submissions, and review deadlines.
            </p>
        </div>

    </div>

</section>

<!-- STATS -->

<section class="stats" id="stats">

    <div class="stats-grid">

        <div class="stat-card">
            <h2>100%</h2>
            <p>Digital Workflow</p>
        </div>

        <div class="stat-card">
            <h2>24/7</h2>
            <p>System Accessibility</p>
        </div>

        <div class="stat-card">
            <h2>Secure</h2>
            <p>Authentication System</p>
        </div>

        <div class="stat-card">
            <h2>Fast</h2>
            <p>Report Management</p>
        </div>

    </div>

</section>

<!-- CTA -->

<section class="cta" id="contact">

    <div class="cta-box">

        <h2>
            Ready to Streamline Internships?
        </h2>

        <p>
            Experience a smarter and more professional way
            to manage student internships and academic progress.
        </p>

        <a href="login.php" class="primary-btn">
            Launch Platform
        </a>

    </div>

</section>

<!-- FOOTER -->

<div class="footer">
    © 2026 InternTrack • Internship Tracking System
</div>

</body>
</html>