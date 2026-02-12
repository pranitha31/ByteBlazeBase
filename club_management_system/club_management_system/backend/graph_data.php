<?php
include "config.php";

$months = [];
$counts = [];
for ($i = 1; $i <= 12; $i++) {
    $month = str_pad($i, 2, '0', STR_PAD_LEFT);
    $sql = "SELECT COUNT(*) AS total FROM workshop WHERE MONTH(wdate) = $i";
    $result = $conn->query($sql)->fetch_assoc();
    $months[] = date("M", mktime(0, 0, 0, $i, 10));
    $counts[] = $result['total'];
}

$role_counts = [
  "admins" => $conn->query("SELECT COUNT(*) FROM admin")->fetch_row()[0],
  "club_members" => $conn->query("SELECT COUNT(*) FROM coach")->fetch_row()[0],
  "students" => $conn->query("SELECT COUNT(*) FROM performer")->fetch_row()[0]
];

$approval = $conn->query("SELECT SUM(approved=1) AS approved, SUM(approved=0) AS pending FROM workshop")->fetch_assoc();

echo json_encode([
  "eventMonths" => $months,
  "eventCounts" => $counts,
  "admins" => $role_counts["admins"],
  "club_members" => $role_counts["club_members"],
  "students" => $role_counts["students"],
  "approved" => (int)$approval['approved'],
  "pending" => (int)$approval['pending']
]);
$conn->close();
?>