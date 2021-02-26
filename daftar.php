<?php
session_start();
require_once 'functions.php';
if (isset($_POST['daftar'])) {
  $daftar = daftar($_POST);
  if (isset($daftar['status'])) {
    $message = $daftar['message'];
    $_SESSION['username'] = $daftar['username'];
    $_SESSION['password'] = $daftar['password'];
    echo "<script>
            alert('$message');
            document.location.href = 'login.php';
          </script>";
  } else {
    echo "<script>
            alert('$daftar');
          </script>";
  }
} else if (isset($_SESSION['auth']) && isset($_COOKIE['remember-me']) || isset($_COOKIE['username'])) {
  redirect('index');
  exit;
}
?>
<?= startHTML('Daftar Admin'); ?>
  <h2 class="text-center mt-3 mb-4">Halaman Daftar Admin Kelola Data Mahasiswa</h2>
  <div class="row">
    <div class="col-lg-4 mx-4 mt-5">
      <img src="ilustration-daftar.svg" alt="ilustration" width="450" />
    </div>
    <div class="col-lg-4">
      <form method="POST" action="">
        <!-- username -->
        <label for="Username" class="form-label">Username </label>
        <div class="mb-3 position-relative">
          <input type="text" class="form-control input-icon" id="Username" name="username" required>
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
          <input type="password" class="form-control input-icon" id="password" name="password" required>
          <div class="icon-input">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="rgb(13 110 253)">
              <path d="M0 0h24v24H0z" fill="none" />
              <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
            </svg>
          </div>
        </div>
        <!-- konfirmasi password -->
        <label for="konfirmasi-password" class="form-label">Konfirmasi Password</label>
        <div class="mb-3 position-relative">
          <input type="password" class="form-control input-icon" id="konfirmasi-password" name="konfirmasi-password" required>
          <div class="icon-input">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="rgb(13 110 253)" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0)">
              <path d="M14.2031 6.5H13.2031V4.5C13.2031 1.74 10.9631 -0.5 8.20312 -0.5C5.44313 -0.5 3.20312 1.74 3.20312 4.5H5.10312L2.20312 6.5C1.10312 6.5 0.203125 7.4 0.203125 8.5V18.5C0.203125 19.6 1.10312 20.5 2.20312 20.5H14.2031C15.3031 20.5 16.2031 19.6 16.2031 18.5V8.5C16.2031 7.4 15.3031 6.5 14.2031 6.5ZM8.20312 15.5C7.10312 15.5 6.20312 14.6 6.20312 13.5C6.20312 12.4 7.10312 11.5 8.20312 11.5C9.30313 11.5 10.2031 12.4 10.2031 13.5C10.2031 14.6 9.30313 15.5 8.20312 15.5ZM11.3031 6.5H2.20312L5.10312 4.5C5.10312 2.79 6.49312 1.4 8.20312 1.4C9.91313 1.4 11.3031 2.79 11.3031 4.5V6.5Z" />
              </g>
              <defs>
                <clipPath id="clip0">
                  <rect width="24" height="24" fill="white"/>
                </clipPath>
              </defs>
            </svg>

          </div>
        </div>
        <button type="submit" class="btn btn-primary mr-3" name="daftar">Daftar Sekarang</button>
        <a href="login.php" class="text-secondary">Sudah punya akun?</a>
      </form>
    </div>
  </div>

  <!-- footer -->
  <?php require_once 'footer.php' ?>
<?= endHTML(); ?>