<?php
session_start(); 

// errors old data
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old_data = isset($_SESSION['old_data']) ? $_SESSION['old_data'] : [];

//  errors delete
unset($_SESSION['errors']);
unset($_SESSION['old_data']);
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
    
    <div class="middle">                                                                               
        <div class="first"> 
            <div class="box1"></div> 
        </div>
        <div class="second">
            <div class="box2"></div>
            <div class="box3"></div>
            <div class="box4">
                <div class="box5"></div>
                <div class="box6"></div>
                <div class="box7"></div>
            </div>
            <div class="box8"></div>
            <div class="box9">
                <div class="box10">
                    <h2>BORROW BOOK</h2>
                    <form action="process.php" method="post">
                       <label for="Student Fullname" name="fullname"id="fullname">Student Fullname</label>
                       <input type="text" name="fullname" id="fullname"value="<?php echo isset($old_data['fullname']) ? htmlspecialchars($old_data['fullname']) : ''; ?>">
                       <?php if (isset($errors['fullname'])): ?>
                          <span class="error"><?php echo $errors['fullname']; ?></span>
                       <?php endif; ?>

                       <label for="Student Aiub ID" name="id"id="id">Student Aiub ID</label>
                       <input type="text" name="id" id="id"value="<?php echo isset($old_data['id']) ? htmlspecialchars($old_data['id']) : ''; ?>" >
                       <?php if (isset($errors['id'])): ?>
                         <span class="error"><?php echo $errors['id']; ?></span>
                       <?php endif; ?>

                       <label for="Student Email" name="email"id="email"> Student Email</label>
                       <input type="text" name="email" id="email" value="<?php echo isset($old_data['email']) ? htmlspecialchars($old_data['email']) : ''; ?>">
                       <?php if (isset($errors['email'])): ?>
                         <span class="email"><?php echo $errors['email']; ?></span>
                       <?php endif; ?>


                    <label for="Book Title" name="booktitle"id="booktitle">Book Title</label>
                    <select name="booktitle" id="booktitle">
                        <option value="" <?php echo !isset($old_data['booktitle']) ? 'selected' : ''; ?>>Select Book</option>
                        <option value="book1" <?php echo isset($old_data['booktitle']) && $old_data['booktitle'] == 'book1' ? 'selected' : ''; ?>>Book 1</option>
                        <option value="book2" <?php echo isset($old_data['booktitle']) && $old_data['booktitle'] == 'book2' ? 'selected' : ''; ?>>Book 2</option>
                        <option value="book3" <?php echo isset($old_data['booktitle']) && $old_data['booktitle'] == 'book3' ? 'selected' : ''; ?>>Book 3</option>
                    </select>
                    <?php if (isset($errors['booktitle'])): ?>
                       <span class="error"><?php echo $errors['booktitle']; ?></span>
                    <?php endif; ?>
                    
                     <label for="borrowdate" >Borrowing Date </label>
                     <input type="date" name="borrowdate" id="borrowdate"value="<?php echo isset($old_data['borrowdate']) ? $old_data['borrowdate'] : ''; ?>">
                     <?php if (isset($errors['borrowdate'])): ?>
                       <span class="error"><?php echo $errors['borrowdate']; ?></span>
                     <?php endif; ?>

                     <label for="token">Token</label>
                     <input type="number" name="token" id="token"value="<?php echo isset($old_data['token']) ? $old_data['token'] : ''; ?>">
                     <?php if (isset($errors['token'])): ?>
                        <span class="error"><?php echo $errors['token']; ?></span>
                     <?php endif; ?>

                     <label for="Returndate">Return Date</label>
                     <input type="date" name="returndate" id="returndate"value="<?php echo isset($old_data['returndate']) ? $old_data['returndate'] : ''; ?>">
                     <?php if (isset($errors['returndate'])): ?>
                       <span class="error"><?php echo $errors['returndate']; ?></span>
                     <?php endif; ?>

                     <label for="fees">Fees</label>
                     <input type="text" name="fees" id="fees"value="<?php echo isset($old_data['fees']) ? $old_data['fees'] : ''; ?>">
                     <?php if (isset($errors['fees'])): ?>
                       <span class="error"><?php echo $errors['fees']; ?></span>
                     <?php endif; ?>

                      <br>
                      <button for="Submit" name="submit" id="submit">submit</button>
                

                </form>
            
                </div>
                <div class="box11"></div>
            </div>

            
        </div>
        <div class="third">
            <div class="box12"></div>
        </div>
        
    </div> 
</div>
</body>
</html>                  