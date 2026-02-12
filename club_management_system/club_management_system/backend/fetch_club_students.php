<?php
include "config.php";
session_start();

$club_name = $_SESSION['user'] ?? '';

if (!$club_name) {
    echo "❌ Club name missing from session.";
    exit();
}

$sql = "SELECT p.pname, p.usn, p.email 
        FROM performer p
        INNER JOIN enrollments e ON p.usn = e.usn
        WHERE e.club = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $club_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='6'><tr><th>Name</th><th>USN</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['pname']}</td><td>{$row['usn']}</td><td>{$row['email']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No students enrolled in your club.";
}

$conn->close();
?>