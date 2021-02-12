<?php 
require_once 'functions.php';
$mahasiswa = getQuery("SELECT * FROM `mahasiswa`");

$i = 1;
if (isset($_POST['tambah'])) {
   echo tambah($_POST, $_FILES);
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
    <!-- my-css -->
    <link rel="stylesheet" href="my-css.css">
    <title>Halaman Admin</title>
  </head>
  <body>
    <h1 class="text-center mt-3">Daftar Mahasiswa</h1>
    <div class="mx-3">
      <div class="row">
        <div class="col-md-3">
        <button type="button" class="btn btn-primary mt-4 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 0 24 24" width="28" fill="#fff">
          <path d="M0 0h24v24H0z" fill="none"/>
          <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
          Tambah Data Mahasiswa
        </button>
        <!-- icon search -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" class="icon-search">
          <path fill="#0d6efd" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
          </path>
        </svg>
          <input 
            type="text" 
            class="form-control mb-4 search" 
            name="cari" 
            autocomplete="off" 
            placeholder="Cari Data Mahasiswa"
          />
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="alert alert-success  alert-dismissible fade show" role="alert">
            A simple success alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      </div>
    </div>
    
    <table class="table">
      <thead class="bg-primary text-white">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Aksi</th>
          <th scope="col">Nama</th>
          <th scope="col">Nrp</th>
          <th scope="col">Email</th>
          <th scope="col">Jurusan</th>
          <th scope="col">Gambar</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($mahasiswa as $mhs) : ?>
      <!-- nomor -->
        <tr>
          <th scope="row"><?= $i++; ?></th>
          <!-- tombol aksi -->
          <td>
            <a href="#" class="btn btn-sm btn-primary">
              Edit
            </a>
            <a href="#" class="btn btn-sm btn-danger">
              Hapus
            </a>
          </td>
          <!-- nama -->
          <td>
            <?= $mhs['nama']; ?>
          </td>
          <!-- nrp -->
          <td>
            <?= $mhs['nrp']; ?>
          </td>
          <!-- email -->
          <td>
            <?= $mhs['email']; ?>
          </td>
          <!-- jurusan -->
          <td>
            <?= $mhs['jurusan']; ?>
          </td>
          <!-- gambar -->
          <td>
            <?= $mhs['gambar']; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           <!-- form -->
           <form action="" method="POST" enctype="multipart/form-data">
              <!-- nama -->
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
              <!-- nrp -->
              <div class="mb-3">
                <label for="nrp" class="form-label">Nrp</label>
                <input type="number" class="form-control" id="nrp" name="nrp" required>
              </div>
              <!-- email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <!-- jurusan -->
              <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" required>
              </div>
               <!-- gambar -->
               <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
              </div>
           
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" name="tambah" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="#fff">
                  <path d="M0 0h24v24H0z"fill="none"/>
                  <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
                </svg>
                Simpan Data Mahasiswa
              </button>
            </div>
        </form>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>