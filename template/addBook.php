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


  <div style="width:50%;margin: auto;">
    <form action="#" method="POST" enctype="multipart/form-data">

      <!-- Title input -->
      <div class="form-outline mb-4">
        <input type="text" id="titl" class="form-control" name="title" />
        <label class="form-label" for="titl">Title</label>
      </div>

      <!-- Author input -->
      <div class="form-outline mb-4">
        <input type="text" id="auth" class="form-control" name="author" />
        <label class="form-label" for="auth">Author</label>
      </div>

      <!-- Description input -->
      <div class="form-outline mb-4">
        <textarea class="form-control" id="desc" rows="4" name="description"></textarea>
        <label class="form-label" for="desc">Description</label>
      </div>

      <!-- Image input -->
      <div class="form-outline mb-4">
        <input type="file" name="Image" id="image" accept=".jpg, .jpeg, .png"><br>
        <label class="form-label" for="image">Select a Image</label>
      </div>

      <div class="form-outline mb-4">
        <?php
        showCategories($pdo);
        ?>
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4" name="addBookBtn">Add a book</button>
    </form>
  </div>



</body>
</html>