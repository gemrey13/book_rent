<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
    <link href="../static/css/styles.css" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form action="/" method="post">
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
            <button class="w-100 btn btn-lg btn-primary" type="submit">Signup</button>
            <p class="mt-5 mb-3 text-muted">&copy; All rights reserved 2023</p>
        </form>
    </main>
</body>

</html>