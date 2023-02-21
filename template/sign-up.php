<?php
  include '../process/utils.php';
  session_start();

    // Check if the user is not logged in
    if (isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
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
    <div class="login">
        <form action="login.php" method="POST">

            <h1 class="login__title">Create new account</h1>
            <div class="login__group">
                <input type="text" name="firstname" class="login__group__input" id="floatingInput" placeholder="First Name" required>
                <label for="floatingInput" class="login__group__label">First Name</label>
            </div>

            <div class="login__group">
                <input type="text" name="lastname" class="login__group__input" id="floatingInput" placeholder="Last Name" required>
                <label for="floatingInput" class="login__group__label">Last Name</label>
            </div>

            <div class="login__group">
                <input type="text" name="username" class="login__group__input" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput" class="login__group__label">Username</label>
            </div>

            <div class="login__group">
                <input type="password" name="upass" class="login__group__input" id="floatingInput" placeholder="Password" required>
                <label for="floatingInput" class="login__group__label">Password</label>
            </div>

            <button class="login__sign-in" type="submit" name="addUserBtn">Signup</button>
            <p style="text-align: center; color: white;">&copy; All rights reserved 2023</p>
        </form>
    </div>
</body>

</html>