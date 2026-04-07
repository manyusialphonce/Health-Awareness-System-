<?php
include 'config/db.php';
session_start();
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM reminders WHERE user_id=? ORDER BY reminder_date ASC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>My Reminders</h2>
<table border="1" cellpadding="5">
<tr>
    <th>Title</th>
    <th>Description</th>
    <th>Date</th>
    <th>Status</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['title']) ?></td>
    <td><?= htmlspecialchars($row['description']) ?></td>
    <td><?= $row['reminder_date'] ?></td>
    <td><?= $row['is_done'] ? "Done" : "Pending" ?></td>
</tr>
<?php endwhile; ?>
</table>