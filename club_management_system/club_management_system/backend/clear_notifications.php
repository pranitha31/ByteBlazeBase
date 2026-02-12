<?php
session_start();
include "config.php";
$user = $_SESSION['user'] ?? '';
$role = $_SESSION['role'] ?? '';
$conn->query("DELETE FROM notifications WHERE user='$user' OR role='$role'");
echo "✅ Notifications cleared. <a href='../frontend/notifications.php'>Back</a>";
$conn->close();
?>