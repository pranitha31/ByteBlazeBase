<?php
session_start();
include "../backend/config.php";
$user = $_SESSION['user'];
$sql = "SELECT cselect FROM coach WHERE cname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($club_name);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Club Member Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2>Club_Member.Php</h2>

<p><strong>Unseen Notifications:</strong> <span id="badge">Loading...</span></p>
<script>
  fetch("../backend/unseen_count.php")
    .then(res => res.text())
    .then(txt => document.getElementById("badge").innerText = txt);
</script>
Welcome, <?php echo htmlspecialchars($user); ?> — Member of <?php echo htmlspecialchars($club_name); ?></h2>
    <button class="button" onclick="location.href='club_manage_events.html">Manage Events</button>
    <button class="button" onclick="location.href='club_event_request.html">Request New Event</button>
    <button class="button" onclick="location.href='notifications.html">View Notifications</button>
    <button class="button" onclick="location.href='club_view_students.html">View Club Members</button>
    <button class="button" onclick="location.href='club_chats/<?php echo strtolower(str_replace(' ', '_', $club_name)); ?>_chat.html">Enter Club Chat</button>
    <button class="button" onclick="location.href='my_event_status.php">My Event Status</button>
<button class="button" onclick="location.href='../backend/logout.php">Logout</button>
  </div>
</body>
</html>