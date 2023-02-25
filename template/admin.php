<?php
  include '../process/utils.php';

  session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['username'])) {
        header('Location: landing.php');
        exit();
    }else if($_SESSION['username'] !== 'Admin'){
      echo "<script> alert('Not admin User')</script>";
      header('Location: blog.php');
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
    <link rel="stylesheet" type="text/css" href="../static/css/admin.css">

</head>

<script>
    function DeleteUser(userID){
        alert("WARNING: If you delete User \n the user posts will also be deleted");
        let ans=confirm("Are you sure you want to delete the User Information?")
        if(ans){
          window.location="admin.php?userID="+userID+"&trn=DELETE";
        }
      }

      function DeleteBook(bookID){
        let ans=confirm("Are you sure you want to delete the Book?")
        if(ans){
          window.location="admin.php?bookID="+bookID+"&trn=DELETEBOOK";
        }
      }


    function UpdateUser(userID){
        let ans=confirm("Are you sure you want to edit the user information?")
        if(ans){
          window.location="editUser.php?userID="+userID+"&trn=UPDATE";
        }
      }

</script>

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
                    echo "<a href='admin.php' style='color:blue;'>Admin</a>";
                  }
                ?>
                <a href="logout.php">Logout</a>
            </div>
            <div>
            <form class="wrap" method="GET" action="blog.php">
                <div class="search">
                <input type="text" name="searchTitle" class="searchTerm" placeholder="Search">
                <button type="submit" name="searchBtn" class="searchButton"><img src="../static/img/magnify.svg"></button>
                </div>
            </form>
            </div>
        </div>
    </nav>

        <form method="post" class="nav-admin">
            <button type="submit" name="AdminPanelUser">User</button>
            <button type="submit" name="AdminPanelPost">Posts</button>
        </form>



    <table class="styled-table">
        <?php if(isset($_POST['AdminPanelUser'])){
            echo "<thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    ".populateUser($pdo)."
                  </tbody>
                ";
                unset($_POST['AdminPanel']);
                }elseif(isset($_POST['AdminPanelPost'])){
                    echo "<thead>
                    <tr>
                        <th>Book ID</th>
                        <th>User ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category Name</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    ".populateBook($pdo)."
                  </tbody>
                ";
                }
        ?>

      

    </table>









  <?php
    if(isset($_GET['searchBtn'])) {
      searchQuery($pdo, $_GET['searchTitle']);
    }

    ?>

</body>.
</html>