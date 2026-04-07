<?php include 'includes/header.php'; ?>
<?php include '../config/db.php'; ?>
<link rel="stylesheet" href="../css/style.css">
<h2>Dashboard</h2>

<?php
// Count messages
$msgCount = $conn->query("SELECT COUNT(*) as total FROM messages")->fetch_assoc()['total'];

// Count diseases
$diseaseCount = $conn->query("SELECT COUNT(*) as total FROM diseases")->fetch_assoc()['total'];

// Count symptoms
$symCount = $conn->query("SELECT COUNT(*) as total FROM symptoms")->fetch_assoc()['total'];
?>

<div class="dashboard-cards">
    <div class="card">
        <h3>Ujumbe wa Watumiaji</h3>
        <p><?php echo $msgCount; ?></p>
    </div>
    <div class="card">
        <h3>Magonjwa</h3>
        <p><?php echo $diseaseCount; ?></p>
    </div>
    <div class="card">
        <h3>Dalili</h3>
        <p><?php echo $symCount; ?></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>