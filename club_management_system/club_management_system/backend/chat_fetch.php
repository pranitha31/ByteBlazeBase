<?php
include "config.php";

$club = $_GET['club'] ?? 'General';

$stmt = $conn->prepare("SELECT sender, message, created_at FROM chat_messages WHERE club = ? ORDER BY created_at ASC");
$stmt->bind_param("s", $club);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div><strong>" . htmlspecialchars($row['sender']) . ":</strong> " . htmlspecialchars($row['message']) . " <small>(" . $row['created_at'] . ")</small></div>";
}
?>