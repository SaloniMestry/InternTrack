<?php
session_start();
include '../config/db.php';

// Check student login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$page_title = "Deadlines";
include '../includes/header.php';
include '../includes/sidebar.php';

/*
IMPORTANT:
Your deadlines table does NOT contain the column `deadline_date`.
It uses the column `due_date`.

So we must sort only by `due_date`.
*/
$sql = "SELECT * FROM deadlines ORDER BY due_date ASC";

$result = mysqli_query($conn, $sql);

$query_error = "";
if (!$result) {
    $query_error = mysqli_error($conn);
}
?>

<div class="main">
    <div class="navbar">
        <div class="page-title">Internship Deadlines</div>
        <div class="user-box">
            <span class="user-name"><?= htmlspecialchars($_SESSION['name']) ?></span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">

        <div class="card">
            <h3>Upcoming Deadlines</h3>
            <p style="color:#94a3b8; margin-bottom:20px;">
                Track important submission dates and internship milestones.
            </p>

            <?php if (!empty($query_error)): ?>
                <div class="alert alert-danger">
                    Database Error: <?= htmlspecialchars($query_error) ?>
                </div>

            <?php elseif ($result && mysqli_num_rows($result) > 0): ?>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <?php
                                $date = $row['due_date'] ?? '';
                                $status = 'Upcoming';

                                if (!empty($date)) {
                                    $today = date('Y-m-d');

                                    if ($date < $today) {
                                        $status = 'Expired';
                                    } elseif ($date == $today) {
                                        $status = 'Today';
                                    }
                                }
                            ?>

                            <tr>
                                <td>
                                    <?= htmlspecialchars($row['title'] ?? 'Untitled Deadline') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $row['description']
                                        ?? 'No description provided.'
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($date) ?>
                                </td>

                                <td>
                                    <span class="badge
                                        <?= $status == 'Expired' ? 'badge-danger' :
                                            ($status == 'Today' ? 'badge-warning' :
                                            'badge-success') ?>">
                                        <?= $status ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                        </tbody>
                    </table>
                </div>

            <?php else: ?>
                <p style="color:#94a3b8;">
                    No deadlines available at the moment.
                </p>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>