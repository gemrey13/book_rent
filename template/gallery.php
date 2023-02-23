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
    <title>Book Renter</title>
    <link href="../static/css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">
<link rel="icon" href="../static/img/rebook.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>

<body>
    <nav>
        <a class="navbar-brand" >
            <img src="../static/img/rebook.png" width="70" height="70" class="d-inline-block align-top" alt="Rebook logo" style="position: relative; left: 0.5em; top: 0em;">ebook</a>
        <div class="nav-right">
            <div class="nav-item">
                <a href="blog.php">Home</a>
                <a href="gallery.php">Gallery</a>
                <a href="logout.php">Logout</a>
            </div>
            <div>
            <form class="wrap" method="GET">
                <div class="search">
                <input type="text" name="searchTitle" class="searchTerm" placeholder="Search">
                <button type="submit" name="searchBtn" class="searchButton"><img src="../static/img/magnify.svg"></button>
                </div>
            </form>
            </div>
        </div>
    </nav>







    <div class="gallery">
        <div class="gallery__column">
            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="300" style="object-fit: contain;" alt="Portrait by Jessica Felicio" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Jessica Felicio</figcaption>
                </figure>
            </a>

            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="500" style="object-fit: contain;" alt="Portrait by Oladimeji Odunsi" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Oladimeji Odunsi</figcaption>
                </figure>
            </a>

            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="300" style="object-fit: contain;" alt="Portrait by Alex Perez" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Alex Perez</figcaption>
                </figure>
            </a>
        </div>

        <div class="gallery__column">
            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="300" style="object-fit: contain;"  alt="Portrait by Noah Buscher" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Noah Buscher</figcaption>
                </figure>
            </a>

            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="300" style="object-fit: contain;" alt="Portrait by Ivana Cajina" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Ivana Cajina</figcaption>
                </figure>
            </a>

            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="500" style="object-fit: contain;"  alt="Portrait by Sam Burriss" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Sam Burriss</figcaption>
                </figure>
            </a>
        </div>

        <div class="gallery__column">
            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="500" style="object-fit: contain;" alt="Portrait by Mari Lezhava" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Mari Lezhava</figcaption>
                </figure>
            </a>

            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="300" style="object-fit: contain;" alt="Portrait by Ethan Haddox" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Ethan Haddox</figcaption>
                </figure>
            </a>

            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="300" style="object-fit: contain;" alt="Portrait by Amir Geshani" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Amir Geshani</figcaption>
                </figure>
            </a>
        </div>

        <div class="gallery__column">
            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="300" style="object-fit: contain;" alt="Portrait by Guilian Fremaux" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Guilian Fremaux</figcaption>
                </figure>
            </a>

            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="300" style="object-fit: contain;" alt="Portrait by Jasmin Chew" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Jasmin Chew</figcaption>
                </figure>
            </a>

            <a href="" class="gallery__link">
                <figure class="gallery__thumb">
                    <img src="<?php randomImage()?>" width="300" height="500" style="object-fit: contain;" alt="Portrait by Dima DallAcqua" class="gallery__image">
                    <figcaption class="gallery__caption">Portrait by Dima DallAcqua</figcaption>
                </figure>
            </a>
        </div>
    </div>




    <?php
    if(isset($_GET['searchBtn'])) {
      searchQuery($pdo, $_GET['searchTitle']);
    }
    ?>


    <footer>

      <div class="container">
       <ul>
         <li class="ps-2 pb-3"> &copy; All rights reserved 2023</li>
       </ul>
        <div class="row">
          <div class="col-md-4 col-6">
            <ul>
              <li><a href="#">FAQ</a></li>
              <li><a href="#">Investor Relations</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Speed Test</a></li>
            </ul>
          </div>
          <div class="col-md-4 col-6">
            <ul>
              <li>An active item</a></li>
              <li><a href="#">Help Centre</a></li>
              <li><a href="#">Jobs</a></li>
              <li><a href="#">Cookie Preferences</a></li>
              <li><a href="#">Legal Notices</a></li>
            </ul>
          </div>
          <div class="col-md-4 col-6">
            <ul>
              <li><a href="#">Account</a></li>
              <li><a href="#">Ways to Read</a></li>
              <li><a href="#">Corporate Information</a></li>
              <li><a href="#">Book Rental Originals</a></li>
            </ul>
          </div>

        </div>
      </div>

    </footer>



</body>
</html>