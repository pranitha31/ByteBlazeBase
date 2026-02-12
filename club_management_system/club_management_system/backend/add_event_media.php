<?php
include "config.php";

$wname = $_POST['wname'];
$wdate = $_POST['wdate'];
$wtime = $_POST['wtime'];
$venue = $_POST['venue'];
$wshow = $_POST['wshow'];
$wdesc = $_POST['wdesc'];

$imagePath = "";
$videoPath = "";

// Ensure upload folders exist
if (!is_dir("../uploads/images")) mkdir("../uploads/images", 0777, true);
if (!is_dir("../uploads/videos")) mkdir("../uploads/videos", 0777, true);

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imageName = basename($_FILES['image']['name']);
    $imagePath = "uploads/images/" . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], "../" . $imagePath);
}

// Handle video upload
if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
    $videoName = basename($_FILES['video']['name']);
    $videoPath = "uploads/videos/" . $videoName;
    move_uploaded_file($_FILES['video']['tmp_name'], "../" . $videoPath);
}

// Safely add missing columns if they don't exist
$columns = ['image_path', 'video_path', 'wshow'];
foreach ($columns as $col) {
    $check = $conn->query("SHOW COLUMNS FROM workshop LIKE '$col'");
    if ($check && $check->num_rows == 0) {
        $conn->query("ALTER TABLE workshop ADD $col VARCHAR(255)");
    }
}

// Insert event with media
$sql = "INSERT INTO workshop (wname, wdate, wtime, venue, wdesc, image_path, video_path, wshow)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $wname, $wdate, $wtime, $venue, $wdesc, $imagePath, $videoPath, $wshow);

if ($stmt->execute()) {
    echo "✅ Event added successfully. <a href='../frontend/admin_dashboard.html'>Back to Dashboard</a>";
} else {
    echo "❌ Error: " . $stmt->error;
}

$conn->close();
?>