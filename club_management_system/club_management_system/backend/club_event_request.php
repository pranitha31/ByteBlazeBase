<?php
session_start();
include "config.php";

$member = $_SESSION['user'] ?? 'unknown';
$wname = $_POST['wname'];
$wdate = $_POST['wdate'];
$wtime = $_POST['wtime'];
$venue = $_POST['venue'];
$wdesc = $_POST['wdesc'];
$resources = $_POST['resources'];

$image_path = '';
$video_path = '';

if ($_FILES['image']['error'] == 0) {
    $image_path = "uploads/images/" . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
}
if ($_FILES['video']['error'] == 0) {
    $video_path = "uploads/videos/" . basename($_FILES['video']['name']);
    move_uploaded_file($_FILES['video']['tmp_name'], $video_path);
}

$stmt = $conn->prepare("INSERT INTO workshop (wname, wdate, wtime, venue, wdesc, image_path, video_path, approved, resources)
VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?)");
$stmt->bind_param("ssssssss", $wname, $wdate, $wtime, $venue, $wdesc, $image_path, $video_path, $resources);
$stmt->execute();

// Add notification
$note = "$member submitted a new event for approval: $wname.";
$conn->query("INSERT INTO notifications (role, message) VALUES ('admin', '$note')");

// Email to admin
//mail('admin@example.com', 'New Event Request', $note);

echo "✅ Your event request has been submitted for approval.";
$conn->close();
?>