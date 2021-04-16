<?php
require_once 'functions.php';
$uri = $_SERVER['REQUEST_URI'];
$id = (int) filter(explode('/', $uri)[3]);
if (!$id) {
  redirect('index');
}
$query = "SELECT * FROM `mahasiswa` WHERE id = '$id'";
$result = getQuery($query)[0];
if (!$result) {
  redirect('index');
}
$dataMhs = [
  'nama' => $result['nama'],
  'nrp' => $result['nrp'],
  'email' => $result['email'],
  'jurusan' => $result['jurusan'],
  'gambar' => $result['gambar']
];

?>
<form action="" method="POST" enctype="multipart/form-data">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Update Data Mahasiswa</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" required value="<?= $dataMhs['nama']; ?>">
    </div>
    <div class="mb-3">
      <label for="nrp" class="form-label">Nrp</label>
      <input type="number" class="form-control" id="nrp" name="nrp" required value="<?= $dataMhs['nrp']; ?>">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required value="<?= $dataMhs['email']; ?>">
    </div>
    <div class="mb-3">
      <label for="jurusan" class="form-label">Jurusan</label>
      <input type="text" class="form-control" id="jurusan" name="jurusan" required value="<?= $dataMhs['jurusan']; ?>">
    </div>
    <div class="update-gambar">
      <img src="upload-gambar/<?= $dataMhs['gambar']; ?>" width="45" height="45" />
    </div>
    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar <p class="text-secondary d-inline">(ingin ganti gambar?)</p></label>
      <input type="file" class="form-control" id="gambar" name="gambar">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" name="update" class="btn btn-primary">
      <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="#fff">
        <path d="M0 0h24v24H0z" fill="none" />
        <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z" />
      </svg>
      Update Data Mahasiswa
    </button>
  </div>
</form>