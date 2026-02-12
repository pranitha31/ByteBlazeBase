<?php
session_start();
include "../backend/config.php";

$user = $_SESSION['user'] ?? '';
$role = $_SESSION['role'] ?? '';

$sql = "SELECT * FROM notifications WHERE user = ? OR role = ? OR role = 'all' ORDER BY created_at DESC LIMIT 20";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $role);
$stmt->execute();
$result = $stmt->get_result();

// Mark notifications as seen
$conn->query("UPDATE notifications SET seen = 1 WHERE user = '$user' OR role = '$role'");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Notifications</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2>Your Notifications</h2>
    <form action="../backend/clear_notifications.php" method="POST">
      <button type="submit">Clear All</button>
    </form>
    <ul>
      <?php while ($row = $result->fetch_assoc()): ?>
        <li>
          <?= htmlspecialchars($row['message']) ?><br>
          <small><?= $row['created_at'] ?></small>
        </li><br>
      <?php endwhile; ?>
    </ul>
    <a class="button" href="index.html">Back to Home</a>
  </div>
</body>
</html>