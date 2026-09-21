<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student'){
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

/* FETCH FACULTY SUGGESTIONS */
$sql = "
SELECT s.*, u.name AS faculty_name
FROM suggestions s
JOIN users u ON s.faculty_id = u.user_id
WHERE s.student_id = '$student_id'
ORDER BY s.created_at DESC
";

$result = mysqli_query($conn, $sql);
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="main">

    <div class="navbar">
        <div class="page-title">Faculty Suggestions</div>

        <div class="user-box">
            <span class="user-name">
                <?= htmlspecialchars($_SESSION['name']) ?>
            </span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">

        <div class="card">
            <h3>Your Feedback from Faculty</h3>
            <p style="color:#94a3b8;">
                All suggestions and feedback provided by your faculty will appear here.
            </p>
        </div>

        <br>

        <?php if(mysqli_num_rows($result) > 0){ ?>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <div class="card" style="margin-bottom:15px;">
                    <h4>From: <?= htmlspecialchars($row['faculty_name']) ?></h4>

                    <p style="margin-top:10px; color:#cbd5e1;">
                        <?= htmlspecialchars($row['suggestion']) ?>
                    </p>

                    <small style="color:#64748b;">
                        <?= $row['created_at'] ?>
                    </small>
                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="card">
                <p style="color:#94a3b8;">
                    No suggestions received yet.
                </p>
            </div>

        <?php } ?>

    </div>

</div>

<?php include '../includes/footer.php'; ?>