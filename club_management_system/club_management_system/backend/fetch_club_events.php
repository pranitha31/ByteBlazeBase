<?php
include "config.php";
session_start();

$club = $_SESSION['user'] ?? '';

if (!$club) {
    echo "❌ Not logged in as a club member.";
    exit();
}

$sql = "SELECT * FROM workshop WHERE wshow = ? ORDER BY wdate DESC, wtime DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $club);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='6'><tr><th>Event</th><th>Date</th><th>Time</th><th>Venue</th><th>Description</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['wname']) . "</td>
                <td>" . $row['wdate'] . "</td>
                <td>" . $row['wtime'] . "</td>
                <td>" . htmlspecialchars($row['venue']) . "</td>
                <td>" . htmlspecialchars($row['wdesc']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No events found for your club.";
}

$conn->close();
?>