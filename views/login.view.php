<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <div class="w-50 mx-auto bg-light p-5  rounded shadow-lg p-3 mb-5 bg-body rounded mt-4">
        <h1 class="h3 mb-3 fw-normal mb-5 text-center">Silahkan Login Cik</h1>
        <form action="" method="POST" class="d-flex flex-column gap-3">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Usename123" name="username">
                <label for="floatingInput">Masukkan username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Masukkan password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </form>
    </div>
    </div>
</body>
</html>