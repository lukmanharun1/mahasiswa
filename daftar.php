<?php 


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Daftar Mahasiswa</title>
  </head>
  <body>
    <h1 class="text-center my-3">Daftar Mahasiswa</h1>
    <div class="row justify-content-center">
      <div class="col-lg-4">
        <form method="POST" action="">
        <!-- username -->
        <div class="mb-3">
          <label for="Username" class="form-label">Username: </label>
          <input type="text" class="form-control" id="Username" name="username">
        </div>
        <!-- password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <!-- konfirmasi password -->
        <div class="mb-3">
          <label for="konfirmasi-password" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="konfirmasi-password" name="konfirmasi-password">
        </div>
        <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
      </form>
      </div>
    </div>
  </body>
</html>