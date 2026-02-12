<?php
session_start();
include "config.php";

$role = $_SESSION['role'] ?? '';
$user = $_SESSION['user'] ?? '';

$sql = "SELECT * FROM notifications WHERE role='$role' OR user='$user' ORDER BY created_at DESC LIMIT 10";
$result = $conn->query($sql);

$notifications = [];
while ($row = $result->fetch_assoc()) {
    echo "<li>{$row['message']} ({$row['created_at']})</li>";
}
$conn->close();
?>