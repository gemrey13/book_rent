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
</head>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form action="login.php" method="POST">

            <h1 class="h3 mb-3 fw-normal">Create new account</h1>
            <div class="form-floating">
                <input type="text" name="firstname" class="form-control bottom" id="floatingInput" placeholder="First Name" required>
                <label for="floatingInput">First Name</label>
            </div>
            <div class="form-floating">
                <input type="text" name="lastname" class="form-control bottom" id="floatingInput" placeholder="Last Name" required>
                <label for="floatingInput">Last Name</label>
            </div>
            <div class="form-floating">
                <input type="text" name="username" class="form-control bottom" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="upass" class="form-control bottom" id="floatingInput" placeholder="Password" required>
                <label for="floatingInput">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="addUserBtn">Signup</button>
            <p class="mt-5 mb-3 text-muted">&copy; All rights reserved 2023</p>
        </form>
    </main>
</body>

</html>