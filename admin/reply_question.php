<?php
include 'config/db.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(isset($_POST['qid'],$_POST['answer'])){
    $stmt = $conn->prepare("INSERT INTO answers (question_id, answer, admin_id) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $_POST['qid'], $_POST['answer'], $admin_id);
    $stmt->execute();
    $stmt->close();
    header("Location: questions_admin.php");
    exit();
}
?>