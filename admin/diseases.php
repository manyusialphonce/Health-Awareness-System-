<?php
include '../config/db.php';
include 'includes/header.php';

$success = '';
$error = '';

// Handle add disease
if(isset($_POST['add_disease'])){
    $name = $conn->real_escape_string($_POST['name']);
    $prevention = $conn->real_escape_string($_POST['prevention']);
    $advice = $conn->real_escape_string($_POST['advice']);
    if($name){
        $conn->query("INSERT INTO diseases (name, prevention, advice) VALUES ('$name','$prevention','$advice')");
        $success = "Ugonjwa umeongezwa!";
    } else {
        $error = "Jina la ugonjwa ni lazima!";
    }
}

// Fetch diseases
$diseaseResult = $conn->query("SELECT * FROM diseases ORDER BY name");
?>

<link rel="stylesheet" href="../css/style.css">
<h2>Magonjwa</h2>

<?php if($success): ?><div class="alert success"><?php echo $success;?></div><?php endif; ?>
<?php if($error): ?><div class="alert error"><?php echo $error;?></div><?php endif; ?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="Jina la ugonjwa" required>
    <textarea name="prevention" placeholder="Mbinu za kujikinga"></textarea>
    <textarea name="advice" placeholder="Ushauri"></textarea>
    <button type="submit" name="add_disease" class="btn">Ongeza Ugonjwa</button>
</form>

<h3>Orodhesha Magonjwa</h3>
<table>
    <thead><tr><th>Jina</th><th>Mbinu za Kujikinga</th><th>Ushauri</th></tr></thead>
    <tbody>
    <?php while($d = $diseaseResult->fetch_assoc()): ?>
        <tr>
            <td><?php echo $d['name'];?></td>
            <td><?php echo $d['prevention'];?></td>
            <td><?php echo $d['advice'];?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>