<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrow Receipt</title>
    <link rel="stylesheet" href="style.css">
    <body>
</body>
</head>
<?php
// Establish Database Connection
$conn = mysqli_connect('localhost', 'root', '', 'book_browing');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the Search Input from User (via GET or POST)
$bookIdentifier = $_GET['search'] ?? ''; // Example: book name, ISBN, or ID

// Prepare the Query
$query = "SELECT bookName, quantity FROM bookrecords WHERE bookName = '$bookIdentifier' OR isbn = '$bookIdentifier' LIMIT 1";

// Execute the Query
$result = mysqli_query($conn, $query);

// Display Results
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<div class='confirmation' style='display: block;'>";
          echo "<h2>Book Name: " . htmlspecialchars($row['bookName']) . "</h2>";
          echo "<h2>Quantity Available: " . htmlspecialchars($row['quantity']) . "</h2>";
          echo "<button onclick='history.back()'>Go Back</button>";
} else {
    echo "<div class='confirmation' style='display: block;'>";
         echo "<h2>No book found with the given identifier.</h2>";
         echo "<button onclick='history.back()'>Go Back</button>";
}

// Close the Database Connection
mysqli_close($conn);
?>
