<?php
  include '../process/utils.php';

  session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['username'])) {
        header('Location: landing.php');
        exit();
    }
?>

<!doctype html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rebook</title>
    <link href="../static/css/index.css" rel="stylesheet">
	<link rel="icon" href="../static/img/rebook.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../static/css/blog.css">
</head>


<body>

    <nav>
        <a class="navbar-brand" >
            <img src="../static/img/rebook.png" width="70" height="70" class="d-inline-block align-top" alt="Rebook logo" style="position: relative; left: 0.5em; top: 0em;">
        ebook</a>
        <div class="nav-right">
            <div class="nav-item">
                <a href="blog.php">Home</a>
                <a href="gallery.php">Gallery</a>
                <a href="myPosts.php" style="color:blue;">My Post</a>
                
                <?php
                  if ($_SESSION['username'] == 'Admin') {
                    echo "<a href='admin.php'>Admin</a>";
                  }
                ?>
                <a href="logout.php">Logout</a>
            </div>
            <div>
            <form class="wrap" method="GET" >
                <div class="search">
                <input type="text" name="searchTitle" class="searchTerm" placeholder="Search">
                <button type="submit" name="searchBtn" class="searchButton"><img src="../static/img/magnify.svg"></button>
                </div>
            </form>
            </div>
        </div>
    </nav>




    <?php
        myPosts($pdo, $_SESSION['userID']);
    ?>

</body>
</html>