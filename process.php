<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrow Receipt</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>  

     <?php
         $errors = [];
         $check = false;
         $used = false;
         $fullname = $id = $email = $booktitle = $borrowdate = $returndate = $token = $fees = "";
         $token = $_POST["token"]??"";
         $currentDate = time(); 

        // Check if form is submitted
         if ($_SERVER["REQUEST_METHOD"] == "POST") {

             // Validate Student Fullname
             $fullname = trim($_POST["fullname"]);
             if (!preg_match("/^([A-Z][a-z]+)\s([A-Z][a-z]+)(\s[A-Z][a-z]+)?$/", $fullname)) {
                 $errors['fullname'] = "Invalid Naming Format. Correct format:Jahidul Fahad";
             }

             // Validate Student AIUB ID
             $id = htmlspecialchars(trim($_POST["id"]));
             if (!preg_match("/^\d{2}-\d{5}-\d$/", $id)) {
                 $errors['id'] = "Invalid ID format. Correct format: 22-22222-2";
             }

            // Validate Email
             $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
             if (!preg_match("/^\d{2}-\d{5}-\d{1}@student\.aiub\.edu$/", $email)) {
                 $errors['email'] = "Invalid email format. Correct format: 22-22222-2@student.aiub.edu";
            }
        
            // Validate Book Title (dropdown)
             $booktitle = htmlspecialchars($_POST["booktitle"]);
             if(!isset($_COOKIE[$booktitle]))
            {
                setcookie($booktitle, $fullname, time() + 20);
            }
            else if(isset($_COOKIE[$booktitle]) && $_COOKIE[$booktitle] == $fullname)
            {

                $errors[] = "<h3 style='color: red;'>This book is already borrowed by :- $fullname</h3> ";
            }

        
            // Validate Borrow Date and Return Date
             $borrowdate = $_POST["borrowdate"];
             $returndate = $_POST["returndate"];
            // borrowing and return dates validation
            $borrowDateObj = new DateTime($borrowdate);
            $returnDateObj = new DateTime($returndate);
            $dateDiff = $borrowDateObj->diff($returnDateObj);
            if ($borrowDateObj >= $returnDateObj) {
                $errors[] = "Return date must be after the borrow date.";
            }
            else if($dateDiff->days >10)
            {
                if(file_exists("token.json"))
                {
                    $jsonToken = json_decode(file_get_contents("token.json"), true);
                    $numberOfTokens = sizeof($jsonToken[0]["token"]);

                    for($i = 0; $i<$numberOfTokens ; $i++)
                    {
                        if($jsonToken[0]["token"][$i] == $token)
                        {
                            $check = true;
                        }
                    }

                    if(file_exists("data.json"))
                    {
                        $usedtoken = json_decode(file_get_contents("data.json"),true) ?: [];
                        $used = in_array($token,$usedtoken);
                    }


                    if(!$check)
                    {
                        $errors[] = "Return date must be within 10 days.";
                    }
                    else if($used)
                    {
                        $errors[] = "You can use a token in once.";
                    }
                    else if(empty($errors))
                    {
                        if(file_exists("data.json"))
                        {
                            $usedtoken = json_decode(file_get_contents("data.json"),true) ?: [];
                            $usedtoken[] = $token;
                            $json = json_encode($usedtoken);
                            
                            file_put_contents("data.json", $json);

                        }

                        if(!file_exists("data.json"))
                        {
                            // $data = [
                            //   "token" => [$token]
                            // ];

                            $json = json_encode($token);
                            
                            file_put_contents("data.json", $json);
                        }
                    }
                }
                
            }
        
           
            //  fees
             $fees = floatval($_POST["fees"]);
             if ($fees < 0) {
                 $errors['fees'] = "Fees cannot be negative.";
             }


             // Calculate the difference between the dates
             
    }


        // Display the receipt if no errors and cookie is set
         if (empty($errors)) {
             echo "<div class='confirmation' style='display: block;'>";
             echo "<h2>Book Borrow Receipt</h3>";
             echo "<p style='color:green;'>Form Submitted Successfully!</p>";
             echo '<div class="name"><strong>Student Name:</strong> <span>' . htmlspecialchars($fullname) . '</span> </div>';
             echo '<div class="name"><strong>Student AIUB ID:</strong> <span>' . htmlspecialchars($id) . '</span> </div>';
             echo '<div class="name"><strong>Student Email:</strong> <span>' . htmlspecialchars($email) . '</span> </div>';
             echo '<div class="name"><strong>Book Title:</strong> <span>' . htmlspecialchars($booktitle) . '</span> </div>';
             echo '<div class="name"><strong>Borrowing Date:</strong> <span>' . htmlspecialchars($borrowdate) . '</span> </div>';
             echo '<div class="name"><strong>Return Date:</strong> <span>' . htmlspecialchars($returndate) . '</span> </div>';
             echo '<div class="name"><strong>Token:</strong> <span>' . htmlspecialchars($token) . '</span> </div>';
             echo '<div class="name"><strong>Fees:</strong> <span> Tk' . htmlspecialchars($fees) . '</span> </div>';
        
             echo "</div>";
        
         }

         if(!empty($errors))
            {
                echo "<div class='error-message'>";
                foreach ($errors as $error) 
                {
                    echo "<p style='color:red;'>$error</p>";
                }
                echo "<button onclick='history.back()'>Go Back</button>";
                echo "</div>";
                    
            }

?>



