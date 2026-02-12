<?php
include "config.php";
$result = $conn->query("SELECT * FROM workshop WHERE approved = 0");

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Pending Events</title><link rel='stylesheet' href='../frontend/style.css'></head><body><div class='container'>";
echo "<h2>Pending Events for Approval</h2>";

if ($result->num_rows > 0) {
  echo "<ul>";
  while ($row = $result->fetch_assoc()) {
    echo "<li>
      <strong>{$row['wname']}</strong> - {$row['wdate']} at {$row['wtime']}<br>
      Venue: {$row['venue']}<br>
      Description: {$row['wdesc']}<br>
      Resources Requested: <em>{$row['resources']}</em> <strong>Status: {$row['resource_status']}</strong><br>
      <a class='button' href='approve_event.php?id={$row['wid']}'>Approve Event</a> |
      <a class='button' href='update_resource_status.php?id={$row['wid']}&status=approve'>Approve Resources</a> |
      <a class='button' href='update_resource_status.php?id={$row['wid']}&status=reject'>Reject Resources</a>
    </li><br>";
  }
  echo "</ul>";
} else {
  echo "No pending events.";
}

echo "<a class='button' href='../frontend/admin_dashboard.html'>Back to Dashboard</a></div></body></html>";
$conn->close();
?>