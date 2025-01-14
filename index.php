<?php
    $conn = mysqli_connect('localhost', 'root','', "book_browing");

    $query = "select * from bookrecords";

    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Browing Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <div class="full">
         <div class="img">
        <img src="id.png" alt="id" width="200" height="60"> </div>   
        <h1>Book Browing Management</h1>
    
    <div class="middle">                                                                               
        <div class="first"> 
            <div class="box1">
            <h2>Used Token</h2>
                <?php
                     echo "<center   >";
                    //$usedtoken = json_decode(file_get_contents("data.json"),true) ?: [];
                    if(file_exists("data.json"))
                    {
                        $usedToken = json_decode(file_get_contents("data.json"), true);
                    
                        foreach ($usedToken as $key)
                        {
                            echo $key; 
                            echo "<br>";
                        }
                    }
                ?>
            </div> 
        </div>
        <div class="second">
            <div class="box2">
                <table class="table">
                    
                            <tr>
                                <td>ID</td>
                                <td>Book name</td>
                                <td>Author</td>
                                <td>Isbn</td>
                                <td>Quantity</td>
                                <td>Category</td>
                            </tr>
                            <?php
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>
                                    <td>$row[id]</td>
                                    <td>$row[bookName]</td>
                                    <td>$row[authorName]</td>
                                    <td>$row[isbn]</td>
                                    <td>$row[quantity]</td>
                                    <td>$row[category]</td>
                                    </tr>";
                                }
                                
                            ?>
                            

                        </table>
            </div>
            <div class="box3">
                 <form action="update_delete.php" method="POST">
                     <h2>Update or Delete Book</h2>

                     <label for="bookId">Book ID:</label>
                     <input type="text" id="bookId" name="bookId" placeholder="Enter Book ID" required>

                     <label for="bookName">Book Name:</label>
                     <input type="text" id="bookName" name="bookName" placeholder="Enter Book Name">

                     <label for="authorName">Author Name:</label>
                     <input type="text" id="authorName" name="authorName" placeholder="Enter Author Name">

                     <label for="isbn">ISBN:</label>
                     <input type="text" id="isbn" name="isbn" placeholder="Enter ISBN">

                     <label for="quantity">Quantity:</label>
                     <input type="number" id="quantity" name="quantity" placeholder="Enter Quantity">

                     <label for="category">Category:</label>
                     <input type="text" id="category" name="category" placeholder="Enter Category">

                     <label for="action">Action:</label>
                     <select id="action" name="action" required>
                         <option value="update">Update</option>
                         <option value="delete">Delete</option>
                     </select>
                     <button type="submit">Submit</button>
                 </form>
            </div>
            <div class="box4">
                <div class="box5">
                <img src="book1.jpeg" alt="book1" width="160" height="100">   
                </div>  
                <div class="box6">
                <img src="libary.jpg" alt="libary" width="160" height="100"> 
                </div>
                <div class="box7">
                <img src="book2.avif" alt="book2" width="155" height="100"> 
                 </div>
            </div>
            <div class="box8">
            <form  action="insertData.php" method="post">
                        <h2>Book Insertion</h2>
                        <label for=" Book name" > Book name</label>
                        <input type="Text" placeholder="Enter book name" name="bookName" id="bookName">

                        <label for=Author > Author</label>
                        <input type="Text" placeholder="Enter author name" name="authorName" id="authorName">

                        <label for=Isbn > Isbn</label>
                        <input type="Text" placeholder="Enter isbn" name="isbn" id="isbn">

                        <label for=Quantity > Quantity</label>
                        <input type="Text" placeholder="Enter quantity" name="quantity" id="quantity">

                        <label for=Category > Category</label>
                        <input type="Text" placeholder="Enter category" name="category" id="category">

                        <button for="Submit" name="submit" id="submit">submit</button>
                    </form>
            </div>
            <div class="box9">
                <div class="box10">
                    <form action="process.php" method="post">
                    <h2>BORROW BOOK</h2>
                       <label for="Student Fullname" name="fullname"id="fullname">Student Fullname</label>
                       <input type="text" name="fullname" id="fullname"placeholder="Name" required>

                       <label for="Student Aiub ID" name="id"id="id">Student Aiub ID</label>
                       <input type="text" name="id" id="id" placeholder="22-22222-2"  required>
                       
                       <label for="Student Email" name="email"id="email"> Student Email</label>
                       <input type="text" name="email" id="email" placeholder="22-22222-2@student.aiub.edu" required>
                       
                       <label for="Book Title" name="booktitle"id="booktitle">Book Title</label>
                       <select name="booktitle" id="booktitle" required>
                           <option value="book1">Book 1</option>
                           <option value="book2">Book 2</option>
                           <option value="book3">Book 3</option>
                           <option value="book3">Book 4</option>
                           <option value="book3">Book 5</option>
                           <option value="book3">Book 6</option>
                       </select>

                       <label for="borrowdate" >Borrowing Date </label>
                       <input type="date" name="borrowdate" id="borrowdate" required>

                       <label for="token">Token</label>
                       <input type="number" name="token" id="token" >
                     
                       <label for="returndate">Return Date</label>
                       <input type="date" name="returndate" id="returndate"="returndate" required>

                       <label for="fees">Fees</label>
                       <input type="number" name="fees" id="fees">
                     
                      <br>
                      <button for="Submit" name="submit" id="submit">submit</button>
                

                </form>
            
                </div>
                <div class="box11">
                     <h2>Tokens</h2>
                     <?php
                         echo "<center   >";
                         $stu = json_decode(file_get_contents("token.json"));
                         foreach($stu as $stu) {
                             echo $stu->token[0]."<br>";
                             echo $stu->token[1]."<br>";
                             echo $stu->token[2]."<br>";
                             echo $stu->token[3]."<br>";
                             echo $stu->token[4]."<br>";
                             echo $stu->token[5]."<br>";    
                             echo $stu->token[6]."<br>";
                             echo $stu->token[7]."<br>";
                             echo $stu->token[8]."<br>";
                             echo $stu->token[9];
                         echo "</right>";
            }
        ?>

                </div>
            </div>

            
        </div>
        <div class="third">
            <div class="box12"></div>
        </div>
        
    </div> 
</div>
</body>
</html>                  