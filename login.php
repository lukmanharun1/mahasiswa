<?php
session_start();
require_once 'functions.php';
$uri = $_SERVER['REQUEST_URI'];
if (isset(explode('/', $uri)[3])) {
  $logout = filter(explode('/', $uri)[3]);
} else {
  $logout = '';
}
// logout
if ($logout === 'logout') {
  session_unset();
  session_destroy();
  setcookie('remember-me', '', 0, '/mahasiswa');
  setcookie('username', '', 0, '/mahasiswa');
  setcookie('password', '', 0, '/mahasiswa');
  redirect('login');
} else if ($logout !== '') {
  redirect('login');
}
if (isset($_POST['login'])) {
  $login = login($_POST);
  if (isset($login['status'])) {
    $tujuhHari = time() + 60 * 60 * 24 * 7;
    if ($_POST['remember-me']) {
      setcookie('remember-me', $login['password'], $tujuhHari);
    }
    setcookie('username', $login['username'], $tujuhHari);
    $message = $login['message'];
    $_SESSION['auth'] = true;
    echo "<script>
            alert('$message');
            document.location.href = 'index.php';
          </script>";
    echo $message;
  } else {
    echo "<script>
            alert('$login');
          </script>";
  }
}
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <!-- my css -->
  <link rel="stylesheet" href="my-css.css">

  <title>Halaman Admin</title>
</head>

<body>
  <h2 class="text-center mt-3 mb-4">Halaman Login Admin Kelola Data Mahasiswa</h2>
  <div class="row">
    <div class="col-lg-4 mx-4 mt-5">
      <img src="ilustration-login.svg" alt="ilustration" width="450" />
    </div>
    <div class="col-lg-4">
      <form method="POST" action="">
        <!-- username -->
        <label for="Username" class="form-label">Username </label>
        <div class="mb-3 position-relative">
          <input type="text" class="form-control input-icon" id="Username" name="username" required value="<?= isset($username) ? $username : ''; ?>" />
          <!-- icon person -->
          <div class="icon-input">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="rgb(13 110 253)">
              <path d="M0 0h24v24H0z" fill="none" />
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
            </svg>
          </div>
        </div>
        <!-- password -->
        <label for="password" class="form-label">Password</label>
        <div class="mb-3 position-relative">
          <input type="password" class="form-control input-icon" id="password" name="password" required value="<?= isset($password) ? $password : ''; ?>" />
          <div class="icon-input">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="rgb(13 110 253)">
              <path d="M0 0h24v24H0z" fill="none" />
              <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
            </svg>
          </div>
        </div>
        <!-- remember me -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember-me" id="remember-me">
          <label class="form-check-label" for="remember-me">
            Remember Me
          </label>
        </div>
        <button type="submit" class="btn btn-primary mr-3 mt-3" name="login">Login Sekarang</button>
        <a href="daftar.php" class="text-secondary">Belum punya akun?</a>
      </form>
    </div>
  </div>
</body>

</html>