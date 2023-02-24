<?php
  include '../process/utils.php';

  session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['username'])) {
        header('Location: landing.php');
        exit();
    }else if($_SESSION['username'] == 'Admin'){
      
    }
    else{
      echo "<script> alert('Not admin User')</script>";
      header('Location: blog.php');
      }

    if (isset($_GET['trn']) && $_GET['trn'] == 'UPDATE') {
        $userID =  $_GET['userID'];
        list('userID'=>$userID,'username'=>$username, 'firstname'=>$firstname, 'lastname'=>$lastname, 'upass'=>$upass) = getUserInfo($pdo, $userID);
    }

    if (isset($_POST['updateUserBtn'])) {

        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $upass1 = $_POST['upass1'];
        $upass2 = $_POST['upass2'];
        if($upass1 === $upass2) {
            $upass = $upass1;
            updateUser($pdo, $userID, $username, $firstname, $lastname, $upass);
        }
    }

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Renter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../static/css/styles.css" rel="stylesheet">
    <link rel="icon" href="../static/img/rebook.png">
</head>



<body class="text-center">

    <div class="login" style="height: 90%;">
        <form action="" method="POST">

            <h1 class="login__title">Edit existing account</h1>
            <div class="login__group">
                <input type="text" name="firstname" class="login__group__input" id="floatingInput" placeholder="First Name" required value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $firstname;} ?>">
                <label for="floatingInput" class="login__group__label">First Name</label>
            </div>

            <div class="login__group">
                <input type="text" name="lastname" class="login__group__input" id="floatingInput" placeholder="Last Name" required value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $lastname;} ?>">
                <label for="floatingInput" class="login__group__label">Last Name</label>
            </div>

            <div class="login__group">
                <input type="text" name="username" class="login__group__input" id="floatingInput" placeholder="Username" required value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $username;} ?>">
                <label for="floatingInput" class="login__group__label">Username</label>
            </div>

            <div class="login__group">
                <input type="password" name="upass1" class="login__group__input password1" id="floatingInput" placeholder="Password" required pattern="(?=.*[a-z])(?=.*[A-Z]).{2,}" title="Must contain at  and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php if (isset($_GET['trn']) && $_GET['trn']=='UPDATE'){ echo $upass;} ?>">
                <label for="floatingInput" class="login__group__label">Password</label>
            </div>
            <div class="login__group">
                <input type="password" name="upass2" class="login__group__input password2" id="floatingInput" placeholder="Confirm Password" required>
                <label for="floatingInput" class="login__group__label">Password</label>
            </div>
               <input type="checkbox" class="check"  onclick="showPass()" style="width:13px;height:13px;margin: 0 5px;"><span style="color:white;">Show Password</span>


            <button class="login__sign-in" type="submit" name="updateUserBtn">Save</button>

            <p style="text-align: center; color: white;">&copy; All rights reserved 2023</p>
        </form>
    </div>



<script type="text/javascript">
     function showPass() {
         let box1 = document.querySelector('.password1')
         let box2 = document.querySelector('.password2')
         if (box1.type === 'password') {
            box1.type = 'text';
            box2.type = 'text';

         }else {
            box1.type = 'password';
            box2.type = 'password';
         }
     }


</script>
    
</body>
        
</html>