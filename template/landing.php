<?php
  include '../process/utils.php';

  session_start();

    // Check if the user is not logged in
    if (isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    };
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../static/css/landing.css">
    <title>Rebook</title>
    <link rel="icon" href="../static/img/rebook.png">
  </head>


  <body>
    <nav class="navbar navbar-light p-0" style="position: fixed;">
      <div class="container-fluid px-5">
        <a class="navbar-brand">
          <img src="../static/img/rebook.png" width="70" height="70" class="d-inline-block align-top" alt="Rebook logo" style="position: relative; left: 0.5em; top: 0em;">
        ebook</a>
        <div class="d-flex">
          <a href="login.php" class="btn-danger btn top-sign-in" style="background-color: Blue; margin-right: 2em;">Login</a>
          <a href="sign-up.php" class="btn-danger btn top-sign-in">Register</a>
        </div>
      </div>
    </nav>
    <div class="bg-img">
      <div class="layer">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1>Unlimited books, manga <br>novel and more.</h1>
            <h3>Read anywhere. Cancel anytime.</h3>
            <h5>Ready to read? Register now and start reading.</h5>
          </div>
        </div>
      </div>
    </div>
    <section>
      <div class="container">
        <div class="row align-items-center reverse">
          <div class="col-lg-6">
            <h2>Enjoy on your Desktop.</h2>
            <p>Read on smart TVs, PlayStation, Xbox, Chromecast, Apple TV, Android players and more.</p>
          </div>
          <div class="col-lg-6">
            <img src="../static/img/single.png">
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row align-items-center ">
          <div class="col-lg-6">
            <img src="../static/img/single.png">
          </div>
          <div class="col-lg-6">
            <h2>Download your books to read offline.</h2>
            <p>Save your favourites easily and always have something to read.</p>
          </div>
        </div>
      </div>
    </section>
    
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
  </body>
</html>