<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrow Receipt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Establish Database Connection
    $conn = mysqli_connect('localhost', 'root', '', 'book_browing');

    if (!$conn) {
        die("<h2>Connection failed: " . mysqli_connect_error() . "</h2>");
    }

    
    $action = $_POST["action"] ?? ""; // 'insert', 'update', or 'delete'
    $bookId = $_POST["bookId"] ?? ""; // ID of the book for update/delete actions

    $query = ""; // Initialize query variable

    // Perform Action Based on Form Submission
    if ($action === 'update') {
        if (!empty($bookId)) {
            header("Location: update.php?bookId=$bookId");
            exit();
        } else {
            echo "<div class='confirmation' style='display: block;'>
                     <h2>Book ID is required to update.</h2>
                  </div>";
        }
    } elseif ($action === 'delete') {
        if (!empty($bookId)) {
            $query = "DELETE FROM bookrecords WHERE id='$bookId'";
        } else {
            echo "<div class='confirmation' style='display: block;'>
                     <h2>Book ID is required to delete.</h2>
                  </div>";
        }
    }

    // Execute Query if Valid
    if (!empty($query)) {
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<div class='confirmation' style='display: block;'>
                     <h2>Action ($action) executed successfully.</h2>
                  </div>";
        } else {
            echo "<div class='confirmation' style='display: block;'>
                     <h2>Error executing action ($action): " . mysqli_error($conn) . "</h2>
                  </div>";
        }
    }

    // Redirect to Home Page after 2 seconds
    header("refresh: 2; url = index.php");

    // Close Connection
    mysqli_close($conn);
    ?>
</body>
</html>
