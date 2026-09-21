<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

include '../config/db.php';

$page_title = "Student Dashboard";
include '../includes/header.php';
include '../includes/sidebar.php';


$student_id = $_SESSION['user_id'];

$reports_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM weekly_reports WHERE student_id = '$student_id'")
)['total'] ?? 0;

$internship_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM internships WHERE student_id = '$student_id'")
)['total'] ?? 0;


$feedback_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM suggestions WHERE student_id = '$student_id'")
)['total'] ?? 0;

$deadline_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM deadlines")
)['total'] ?? 0;
?>

<div class="main">
    <div class="navbar">
        <div class="page-title">Student Dashboard</div>
        <div class="user-box">
            <span class="user-name"><?= htmlspecialchars($_SESSION['name']) ?></span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">

        <div class="card">
            <h3>Welcome Back, <?= htmlspecialchars($_SESSION['name']) ?> 👋</h3>
            <p style="color:#94a3b8;">
                Track your internship progress, upload weekly reports,
                and review faculty suggestions in one place.
            </p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-number"><?= $reports_count ?></div>
                <div class="stat-label">Weekly Reports Submitted</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?= $internship_count ?></div>
                <div class="stat-label">Internship Records</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?= $feedback_count ?></div>
                <div class="stat-label">Faculty Suggestions</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?= $deadline_count ?></div>
                <div class="stat-label">Active Deadlines</div>
            </div>
        </div>

        <div class="card">
            <h3>Quick Actions</h3>
            <div style="display:flex; flex-wrap:wrap; gap:15px; margin-top:15px;">
                <a href="reports.php" class="btn">Upload Report</a>
                <a href="internship.php" class="btn">Internship Details</a>
                <a href="deadlines.php" class="btn">View Deadlines</a>
                <a href="suggestions.php" class="btn">Faculty Suggestions</a>
            </div>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>
