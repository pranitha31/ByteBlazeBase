<?php
include "config.php";

$cname = $_POST['cname'];
$usnc = $_POST['usnc'];
$email = $_POST['email'];
$dance_style = $_POST['dance_style'];
//$gender = $_POST['gender'];
//$password = password_hash($_POST['psw'], PASSWORD_DEFAULT);

// Default status is 'pending'
$sql = "INSERT INTO coach (cname, usnc, email, dance_style, gender, psw, cselect) VALUES (?, ?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $cname, $usnc, $email, $dance_style, $gender, $password);

if ($stmt->execute()) {
    echo "✅ Club member request submitted. Please wait for admin approval.";
} else {
    echo "❌ Error: " . $stmt->error;
}
$conn->close();
?>