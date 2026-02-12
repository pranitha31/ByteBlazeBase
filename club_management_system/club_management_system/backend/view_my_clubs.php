<?php
include "config.php";
session_start();

$student = $_SESSION['user'] ?? '';

if (!$student) {
    echo "❌ Student not logged in.";
    exit();
}

$sql = "SELECT club FROM enrollments WHERE usn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    echo "<ul>";
    while ($row = $res->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['club']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "❗ You have not enrolled in any clubs yet.";
}
$conn->close();
?>