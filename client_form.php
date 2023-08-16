<?php

$pdo = include_once 'dbconfig.php'; // Include the PDO connection

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$submissionMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);
    $gender = $_POST['gender'];
    $occupation = trim($_POST['occupation']);

    // Validate inputs
    if (empty($name) || empty($mobile) || empty($address) || empty($gender) || empty($occupation)) {
        $submissionMessage = 'Please fill all required fields!';
    } else {
        try {
            $query = "INSERT INTO profile (name, mobile, address, gender, occupation) VALUES (:name, :mobile, :address, :gender, :occupation)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mobile', $mobile);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':occupation', $occupation);

            if ($stmt->execute()) {
                $submissionMessage = "Submission Successful!";
            } else {
                throw new Exception("Error in query execution: " . $stmt->errorInfo()[2]);
            }
        } catch (Exception $e) {
            $submissionMessage = "Error: " . $e->getMessage();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="registration-form">
        <h1>User Details</h1>
        <?php if (!empty($submissionMessage)) { ?>
            <p><?php echo $submissionMessage; ?></p>
        <?php }  ?>
        <form method="POST" action="client_form.php">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" id="mobile" name="mobile" required>
                </div>
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select...</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" id="occupation" name="occupation" required>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="input-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
            <div>
                <a href="welcome.php">Return to Welcome Page</a>
            </div>
    </div>
</body>
</html>
