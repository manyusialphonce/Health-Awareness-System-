<?php
include '../config/db.php';
include 'includes/header.php';

$success = '';
$error = '';

// Add symptom
if(isset($_POST['add_symptom'])){
    $name = $conn->real_escape_string($_POST['name']);
    if($name){
        $conn->query("INSERT INTO symptoms (name) VALUES ('$name')");
        $success = "Dalili imeongezwa!";
    } else {
        $error = "Jina la dalili ni lazima!";
    }
}

// Fetch symptoms
$symResult = $conn->query("SELECT * FROM symptoms ORDER BY name");
?>

<link rel="stylesheet" href="css/style.css">
<h2>Dalili</h2>

<?php if($success): ?><div class="alert success"><?php echo $success;?></div><?php endif; ?>
<?php if($error): ?><div class="alert error"><?php echo $error;?></div><?php endif; ?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="Jina la dalili" required>
    <button type="submit" name="add_symptom" class="btn">Ongeza Dalili</button>
</form>

<h3>Orodhesha Dalili</h3>
<table>
    <thead><tr><th>Dalili</th></tr></thead>
    <tbody>
    <?php while($s = $symResult->fetch_assoc()): ?>
        <tr><td><?php echo $s['name'];?></td></tr>
    <?php endwhile; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>