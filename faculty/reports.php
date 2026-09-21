<?php
session_start();
include '../config/db.php';

// Check faculty login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {
    header("Location: ../login.php");
    exit();
}

$page_title = "Student Reports";
include '../includes/header.php';
include '../includes/sidebar.php';

// Fetch all student reports with student names
$sql = "SELECT weekly_reports.*, users.user_id, users.name
        FROM weekly_reports
        JOIN users ON weekly_reports.student_id = users.user_id
        ORDER BY weekly_reports.report_id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}
?>

<div class="main">
    <div class="navbar">
        <div class="page-title">Student Reports</div>
        <div class="user-box">
            <span class="user-name"><?= htmlspecialchars($_SESSION['name']) ?></span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">
        <div class="card">
            <h3>Submitted Weekly Reports</h3>
            <p style="color:#94a3b8; margin-bottom:20px;">
                Review student reports and provide suggestions or feedback.
            </p>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Week No</th>
                            <th>Report File</th>
                            <th>Upload Date</th>
                            <th>Suggestions</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <!-- Student Name -->
                                <td>
                                    <?= htmlspecialchars($row['name'] ?? 'Student') ?>
                                </td>

                                <!-- Week Number -->
                                <td>
                                    Week <?= htmlspecialchars($row['week_no'] ?? '1') ?>
                                </td>

                                <!-- Report File -->
                                <td>
                                    <?php if (!empty($row['file_path'])): ?>
                                        <a href="../uploads/<?= urlencode($row['file_path']) ?>"
                                           target="_blank"
                                           class="btn">
                                            Open Report
                                        </a>
                                    <?php else: ?>
                                        No File
                                    <?php endif; ?>
                                </td>

                                <!-- Upload Date -->
                                <td>
                                    <?= htmlspecialchars($row['upload_date'] ?? '') ?>
                                </td>

                                <!-- Suggestions -->
                                <td>
                                 <a class="btn"
                                 href="give_suggestion.php?report_id=<?php echo $row['report_id']; ?>&student_id=<?php echo $row['user_id']; ?>">
                                 Give Feedback
                                 </a>
                                   
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No reports submitted yet.</td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>