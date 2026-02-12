<?php
include "config.php";
$result = $conn->query("SELECT COUNT(*) AS count FROM workshop WHERE approved = 0");
$row = $result->fetch_assoc();
echo $row['count'];
$conn->close();
?>