<?php
$role = $_SESSION['role'] ?? 'student';
$current = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
    <div class="logo">Intern<span>Track</span></div>
    <div class="logo-sub">Internship Monitoring System</div>

    <div class="menu">
        <?php if ($role == 'student'): ?>
            <a href="dashboard.php" class="<?= $current=='dashboard.php' ? 'active' : '' ?>">Dashboard</a>
            <a href="profile.php">My Profile</a>
            <a href="reports.php" class="<?= $current=='reports.php' ? 'active' : '' ?>">Weekly Reports</a>
            <a href="internship.php" class="<?= $current=='internship.php' ? 'active' : '' ?>">Internship</a>
            <a href="deadlines.php" class="<?= $current=='deadlines.php' ? 'active' : '' ?>">Deadlines</a>
            <a href="suggestions.php" class="<?= $current=='suggestions.php' ? 'active' : '' ?>">Suggestions</a>
        <?php else: ?>
            <a href="dashboard.php" class="<?= $current=='dashboard.php' ? 'active' : '' ?>">Dashboard</a>
            <a href="students.php" class="<?= $current=='students.php' ? 'active' : '' ?>">Students</a>
            <a href="reports.php" class="<?= $current=='reports.php' ? 'active' : '' ?>">Reports</a>
            <a href="internships.php" class="<?= $current=='internships.php' ? 'active' : '' ?>">Internships</a>
            <a href="deadlines.php" class="<?= $current=='deadlines.php' ? 'active' : '' ?>">Deadlines</a>
        <?php endif; ?>

        <a href="../logout.php">Logout</a>
    </div>
</div>