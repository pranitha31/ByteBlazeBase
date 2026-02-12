<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE workshop SET approved = 1 WHERE wid = $id";
    $conn->query($sql);
    echo "✅ Event approved. <a href='../frontend/admin_dashboard.html'>Back to Dashboard</a>";
} else {
    echo "Invalid event ID.";
}
$conn->close();
?>