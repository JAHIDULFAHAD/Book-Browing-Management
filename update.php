<?php
// Establish Database Connection
$conn = mysqli_connect('localhost', 'root', '', 'book_browing');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get bookId from URL
$bookId = $_GET["bookId"] ?? "";

if (!empty($bookId)) {
    // Fetch existing book details
    $query = "SELECT * FROM bookrecords WHERE id='$bookId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='confirmation' style='display: block;'>
        <h2>Book ID $bookId not found.</h2>
        </div>";
        exit();
    }
} else {
    echo "<div class='confirmation' style='display: block;'>
    <h2>Book ID is required to update.</h2>
    </div>";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookname = $_POST["bookName"] ?: $book["bookName"];
    $authorName = $_POST["authorName"] ?: $book["authorName"];
    $isbn = $_POST["isbn"] ?: $book["isbn"];
    $quantity = $_POST["quantity"] ?: $book["quantity"];
    $category = $_POST["category"] ?: $book["category"];

    // Update query
    $updateQuery = "UPDATE bookrecords 
                    SET bookName='$bookname', authorName='$authorName', isbn='$isbn', 
                        quantity='$quantity', category='$category' 
                    WHERE id='$bookId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "<div class='confirmation' style='display: block;'>
                     <h2>Book ID $bookId updated successfully.</h2>
                  </div>";
                  header("refresh: 2; url = index.php");
    } else {
        echo "<h1>Error updating book: " . mysqli_error($conn) . "</h1>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>      
    <title>Update Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box4">
    <form action="" method="POST">
        <h1>Update Book ID: <?php echo htmlspecialchars($bookId); ?></h1>
        <label for="bookName">Book Name:</label>
        <input type="text" id="bookName" name="bookName" value="<?php echo htmlspecialchars($book['bookName']); ?>"><br><br>

        <label for="authorName">Author Name:</label>
        <input type="text" id="authorName" name="authorName" value="<?php echo htmlspecialchars($book['authorName']); ?>"><br><br>

        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>"><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($book['quantity']); ?>"><br><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($book['category']); ?>"><br><br>

        <button type="submit">Update Book</button>
    </form>
</div>
</body>
</html>
