<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {
    header("Location: ../login.php");
    exit();
}


$sql = "SELECT * FROM users WHERE role='student' ORDER BY user_id DESC";
$result = mysqli_query($conn, $sql);

$page_title = "Student List";
include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main">

    <div class="navbar">
        <div class="page-title">Student List</div>

        <div class="user-box">
            <span class="user-name"><?= $_SESSION['name'] ?></span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">

        <div class="card">
            <h3>All Students</h3>
            <p style="color:#94a3b8;">
                Manage student information in the system.
            </p>
        </div>

        <br>

        <div class="card">

            <div class="table-container">
                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Class</th>
                            <th>Mentor</th>
                            <th>Supervisor</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if ($result && mysqli_num_rows($result) > 0): ?>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>

                            <tr>
                                <td><?= $row['user_id'] ?></td>

                                <td><?= htmlspecialchars($row['name']) ?></td>

                                <td><?= htmlspecialchars($row['email']) ?></td>

                                
                                <td><?= htmlspecialchars($row['contact'] ?? '-') ?></td>

                                <td><?= htmlspecialchars($row['class'] ?? '-') ?></td>

                                <td><?= htmlspecialchars($row['mentor_name'] ?? '-') ?></td>

                                <td><?= htmlspecialchars($row['supervisor_name'] ?? '-') ?></td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="7">No students found</td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>
