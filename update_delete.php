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

// Retrieve Data from Form
$bookname = $_POST["bookName"] ?? "";
$authorName = $_POST["authorName"] ?? "";
$isbn = $_POST["isbn"] ?? "";
$quantity = $_POST["quantity"] ?? "";
$category = $_POST["category"] ?? "";
$action = $_POST["action"] ?? ""; // 'insert', 'update', or 'delete'

// Perform Action Based on Form Submission
if ($action === 'update') {
    $bookId = $_POST["bookId"] ?? ""; // ID of the book to update
    $query = "UPDATE bookrecords 
              SET bookName='$bookname', authorName='$authorName', isbn='$isbn', quantity='$quantity', category='$category' 
              WHERE id='$bookId'";
} elseif ($action === 'delete') {
    $bookId = $_POST["bookId"] ?? ""; // ID of the book to delete
    $query = "DELETE FROM bookrecords WHERE id='$bookId'";
}

// Execute Query
if (!empty($query)) {
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<div class='confirmation' style='display: block;'>";
             echo "<h2>Action ($action) executed successfully.</h2>";
    } else {
        echo "<div class='confirmation' style='display: block;'>";
             echo "<h2>Error executing action ($action): " . mysqli_error($conn) . "</h2>";
    }
} else {
    echo "<div class='confirmation' style='display: block;'>";
         echo "<h2>No action performed. Please provide valid input.</h2>";
}

// Redirect to Home Page
header("refresh: 2; url = index.php");

// Close Connection
mysqli_close($conn);
?>
