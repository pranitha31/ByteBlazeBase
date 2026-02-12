<?php
include "config.php";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="club_members.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Name', 'USN', 'Email', 'Style', 'Gender', 'Status']);

$result = $conn->query("SELECT cname, usnc, email, dance_style, gender, cselect FROM coach");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
$conn->close();
?>