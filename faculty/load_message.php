<?php
session_start();
include("../config/db.php");

$faculty_id = $_SESSION['user_id'];
$student_id = $_GET['student_id'];

$result = mysqli_query($conn, "
SELECT * FROM messages 
WHERE (sender_id='$faculty_id' AND receiver_id='$student_id') 
   OR (sender_id='$student_id' AND receiver_id='$faculty_id')
ORDER BY created_at ASC
");

while($row = mysqli_fetch_assoc($result)) {

    $isMe = $row['sender_id'] == $faculty_id;

    echo '<div style="
        max-width: 60%;
        padding:10px;
        margin:10px;
        border-radius:10px;
        background:' . ($isMe ? '#6366f1' : '#e5e7eb') . ';
        color:' . ($isMe ? 'white' : 'black') . ';
        margin-left:' . ($isMe ? 'auto' : '0') . ';
    ">';

    echo $row['message'];

    echo '<br><small style="font-size:10px;opacity:0.7;">'
        . date("h:i A", strtotime($row['created_at'])) .
        '</small>';

    echo '</div>';
}
?>
