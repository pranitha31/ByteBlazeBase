<?php
include "config.php";

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'] === 'approve' ? 'Approved' : 'Rejected';

    $conn->query("UPDATE workshop SET resource_status='$status' WHERE wid=$id");

    // Optional: send email notification (dummy)
    //$msg = "Resource status for event ID $id has been marked as $status.";
    //mail("admin@example.com", "Resource Allocation Update", $msg);

    echo "✅ Resource status updated to $status. <a href='pending_events.php'>Back</a>";
} else {
    echo "Invalid request.";
}
$conn->close();
?>