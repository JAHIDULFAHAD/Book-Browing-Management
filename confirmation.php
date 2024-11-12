<?php
session_start();
if (!isset($_SESSION['success_data'])) {
    header("Location: index.php");
    exit();
}

// Retrieve data from session
$data = $_SESSION['success_data'];
unset($_SESSION['success_data']); // Clear data from session after displaying
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="confirmation-frame">
        <h2>Form Submitted Successfully!</h2>
        <p><strong>Student Fullname:</strong> <?php echo htmlspecialchars($data['fullname']); ?></p>
        <p><strong>Student AIUB ID:</strong> <?php echo htmlspecialchars($data['id']); ?></p>
        <p><strong>Student Email:</strong> <?php echo htmlspecialchars($data['email']); ?></p>
        <p><strong>Book Title:</strong> <?php echo htmlspecialchars($data['booktitle']); ?></p>
        <p><strong>Borrowing Date:</strong> <?php echo htmlspecialchars($data['borrowdate']); ?></p>
        <p><strong>Return Date:</strong> <?php echo htmlspecialchars($data['returndate']); ?></p>
        <p><strong>Token:</strong> <?php echo htmlspecialchars($data['token']); ?></p>
        <p><strong>Fees:</strong> <?php echo htmlspecialchars($data['fees']); ?></p>
    </div>
</body>
</html>