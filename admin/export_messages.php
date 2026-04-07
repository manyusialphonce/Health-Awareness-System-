<?php
// export_messages.php

include '../config/db.php'; // ✅ DB connection only

// 🔹 Optional filters (from GET)
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date   = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// 🔹 Build query dynamically
$query = "SELECT * FROM messages";
$conditions = [];

if(!empty($start_date)){
    $conditions[] = "DATE(created_at) >= '$start_date'";
}
if(!empty($end_date)){
    $conditions[] = "DATE(created_at) <= '$end_date'";
}

if(count($conditions) > 0){
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$query .= " ORDER BY created_at DESC";

// 🔹 Execute query
$result = $conn->query($query);

if(!$result){
    die("Query Error: " . $conn->error);
}

// 🔹 Dynamic filename
$filename = "messages_export_" . date("Y-m-d_H-i-s") . ".csv";

// 🔹 Headers (IMPORTANT)
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=$filename");

// 🔹 Open output
$output = fopen('php://output', 'w');

// 🔹 Column headings
fputcsv($output, ['ID', 'Name', 'Email', 'Message', 'Created At']);

// 🔹 Data rows
while($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['id'],
        $row['name'],
        $row['email'],
        $row['message'],
        $row['created_at']
    ]);
}

fclose($output);
exit();
?>