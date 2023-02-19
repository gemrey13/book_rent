<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Renter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../static/css/styles.css" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form action="/" method="POST">
            <h1 class="h3 mb-3 fw-normal">Login</h1>
            <div class="form-floating">
                <input type="text" name="username" class="form-control top" id="floatingInput" placeholder="Username" required autofocus>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="upass" class="form-control bottom" id="floatingInput" placeholder="Password" required>
                <label for="floatingInput">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; All rights reserved 2023</p>
        </form>
    </main>
</body>

</html>