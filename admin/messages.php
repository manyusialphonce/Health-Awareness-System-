<?php
include '../config/db.php';
include 'includes/header.php';

// Handle delete
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM messages WHERE id=$id");
    echo '<div class="alert success">Ujumbe umefutwa kwa mafanikio!</div>';
}

// Fetch messages
$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>

<link rel="stylesheet" href="css/style.css">
<h2>Ujumbe wa Watumiaji</h2>
<a href="export_messages.php" class="btn">Export PDF</a>
<table>
    <thead>
        <tr><th>Jina</th><th>Email</th><th>Ujumbe</th><th>Muda</th><th>Action</th></tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Una uhakika?')">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>