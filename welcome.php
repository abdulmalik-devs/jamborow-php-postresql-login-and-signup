<?php
// Include the dbconfig.php file to establish the PDO connection
$pdo = include_once 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["create_profile"])) {
    header("Location: client_form.php");
    exit;
  } elseif (isset($_POST["search"])) {
    header("Location: search.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <section class="welcome-wrapper">
    <div class="welcome-page">
        <h1>Welcome to our website!</h1>
    </div>
    <section class="create">
      <button><a href="./client_form.php" type="submit" name="create_profile">Create Your Profile</a></button>
      <button><a href="./search.php" type="submit" name="search">Search</a></button>
      <button><a href="./logout.php" type="submit" name="logout">Logout</a></button>
    </section>
  </section>
</body>
</html>
