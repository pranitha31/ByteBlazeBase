<?php
include "config.php";

$sql = "SELECT * FROM workshop WHERE resource_status = 'Approved' ORDER BY wdate DESC, wtime DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='event-list'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='event-card'>";
        echo "<h3>" . htmlspecialchars($row['wshow']) . "</h3>";
        echo "<p><strong>Date:</strong> " . $row['wdate'] . " at " . $row['wtime'] . "</p>";
        echo "<p><strong>Venue:</strong> " . htmlspecialchars($row['venue']) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($row['wdesc'])) . "</p>";
        if (!empty($row['image_path']) && file_exists("../" . $row['image_path'])) {
            echo "<img src='../" . htmlspecialchars($row['image_path']) . "' alt='Event Image'>";
        }
        if (!empty($row['video_path']) && file_exists("../" . $row['video_path'])) {
            echo "<video controls src='../" . htmlspecialchars($row['video_path']) . "'></video>";
        }
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No approved events available.";
}
$conn->close();
?>