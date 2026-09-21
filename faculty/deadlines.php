<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='faculty'){
    header("Location: ../login.php");
    exit();
}

$message = "";

if(isset($_POST['add_deadline']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $sql = "INSERT INTO deadlines(title,description,due_date)
            VALUES('$title','$description','$due_date')";

    if(mysqli_query($conn,$sql)){
        $message = "Deadline added successfully!";
    }
}

$result = mysqli_query($conn,
"SELECT * FROM deadlines ORDER BY due_date ASC");

$page_title = "Deadlines";
include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main">

    <div class="navbar">
        <div class="page-title">Manage Deadlines</div>

        <div class="user-box">
            <span class="user-name">
                <?php echo $_SESSION['name']; ?>
            </span>

            <a href="../logout.php" class="logout-btn">
                Logout
            </a>
        </div>
    </div>

    <div class="content">

        <div class="card">

            <h3>Add Deadline</h3>

            <?php if($message!=""){ ?>
                <div class="alert alert-success">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST" class="internship-form">

                <div class="form-grid">

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" required>
                    </div>

                    <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" name="due_date" required>
                    </div>

                    <div class="form-group" style="grid-column:1/3;">
                        <label>Description</label>
                        <textarea name="description"
                        style="width:100%; height:120px;"></textarea>
                    </div>

                </div>

                <button type="submit"
                name="add_deadline"
                class="btn">
                    Add Deadline
                </button>

            </form>

        </div>

        <div class="card" style="margin-top:30px;">

            <h3>All Deadlines</h3>

            <div class="table-container">

                <table>

                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php while($row=mysqli_fetch_assoc($result)){ ?>

                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['due_date']; ?></td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>