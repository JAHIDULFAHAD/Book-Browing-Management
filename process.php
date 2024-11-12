<?php
session_start();
$errors = [];
$fullname = $id = $email = $booktitle = $borrowdate = $returndate = $token = $fees = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Student Fullname
    if (empty($_POST["fullname"])) {
        $errors['fullname'] = "Fullname is required.";
    } 
    else {
        $fullname = htmlspecialchars(trim($_POST["fullname"]));
        if (strlen($fullname) < 3) {
            $errors['fullname'] = "Fullname must be at least 3 characters long.";
        }
    }

    // Validate Student AIUB ID
    if (empty($_POST["id"])) {
        $errors['id'] = "AIUB ID is required.";
    } 
    else {
        $id = htmlspecialchars(trim($_POST["id"]));
        if (!preg_match("/^\d{2}-\d{5}-\d$/", $id)) {
            $errors['id'] = "Invalid ID format. Correct format: xx-yyyyy-z";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $errors['email'] = "Email is required.";
    } 
    else {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if (!preg_match("/^\d{2}-\d{5}-\d{1}@student\.aiub\.edu$/", $email)) {
            $errors['email'] = "Invalid email format. Correct format: xx-yyyyy-z@student.aiub.edu";
        }
    }

    // Validate Book Title (dropdown)
    if (empty($_POST["booktitle"])) {
        $errors['booktitle'] = "Please select a book.";
    } 
    else {
        $booktitle = htmlspecialchars($_POST["booktitle"]);
    }

    // Validate Borrow Date and Return Date
    $borrowdate = $_POST["borrowdate"];
    $returndate = $_POST["returndate"];

    if (empty($borrowdate)) {
        $errors['borrowdate'] = "Borrowing date is required.";
    }
    if (empty($returndate)) {
        $errors['returndate'] = "Return date is required.";
    } 
    elseif ($borrowdate > $returndate) {
        $errors['returndate'] = "Return date should be after the borrowing date.";
    }

    // Validate Token
    if (empty($_POST["token"])) {
        $errors['token'] = "Token is required.";
    } 
    else {
        $token = intval($_POST["token"]);
        if ($token <= 0) {
            $errors['token'] = "Token must be a positive number.";
        }
    }

    // Validate Fees
    if (empty($_POST["fees"])) {
        $errors['fees'] = "Fees are required.";
    } 
    else {
        $fees = floatval($_POST["fees"]);
        if ($fees < 0) {
            $errors['fees'] = "Fees cannot be negative.";
        }
    }

    // Check if there are any errors
    if (empty($errors)) {
        // Store data in session for confirmation page
        $_SESSION['success_data'] = [
            'fullname' => $fullname,
            'id' => $id,
            'email' => $email,
            'booktitle' => $booktitle,
            'borrowdate' => $borrowdate,
            'returndate' => $returndate,
            'token' => $token,
            'fees' => $fees,
        ];

        // Redirect to confirmation page
        header("Location: confirmation.php");
        exit();
    } 
    else {
        // Store errors and old data in session and redirect back to form
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
        header("Location: index.php");
        exit();
    }
}
?>
