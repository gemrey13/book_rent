<?php
  include '../process/utils.php';

  session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Renter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../static/css/index.css" rel="stylesheet">
</head>

<body>
    <nav>
        <h1 >Book Renter</h1>
        <div class="nav-right">
            <div class="nav-item">
                <a href="#">Home</a>
                <a href="#">Categories</a>
                <a href="logout.php">Logout</a>
            </div>
            <div>
            <form>
                <input type="text" name="title" placeholder="Search">
                <button type="submit" name="searchBtn">search</button>
            </form>
            </div>
        </div>
    </nav>
    <hr>

    
</body>