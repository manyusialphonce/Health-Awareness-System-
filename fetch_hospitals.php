<?php
include 'config/db.php';

$lat = floatval($_GET['lat']);
$lng = floatval($_GET['lng']);

$query = "SELECT id,name,address,contact,latitude,longitude,
( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance
FROM hospitals
ORDER BY distance ASC
LIMIT 10";

$result = $conn->query($query);
$hospitals = [];
while($row=$result->fetch_assoc()) $hospitals[]=$row;

header('Content-Type: application/json');
echo json_encode($hospitals);
exit();
?>