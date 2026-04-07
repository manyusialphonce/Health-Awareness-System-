<?php
include 'config/db.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $reminder_date = $_POST['reminder_date'];

    $stmt = $conn->prepare("INSERT INTO reminders (user_id, title, description, reminder_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $title, $description, $reminder_date);
    $stmt->execute();
    $stmt->close();

    header("Location: reminders.php");
    exit();
}
?>

<h2>Ongeza Reminder</h2>
<form method="POST" class="reminder-form">
    <input type="text" name="title" placeholder="Kichwa cha Reminder" required>
    <textarea name="description" placeholder="Maelezo ya Reminder"></textarea>
    <input type="datetime-local" name="reminder_date" required>
    <button type="submit" name="submit">Ongeza Reminder</button>
</form>