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
} else if (isset($_SESSION['auth']) && isset($_COOKIE['remember-me']) || isset($_COOKIE['username'])) {
  redirect('index');
  exit;
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

<?= startHTML('Halaman Admin'); ?>
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
            
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="24" width="24" fill="rgb(13 110 253)">
              <path  d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z">
              </path>
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
        <br>
        <button type="submit" class="btn btn-primary mr-3" name="login">Login Sekarang</button>
        <a href="daftar.php" class="text-secondary">Belum punya akun?</a>
      </form>
    </div>
  </div>
<!-- footer -->
  <?php require_once 'footer.php' ?>
<?= endHTML(); ?>