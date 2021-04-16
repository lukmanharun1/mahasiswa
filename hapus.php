<?php
session_start();
require_once 'functions.php';
$uri = $_SERVER['REQUEST_URI'];
$id = (int) filter(explode('/', $uri)[3]);
$gambar = filter(explode('/', $uri)[4]);
$target = "upload-gambar/$gambar";
if (!$id && $gambar) {
  redirect('index');
} else if (hapusFileGambar($target)) {
  // hapus data
  $query = "DELETE FROM `mahasiswa` WHERE id = '$id'";
  // status
  $statusQuery = query($query);
  if ($statusQuery) {
    $_SESSION['hapus'] = 'Data Mahasiswa <b>Berhasil</b> dihapus';
    redirect('index');
  } else {
    $_SESSION['hapus'] = 'Data Mahasiswa <b>Gagal</b> dihapus';
    redirect('index');
  }
} else {
  // jika tidak ada harapan data
  redirect('index');
}
