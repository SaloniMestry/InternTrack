<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {
    header("Location: ../login.php");
    exit();
}

include '../config/db.php';

$page_title = "Faculty Dashboard";
include '../includes/header.php';
include '../includes/sidebar.php';

// Statistics
$students_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='student'")
)['total'] ?? 0;

$reports_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM weekly_reports")
)['total'] ?? 0;

$feedback_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM suggestions")
)['total'] ?? 0;

$deadline_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM deadlines")
)['total'] ?? 0;
?>

<div class="main">
    <div class="navbar">
        <div class="page-title">Faculty Dashboard</div>
        <div class="user-box">
            <span class="user-name"><?= htmlspecialchars($_SESSION['name']) ?></span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">

        <div class="card">
            <h3>Welcome, <?= htmlspecialchars($_SESSION['name']) ?> 👨‍🏫</h3>
            <p style="color:#94a3b8;">
                Monitor student internships, review reports,
                provide feedback, and manage deadlines efficiently.
            </p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-number"><?= $students_count ?></div>
                <div class="stat-label">Registered Students</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?= $reports_count ?></div>
                <div class="stat-label">Reports Submitted</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?= $feedback_count ?></div>
                <div class="stat-label">Suggestions Given</div>
            </div>

            <div class="stat-card">
                <div class="stat-number"><?= $deadline_count ?></div>
                <div class="stat-label">Managed Deadlines</div>
            </div>
        </div>

        <div class="card">
            <h3>Quick Actions</h3>
            <div style="display:flex; flex-wrap:wrap; gap:15px; margin-top:15px;">
                <a href="students.php" class="btn">View Students</a>
                <a href="reports.php" class="btn">Review Reports</a>
                <a href="internships.php" class="btn">View Internships</a>
                <a href="deadlines.php" class="btn">Manage Deadlines</a>
            </div>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>