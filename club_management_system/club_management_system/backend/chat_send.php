<?php
include "config.php";

$sender = $_POST['sender'] ?? 'Anonymous';
$message = $_POST['message'] ?? '';
$club = $_POST['club'] ?? 'General';

if ($message !== '') {
    $stmt = $conn->prepare("INSERT INTO chat_messages (club, sender, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $club, $sender, $message);
    $stmt->execute();
}
?>