<?php
session_start();
include '../config/db.php';

// Check student login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$student_id = (int)$_SESSION['user_id'];
$success = "";
$error = "";

if (isset($_POST['save_internship'])) {

    $company_name    = mysqli_real_escape_string($conn, trim($_POST['company_name']));
    $company_address = mysqli_real_escape_string($conn, trim($_POST['company_address']));
    $company_contact = mysqli_real_escape_string($conn, trim($_POST['company_contact']));
    $role            = mysqli_real_escape_string($conn, trim($_POST['role']));
    $supervisor_name = mysqli_real_escape_string($conn, trim($_POST['supervisor_name']));
    $start_date      = mysqli_real_escape_string($conn, trim($_POST['start_date']));
    $end_date        = mysqli_real_escape_string($conn, trim($_POST['end_date']));
    $stipend         = mysqli_real_escape_string($conn, trim($_POST['stipend']));
    $mode            = mysqli_real_escape_string($conn, trim($_POST['mode']));
    $mentor          = mysqli_real_escape_string($conn, trim($_POST['mentor']));

    
    $check = mysqli_query($conn,
        "SELECT internship_id FROM internships WHERE student_id = $student_id LIMIT 1"
    );

    if ($check && mysqli_num_rows($check) > 0) {
        // Update existing record
        $row = mysqli_fetch_assoc($check);
        $internship_id = (int)$row['internship_id'];

        $sql = "UPDATE internships SET
                    company_name    = '$company_name',
                    company_address = '$company_address',
                    company_contact = '$company_contact',
                    role            = '$role',
                    supervisor_name = '$supervisor_name',
                    start_date      = '$start_date',
                    end_date        = '$end_date',
                    stipend         = '$stipend',
                    mode            = '$mode',
                    mentor          = '$mentor'
                WHERE internship_id = $internship_id";
    } else {
        // Insert new record
        $sql = "INSERT INTO internships
                (student_id, company_name, company_address, company_contact, role,
                 supervisor_name, start_date, end_date, stipend, mode, mentor)
                VALUES
                ($student_id, '$company_name', '$company_address', '$company_contact',
                 '$role', '$supervisor_name', '$start_date', '$end_date',
                 '$stipend', '$mode', '$mentor')";
    }

    if (mysqli_query($conn, $sql)) {
        $success = "Internship details saved successfully.";
    } else {
        $error = "Database Error: " . mysqli_error($conn);
    }
}

$internship = [];
$result = mysqli_query($conn,
    "SELECT * FROM internships WHERE student_id = $student_id LIMIT 1"
);

if ($result && mysqli_num_rows($result) > 0) {
    $internship = mysqli_fetch_assoc($result);
}


$sql = "SELECT * FROM internships WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $sql);

$page_title = "Internship Details";
include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main">
    <div class="navbar">
        <div class="page-title">Internship Details</div>
        <div class="user-box">
            <span class="user-name"><?= htmlspecialchars($_SESSION['name']) ?></span>
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="card">
            <h3>Internship Information</h3>
            <p style="color:#94a3b8; margin-bottom:25px;">
                Enter your internship details. Existing data will be updated automatically.
            </p>

            <form method="POST" class="internship-form">
                <div class="form-grid">

                 <div class="form-group">
                      <label>Company Name</label>
                      <input type="text"
                             name="company_name"
                             value="<?= htmlspecialchars($internship['company_name'] ?? '') ?>"
                             placeholder="Enter company name"
                             required>
                </div>  

                    <div class="form-group">
                        <label>Company Address</label>
                        <input type="text" name="company_address"
                               value="<?= htmlspecialchars($internship['company_address'] ?? '') ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Company Contact</label>
                        <input type="text" name="company_contact"
                               value="<?= htmlspecialchars($internship['company_contact'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Role / Position</label>
                        <input type="text" name="role"
                               value="<?= htmlspecialchars($internship['role'] ?? '') ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Supervisor Name</label>
                        <input type="text" name="supervisor_name"
                               value="<?= htmlspecialchars($internship['supervisor_name'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>College Mentor Name</label>
                        <input type="text" name="mentor"
                               value="<?= htmlspecialchars($internship['mentor'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date"
                               value="<?= htmlspecialchars($internship['start_date'] ?? '') ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date"
                               value="<?= htmlspecialchars($internship['end_date'] ?? '') ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Stipend</label>
                        <input type="text" name="stipend"
                               value="<?= htmlspecialchars($internship['stipend'] ?? '') ?>"
                               placeholder="e.g. 15000">
                    </div>

                    <div class="form-group">
                        <label>Internship Mode</label>
                        <select name="mode" required>
                            <option value="Online"  <?= (($internship['mode'] ?? '') == 'Online') ? 'selected' : '' ?>>Online</option>
                            <option value="Offline" <?= (($internship['mode'] ?? '') == 'Offline') ? 'selected' : '' ?>>Offline</option>
                            <option value="Hybrid"  <?= (($internship['mode'] ?? '') == 'Hybrid') ? 'selected' : '' ?>>Hybrid</option>
                        </select>
                    </div>

                </div>

                <button type="submit" name="save_internship" class="btn" style="margin-top:25px;">
                    Save Internship Details
                </button>
            </form>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>
