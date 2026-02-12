<?php
session_start();
include "config.php";

$role = $_POST['role'] ?? '';
$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

if ($role === 'admin') {
    $sql = "SELECT * FROM admin WHERE name='$user'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['password'] === $pass) {
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'admin';
            header("Location: ../frontend/admin_dashboard.html");
            exit();
        } else {
            echo "❌ Incorrect admin password.";
            exit();
        }
    } else {
        echo "❌ Admin not found.";
        exit();
    }
}

if ($role === 'club_member') {
    $sql = "SELECT * FROM coach WHERE cname='$user'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['psw'] === $pass && $row['cselect'] === 'approved') {
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'club_member';
            header("Location: ../frontend/club_member_dashboard.html");
            exit();
        } else {
            echo "❌ Wrong password or not approved.";
            exit();
        }
    } else {
        echo "❌ Club member not found.";
        exit();
    }
}

if ($role === 'student') {
    $sql = "SELECT * FROM performer WHERE pname='$user'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['psw'] === $pass) {
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'student';
            header("Location: ../frontend/student_dashboard.html");
            exit();
        } else {
            echo "❌ Incorrect password.";
            exit();
        }
    } else {
        echo "❌ Student not found.";
        exit();
    }
}

echo "❌ Invalid login or missing credentials.";
$conn->close();
?>
