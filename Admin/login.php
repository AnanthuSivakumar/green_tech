<?php
session_start();
include __DIR__ . '/../includes/db.php';

// Check DB connection
if (!$conn) {
    die("Database connection failed.");
}

// If already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

// Initialize login attempts
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Block after 5 attempts
if ($_SESSION['login_attempts'] >= 5) {
    die("Too many failed attempts. Try again later.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = "All fields are required!";
    } else {

        $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");

        if ($stmt) {

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {

                $stmt->bind_result($id, $hashedPassword);
                $stmt->fetch();

         if (!empty($hashedPassword) && password_verify($password, (string)$hashedPassword)) {

                    // Reset attempts
                    $_SESSION['login_attempts'] = 0;

                    // Secure session
                    session_regenerate_id(true);

                    $_SESSION['admin_id'] = $id;
                    $_SESSION['admin_username'] = $username;

                    header("Location: dashboard.php");
                    exit();

                } else {
                    $_SESSION['login_attempts']++;
                    $error = "Invalid Username or Password!";
                }

            } else {
                $_SESSION['login_attempts']++;
                $error = "Invalid Username or Password!";
            }

            $stmt->close();

        } else {
            $error = "Database error. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4 shadow mx-auto" style="max-width: 400px;">
        <h3 class="text-center mb-3">Admin Login</h3>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="off">
            <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

</body>
</html>