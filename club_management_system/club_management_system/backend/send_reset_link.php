<?php
$email = $_POST['email'];
echo "📧 If this email is registered, a reset link has been (simulated) sent to: " . htmlspecialchars($email);
echo "<br><a href='../frontend/index.html'>Back to Home</a>";
?>