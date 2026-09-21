<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='faculty'){
    header("Location: ../login.php");
    exit();
}

$sql = "
SELECT internships.*, users.name, users.email
FROM internships
JOIN users
ON internships.student_id = users.user_id
";

$result = mysqli_query($conn,$sql);

$page_title = "Internships";
include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main">

    <div class="navbar">

        <div class="page-title">
            Internship Details
        </div>

        <div class="user-box">
            <span class="user-name">
                <?php echo $_SESSION['name']; ?>
            </span>

            <a href="../logout.php"
            class="logout-btn">
                Logout
            </a>
        </div>

    </div>

    <div class="content">

        <div class="card">

            <h3>Student Internships</h3>

            <p style="color:#94a3b8; margin-bottom:25px;">
                Internship information submitted by students.
            </p>

            <div class="table-container">

                <table>

                    <thead>

                        <tr>
                            <th>Student</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Role</th>
                            <th>Supervisor</th>
                            <th>Mode</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php while($row=mysqli_fetch_assoc($result)){ ?>

                        <tr>

                            <td>
                                <?php echo $row['name']; ?>
                            </td>

                            <td>
                                <?php echo $row['email']; ?>
                            </td>

                            <td>
                                <?php echo $row['company_name']; ?>
                            </td>

                            <td>
                                <?php echo $row['role']; ?>
                            </td>

                            <td>
                                <?php echo $row['supervisor_name']; ?>
                            </td>

                            <td>
                                <?php echo $row['mode']; ?>
                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>