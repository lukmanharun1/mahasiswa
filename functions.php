<?php 

function koneksi() {
  return mysqli_connect('localhost', 'root', '', 'phpdasar');
}

function filter($input) {
  return htmlspecialchars(mysqli_escape_string(koneksi(), $input));
}

function query($query) {
 return  mysqli_query(koneksi(), $query);
}

function getQuery($query) {
  return mysqli_fetch_all(query($query), MYSQLI_ASSOC);
}

function tambah($post = [], $uploadGambar = []) {
  // wajib di isi
  if (!isset($post['nama']) && !isset($post['nrp']) &&
      !isset($post['email']) && !isset($post['jurusan']) &&
      !isset($uploadGambar)) {
      return 'Pastikan Semua data Wajib Diisi';
  } else if (!verifyEmail($post['email'])) {
    return 'Email Tidak Valid';
  } else {
    $name = $uploadGambar['gambar']['name'];
    $tmp_name = $uploadGambar['gambar']['tmp_name'];
    $size = $uploadGambar['gambar']['size'];
    $ukuranGambar = 3000000; // 3mb
    $ekstensi = strtolower(end(explode('.', $name)));
    $extensiGambar = ['jpg', 'jpeg', 'png'];
    // cek ekstensi gambar yang di upload
    if (!in_array($ekstensi, $extensiGambar)) {
      return 'yang anda upload bukan gambar!';
    } else if ($size >= $ukuranGambar) {
      return 'ukuran gambar terlalu besar!';
    } else {
      $nama = filter($post['nama']);
      $nrp = filter($post['nrp']);
      $email = filter($post['email']);
      $jurusan = filter($post['jurusan']);
      $gambar = filter($name);
      $namaFileBaru = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;
      var_dump($uploadGambar);
      var_dump(move_uploaded_file($tmp_name, "upload-gambar/" . $name)); die;
      $query = "INSERT INTO `mahasiswa` VALUES (NULL, '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
      query($query);
      $status = mysqli_affected_rows(koneksi());
      if ($status > -1) {
        return 'Data Mahasiswa Berhasil ditambahkan';
      }
      return 'Data Mahasiswa Gagal ditambahkan';
    }
  }
}
function verifyEmail($email) {
  if(preg_match ('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email)) {
  return true;
}
  return false;

    
}
function redirect($url) {
  header('location: ' . $url .'.php');
}