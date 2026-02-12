<?php
session_start();
include "../backend/config.php";
$member = $_SESSION['user'] ?? '';
$sql = "SELECT * FROM workshop WHERE wdesc LIKE CONCAT('%', ?, '%')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $member);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>My Event Status</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2>My Event Submission Status</h2>
    <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
      <li>
        <strong><?= htmlspecialchars($row['wname']) ?></strong><br>
        Approval: <?= $row['approved'] ? 'Approved' : 'Pending' ?><br>
        Resource Status: <?= $row['resource_status'] ?>
      </li><br>
    <?php endwhile; ?>
    </ul>
    <a class="button" href="club_member_dashboard.php">Back to Dashboard</a>
  </div>
</body>
</html>