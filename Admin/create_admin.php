<?php
include __DIR__ . '/../includes/db.php';

$username = "admin";
$password = password_hash("123456", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

echo "Admin Created Successfully!";