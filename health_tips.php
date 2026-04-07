<?php
include 'config/db.php';
session_start();

// Optional: filter by disease
$disease_id = isset($_GET['disease_id']) ? intval($_GET['disease_id']) : 0;

$query = "SELECT * FROM health_tips";
if($disease_id > 0){
    $query .= " WHERE disease_id = $disease_id";
}
$query .= " ORDER BY created_at DESC";

$result = $conn->query($query);
?>

<h2>Ushauri na Tips za Afya</h2>
<div class="tips-container">
<?php while($row=$result->fetch_assoc()): ?>
    <div class="tip-card">
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p><?= htmlspecialchars($row['content']) ?></p>
    </div>
<?php endwhile; ?>
</div>

<style>
.tips-container { display:flex; flex-wrap:wrap; gap:15px; }
.tip-card { background:#f9f9f9; padding:15px; border-radius:8px; box-shadow:0 0 5px rgba(0,0,0,0.1); width:calc(33% - 10px); }
@media(max-width:768px){ .tip-card { width:100%; } }
</style>