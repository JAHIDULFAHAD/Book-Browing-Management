<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrow Receipt</title>
    <link rel="stylesheet" href="style.css">
    <body>
</body>
</head>
<?php
    $bookname = $_POST["bookNamee"] ?? "";
    $authorName = $_POST["authorName"] ?? "";
    $isbn = $_POST["isbn"] ?? "";
    $quantity = $_POST["quantity"] ?? "";
    $category = $_POST["category"] ?? "";

    $conn = mysqli_connect('localhost', 'root','', "book_browing");
    $query = "INSERT INTO bookrecords(bookName, authorName, isbn, quantity, category) VALUES('$bookname', '$authorName', '$isbn', '$quantity', '$category')";

    $result = mysqli_query($conn,$query);

    if($result)
    {
        echo "<div class='confirmation' style='display: block;'>";
             echo "<h2>Data inserted successfully.</h2>";
             
    }
    else
    {
        echo "<div class='confirmation' style='display: block;'>";
             echo "<h2>The data was not inserted.</h2>";
    }

    header("refresh: 2; url = index.php");


?>