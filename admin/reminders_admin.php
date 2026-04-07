<?php
include 'includes/header.php'; // admin header
$result = $conn->query("SELECT r.*, u.name AS username FROM reminders r JOIN users u ON r.user_id=u.id ORDER BY reminder_date ASC");
?>

<h2>All Reminders</h2>
<table border="1" cellpadding="5">
<tr>
    <th>User</th>
    <th>Title</th>
    <th>Description</th>
    <th>Date</th>
    <th>Status</th>
</tr>
<?php while($row=$result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['username']) ?></td>
    <td><?= htmlspecialchars($row['title']) ?></td>
    <td><?= htmlspecialchars($row['description']) ?></td>
    <td><?= $row['reminder_date'] ?></td>
    <td><?= $row['is_done'] ? "Done" : "Pending" ?></td>
</tr>
<?php endwhile; ?>
</table>