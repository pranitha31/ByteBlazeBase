<?php
include "config.php";
$result = $conn->query("SELECT wname, venue, resources FROM workshop WHERE approved = 0 AND resources IS NOT NULL");

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Requested Resources</title><link rel='stylesheet' href='../frontend/style.css'></head><body><div class='container'>";
echo "<h2>Requested Resources</h2>";

if ($result->num_rows > 0) {
  echo "<ul>";
  while ($row = $result->fetch_assoc()) {
    echo "<li><strong>{$row['wname']}</strong> at {$row['venue']}<br>Resources: {$row['resources']}</li><br>";
  }
  echo "</ul>";
} else {
  echo "No resource requests found.";
}

echo "<a class='button' href='../frontend/admin_dashboard.html'>Back to Dashboard</a></div></body></html>";
$conn->close();
?>