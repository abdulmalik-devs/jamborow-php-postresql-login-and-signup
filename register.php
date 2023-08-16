<?php
ob_start(); // Start output buffering at the top of your script
session_start();

$pdo = include_once 'dbconfig.php';

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repeatPassword = trim($_POST['repeat-password']);

    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($repeatPassword)) {
        die('Please fill all required fields!');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Please provide a valid email address!');
    }

    if ($password !== $repeatPassword) {
        die('Passwords do not match!');
    }

    $hashedPassword = hash("sha256", $password); // hashing password

    $query = "INSERT INTO register (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([':username' => $username, ':email' => $email, ':password' => $hashedPassword]);

    if (!$result) {
        die("Error in query: " . $stmt->errorInfo()[2]);
    }

    header("Location: login.php");
    exit();
}
ob_end_flush(); // End output buffering and send output to browser at the end of your script
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="registration-form">

        <div class="login-group">
            <h1 class="login-head">Register</h1>
            <span class="login-sub"><h3>Thanks for choosing us!</h3></span>
        </div>

        <form method="POST" action="register.php">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="repeat-password">Repeat Password</label>
                <input type="password" id="repeat-password" name="repeat-password" required>
            </div>
            <div class="input-group">
                <button type="submit">Register</button>
                <span class="registerlink">Have an account already? <a
                    href="login.php"><div class="login">Login</div></a></span>
            </div>
        </form>
    </div>
</body>
</html>