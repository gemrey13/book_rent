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
    <title>Rebook</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../static/css/index.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../static/css/addBook.css">
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
                <a href="myPosts.php">My Post</a>
                
                <?php
                  if ($_SESSION['username'] == 'Admin') {
                    echo "<a href='admin.php'>Admin</a>";
                  }
                ?>
                <a href="logout.php">Logout</a>
            </div>
            <div>
            <form class="wrap" method="GET" action="blog.php" >
                <div class="search">
                <input type="text" name="searchTitle" class="searchTerm" placeholder="Search">
                <button type="submit" name="searchBtn" class="searchButton"><img src="../static/img/magnify.svg"></button>
                </div>
            </form>
            </div>
        </div>
    </nav>







<div class="form-container">
  <div class="form-add-book">
    <form action="#" method="POST" enctype="multipart/form-data">

      <!-- Title input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="titl">Title</label>
        <input type="text" id="titl" class="form-control" name="title" />
        
      </div>

      <!-- Author input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="auth">Author</label>
        <input type="text" id="auth" class="form-control" name="author" />
        
      </div>

      <!-- Description input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="desc">Description</label>
        <textarea class="form-control" id="desc" rows="4" name="description"></textarea>
        
      </div>

      <!-- Image input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="image">Select a Image</label>
        <input type="file" name="Image" id="image" accept=".jpg, .jpeg, .png"><br>
        
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="categories">Select a Category</label>
        <?php
        showCategories($pdo);
        ?>  
      </div>
      

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4" name="addBookBtn">Add a book</button>
    </form>

    <form method="post" action="#">
        <input type="text" name="category" class="form-label" placeholder="Add Category" style="color:black;" required>
        <button type="submit" name="addCategoryBtn">Save</button>
      </form>
  </div>
</div>



<?php
  if(isset($_GET['searchBtn'])) {
      searchQuery($pdo, $_GET['searchTitle']);
    }
  ?>

</body>
</html>