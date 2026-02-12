<?php
include "config.php";
session_start();

$student = $_SESSION['user'] ?? '';  // student name from session
$club = $_POST['club'] ?? '';

if (!$student || !$club) {
    echo "❌ Missing student or club name.";
    exit();
}

// Prevent duplicate enrollment
$check = $conn->prepare("SELECT * FROM enrollments WHERE usn = ? AND club = ?");
$check->bind_param("ss", $student, $club);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    echo "❗ You are already enrolled in this club.";
    exit();
}

// Insert into enrollments table (student name as "usn")
$stmt = $conn->prepare("INSERT INTO enrollments (usn, club) VALUES (?, ?)");
$stmt->bind_param("ss", $student, $club);

if ($stmt->execute()) {
    echo "✅ Enrollment successful!";
} else {
    echo "❌ Enrollment failed: " . $stmt->error;
}
$conn->close();
?>