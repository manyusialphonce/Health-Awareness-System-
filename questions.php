<?php
include 'config/db.php';
session_start();


if(isset($_POST['submit'])){
    $q = $_POST['question'];
    $stmt = $conn->prepare("INSERT INTO questions (user_id, question) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $q);
    $stmt->execute();
    $stmt->close();
}
?>
<link rel="stylesheet" href="css/style.css">
<h2>Uliza Swali</h2>
<form method="POST">
<textarea name="question" required placeholder="Andika swali lako hapa"></textarea>
<button name="submit">Tuma</button>
</form>