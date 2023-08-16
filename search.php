<?php
$pdo = include_once 'dbconfig.php'; // Include the PDO connection

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$submissionMessage = "";
$userDetails = ""; // Variable to collect user details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);

    // Validate input
    if (empty($name)) {
        $submissionMessage = 'Please enter a name to search!';
    } else {
        try {
            $query = "SELECT * FROM profile WHERE name = :name";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $userDetails .= "<p class='detail-line'>Name: " . $row['name'] . "</p>";
                $userDetails .= "<p class='detail-line'>Mobile: " . $row['mobile'] . "</p>";
                $userDetails .= "<p class='detail-line'>Address: " . $row['address'] . "</p>";
                $userDetails .= "<p class='detail-line'>Gender: " . $row['gender'] . "</p>";
                $userDetails .= "<p class='detail-line'>Occupation: " . $row['occupation'] . "</p>";
                
            }
        } catch (PDOException $e) {
            $submissionMessage = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
    .user-details { 
        margin: 20px 0;   /* Increase top and bottom margin to 20px */
        padding: 15px;    /* Add some padding */
        border: 1px solid #ddd; /* Add a border */
        border-radius: 10px; /* Add rounded corners */
    }
    .user-details .detail-line {
        margin-bottom: 10px; /* Add 10px space below each line */
    }
    </style>

</head>
<body>
    <div>
        <?php if (!empty($submissionMessage)) { ?>
            <p><?php echo $submissionMessage; ?></p>
        <?php } ?>
        <form method="POST" action="./search.php">
            <label>
                Search by Name:
            </label>
            <input type="text" name="name" required>
            <button class="submit-btn" type="submit" value="Search">Submit</button>
            <div>
                <a href="./welcome.php">Return to Welcome Page</a>
            </div>
        </form>
        <!-- Output user details -->
        <?php echo $userDetails; ?>
    </div>
</body>
</html>
