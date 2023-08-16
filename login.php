<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$pdo = include_once 'dbconfig.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($password)) {
        die('Please fill all required fields!');
    }

    $hashedPassword = hash("sha256", $password); // hashing password

    $query = "SELECT * FROM register WHERE username = :username AND password = :password";

    // Prepare the SQL query
    $stmt = $pdo->prepare($query);

    // Bind the parameter values
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);

    // Execute the prepared statement
    $stmt->execute();

    // Check if the query returned any rows
    if ($stmt->rowCount() > 0) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit();
    } else {
        die('Invalid username or password!');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="registration-form">
        <div class="overlay">
            <!-- This will have no content -->
        </div>

        <div class="login-group">
            <h1 class="login-head">Login</h1>
            <span class="login-sub"><h3>We are happy to have you back!</h3></span>
        </div>

        <form method="POST" action="./login.php">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="input-group">
                <button type="submit">Login</button>

                <span class="registerlink">Don't have an account? <a href="register.php"><div class="reg">Register</div></a></span>
            </div>
        </form>
    </div>
</body>
</html>
