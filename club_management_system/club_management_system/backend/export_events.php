<?php
include "config.php";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="event_report.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Event Name', 'Date', 'Time', 'Venue', 'Approved']);

$result = $conn->query("SELECT wname, wdate, wtime, venue, approved FROM workshop");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
$conn->close();
?>