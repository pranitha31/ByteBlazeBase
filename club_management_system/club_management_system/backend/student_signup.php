<?php
include "config.php";

$pname = $_POST['pname'];
$usn = $_POST['usn'];
$email = $_POST['email'];
//$gender = $_POST['gender'];
//$password = password_hash($_POST['psw'], PASSWORD_DEFAULT);

// Check if user already exists
$sql = "SELECT * FROM performer WHERE usn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usn);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "❌ Student already registered.";
} else {
    $sql = "INSERT INTO performer (pname, usn, email, gender, psw) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $pname, $usn, $email, $gender, $password);
    if ($stmt->execute()) {
        echo "✅ Student registered successfully. <a href='../frontend/student_login.html'>Login</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
$conn->close();
?>