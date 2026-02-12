<?php
session_start();
include "config.php";

//if ($_SESSION['role'] !== 'admin') {
//    echo "Access denied.";
 //   exit();
//}

if (isset($_GET['approve'])) {
    $cid = $_GET['approve'];
    $conn->query("UPDATE coach SET cselect='approved' WHERE cid=$cid");
}

if (isset($_GET['reject'])) {
    $cid = $_GET['reject'];
    $conn->query("UPDATE coach SET cselect='rejected' WHERE cid=$cid");
}

$result = $conn->query("SELECT * FROM coach WHERE cselect='pending'");
echo "<h2>Pending Club Member Approvals</h2>";
echo "<table border='1'><tr><th>Name</th><th>Email</th><th>Dance Style</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['cname']}</td>
            <td>{$row['email']}</td>
            <td>{$row['dance_style']}</td>
            <td>
                <a href='admin_approval.php?approve={$row['cid']}'>Approve</a> |
                <a href='admin_approval.php?reject={$row['cid']}'>Reject</a>
            </td>
          </tr>";
}
echo "</table>";
$conn->close();
?>