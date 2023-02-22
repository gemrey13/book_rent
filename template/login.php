<?php
  include '../process/utils.php';

  session_start();

    if (isset($_SESSION['username'])) {
        header('Location: blog.php');
        exit();
    }
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rebook</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../static/css/styles.css" rel="stylesheet">
    <link rel="icon" href="../static/img/rebook.png">
</head>

<body class="text-left">

    <div class="login" id="login-form">
        <form action="" method="POST" >

            <h1 class="login__title">Login</h1>

            <div class="login__group">
                <input type="text" name="username" class="login__group__input" id="floatingInput"  required autofocus placeholder="A , a , 1 , - , _">
                <label for="floatingInput" class="login__group__label">Username</label>
            </div>

            <div class="login__group">
                <input type="password" name="upass" class="login__group__input" id="floatingInput" required placeholder="A , a , 1 , - , _">
                <label for="floatingInput" class="login__group__label">Password</label>
            </div>

            <button class="login__sign-in" type="submit" name="loginBtn">Login</button>
            <p style="text-align: center; color:white;">&copy; All rights reserved 2023</p>
        </form>
    </div>
</body>

</html>