<?php
include "config.php";

$result = $conn->query("SELECT * FROM workshop ORDER BY wdate DESC, wtime DESC");
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
?>