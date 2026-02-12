<?php
session_start();
$required_role = isset($required_role) ? $required_role : null;

if (!isset($_SESSION['user']) || !isset($_SESSION['role'])) {
    die("Access denied. <a href='../frontend/index.html'>Go to Home</a>");
}

if ($required_role && $_SESSION['role'] !== $required_role) {
    die("Unauthorized access. <a href='../frontend/index.html'>Go to Home</a>");
}
?>