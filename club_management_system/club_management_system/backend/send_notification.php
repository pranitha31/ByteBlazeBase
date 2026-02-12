<?php
include "config.php";

$message = $_POST['message'];
$role = $_POST['role'];
$user = $_POST['user'];

$stmt = $conn->prepare("INSERT INTO notifications (message, role, user) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $message, $role, $user);

if ($stmt->execute()) {
    echo "✅ Notification sent. <a href='../frontend/admin_dashboard.html'>Back to Dashboard</a>";
} else {
    echo "❌ Error sending notification: " . $stmt->error;
}
$conn->close();
?>
