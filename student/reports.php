<?php
session_start();
include '../config/db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$student_id = (int)$_SESSION['user_id'];

$success = "";
$error = "";


$upload_dir = "../uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_POST['upload'])) {

    $week_no = isset($_POST['week_no']) ? (int)$_POST['week_no'] : 1;

    if (isset($_FILES['report_file']) && $_FILES['report_file']['error'] == 0) {

        $original_name = basename($_FILES['report_file']['name']);
        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        $allowed = array('pdf', 'doc', 'docx');

        if (!in_array($extension, $allowed)) {
            $error = "Only PDF, DOC, and DOCX files are allowed.";
        } else {

            $safe_name = preg_replace('/[^A-Za-z0-9._-]/', '_', $original_name);
            $new_filename = time() . "_" . $student_id . "_" . $safe_name;

            $target_path = $upload_dir . $new_filename;

            if (move_uploaded_file($_FILES['report_file']['tmp_name'], $target_path)) {

                
                $sql = "INSERT INTO weekly_reports
                        (student_id, week_no, file_path, upload_date)
                        VALUES
                        ('$student_id', '$week_no', '$new_filename', NOW())";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $success = "Report uploaded successfully.";
                } else {
                    $error = "DB Error: " . mysqli_error($conn);
                }

            } else {
                $error = "Failed to upload file.";
            }
        }

    } else {
        $error = "Please select a file.";
    }
}



$sql_reports = "SELECT * FROM weekly_reports
                WHERE student_id = $student_id
                ORDER BY report_id DESC";

$reports = mysqli_query($conn, $sql_reports);

if (!$reports) {
    $error = "Database Error: " . mysqli_error($conn);
}

$page_title = "Weekly Reports";
include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main">
    <div class="navbar">
        <div class="page-title">Weekly Reports</div>
        <div class="user-box">
            <span class="user-name"><?= htmlspecialchars($_SESSION['name']) ?></span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Upload Form -->
        <div class="card">
            <h3>Upload Weekly Report</h3>

            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Week Number</label>
                    <input type="number" name="week_no" min="1" required>
                </div>

                <div class="form-group">
                    <label>Select Report File (PDF, DOC, DOCX)</label>
                    <input type="file" name="report_file" required>
                </div>

                <button type="submit" name="upload" class="btn">
                    Upload Report
                </button>

            </form>
        </div>

        <!-- Reports List -->
        <div class="card">
            <h3>Submitted Reports</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Week</th>
                            <th>Report File</th>
                            <th>Upload Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if ($reports && mysqli_num_rows($reports) > 0): ?>

                        <?php while ($row = mysqli_fetch_assoc($reports)): ?>

                            <tr>
                                <td>Week <?= htmlspecialchars($row['week_no']) ?></td>

                                <td>
                                    <a href="../uploads/<?= urlencode($row['file_path']) ?>"
                                       target="_blank"
                                       class="btn">
                                        View Report
                                    </a>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['upload_date'] ?? '') ?>
                                </td>

                                <td>
                                    <a href="delete_report.php?id=<?= (int)$row['report_id'] ?>"
                                       class="btn btn-danger"
                                       onclick="return confirm('Are you sure?')">
                                        Remove
                                    </a>
                                </td>
                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4">No reports uploaded yet.</td>
                        </tr>

                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>