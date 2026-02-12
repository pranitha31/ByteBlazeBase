<?php
include "../backend/config.php";
$sql = "SELECT * FROM workshop WHERE resource_status = 'Approved'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Resource Approved Events</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2>Events with Approved Resources</h2>
    <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
      <li>
        <strong><?= htmlspecialchars($row['wname']) ?></strong><br>
        Date: <?= $row['wdate'] ?> | Venue: <?= $row['venue'] ?><br>
        Resources: <?= htmlspecialchars($row['resources']) ?>
      </li><br>
    <?php endwhile; ?>
    </ul>
    <a class="button" href="index.html">Back to Home</a>
  </div>
</body>
</html>