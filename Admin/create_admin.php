

<?php
include __DIR__ . '/../includes/db.php';

$username = "green_tech";
$password = password_hash("grean@26", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();



