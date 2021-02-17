<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'phpdasar');
}
function filter($input)
{
  return htmlspecialchars(mysqli_escape_string(koneksi(), $input));
}

function query($query)
{
  return  mysqli_query(koneksi(), $query);
}

function getQuery($query)
{
  return mysqli_fetch_all(query($query), MYSQLI_ASSOC);
}

function tambah($post, $uploadGambar = [])
{
  // wajib di isi
  if (
    !isset($post['nama']) && !isset($post['nrp']) &&
    !isset($post['email']) && !isset($post['jurusan']) &&
    !isset($uploadGambar)
  ) {
    return 'Pastikan Semua data Wajib Diisi';
  } else if (!verifyEmail($post['email'])) {
    return 'Email Tidak Valid';
  } else {
    $name = $uploadGambar['gambar']['name'];
    $tmp_name = $uploadGambar['gambar']['tmp_name'];
    $size = $uploadGambar['gambar']['size'];
    $ukuranGambar = 3000000; // 3mb
    // ngatasi bug di windows (variabel ekstensi)
    $ekstensi = explode('.', $name);
    $ekstensi = end($ekstensi);
    $ekstensi = strtolower($ekstensi);
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
      $namaFileBaru = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;
      $gambar = filter($namaFileBaru);
      $pathUpload = 'upload-gambar/' . $namaFileBaru;
      move_uploaded_file($tmp_name, $pathUpload);
      $query = "INSERT INTO `mahasiswa` VALUES (NULL, '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
      $statusQuery = query($query);
      if ($statusQuery) {
        return "Data Mahasiswa <b>$nama</b> Berhasil ditambahkan";
      }
      return "Data Mahasiswa <b>$nama</b> Gagal ditambahkan";
    }
  }
}
function verifyEmail($email)
{
  if (preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email)) {
    return true;
  }
  return false;
}
function redirect($url)
{
  header('location: http://localhost/mahasiswa/' . $url . '.php');
}

function hapusFileGambar($target)
{
  if (file_exists($target)) {
    return unlink($target);
  }
  redirect('index');
}

function update($post, $uploadGambar = [])
{
  if (
    !isset($post['nama']) && !isset($post['nrp']) &&
    !isset($post['email']) && !isset($post['jurusan'])
  ) {
    return 'Pastikan Semua data Wajib Diisi';
  } else if (!verifyEmail($post['email'])) {
    return 'Email Tidak Valid';
    // jika dia upload gambar
  } else if ($uploadGambar['gambar']['error'] === 0) {
    $name = $uploadGambar['gambar']['name'];
    $tmp_name = $uploadGambar['gambar']['tmp_name'];
    $size = $uploadGambar['gambar']['size'];
    $ukuranGambar = 3000000; // 3mb
    // ngatasi bug di windows (variabel ekstensi)
    $ekstensi = explode('.', $name);
    $ekstensi = end($ekstensi);
    $ekstensi = strtolower($ekstensi);
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
      $id = filter($post['id']);
      $namaFileBaru = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensi;
      $gambar = filter($namaFileBaru);
      // hapus gambar
      $query = "SELECT gambar FROM mahasiswa WHERE id = '$id'";
      $hapusGambar = getQuery($query);
      $target = 'upload-gambar/' . $hapusGambar[0]['gambar'];
      hapusFileGambar($target);
      // upload gambar
      move_uploaded_file($tmp_name, 'upload-gambar/' . $namaFileBaru);
      // query update
      $query = "UPDATE `mahasiswa` SET nama = '$nama',
                  nrp = '$nrp',
                  email = '$email',
                  jurusan = '$jurusan',
                  gambar = '$gambar'
                  WHERE id = '$id'";
      $statusQuery = query($query);
      if ($statusQuery) {
        return "Data Mahasiswa <b>$nama</b> Berhasil diupdate";
      }
      return "Data Mahasiswa <b>$nama</b> Gagal diupdate";
    }
  } else {
    // jika tidak upload gambar maka perbaharui data
    $nama = filter($post['nama']);
    $nrp = filter($post['nrp']);
    $email = filter($post['email']);
    $jurusan = filter($post['jurusan']);
    $id = filter($post['id']);

    // query update
    $query = "UPDATE `mahasiswa` SET nama = '$nama',
    nrp = '$nrp',
    email = '$email',
    jurusan = '$jurusan'
    WHERE id = '$id'";
    $statusQuery = query($query);
    if ($statusQuery) {
      return "Data Mahasiswa <b>$nama</b> Berhasil diupdate";
    }
    return "Data Mahasiswa <b>$nama</b> Gagal diupdate";
  }
}

function daftar($post)
{
  if (!isset($post['username']) && !isset($post['password']) && !isset($post['konfirmasi-password'])) {
    return 'Pastikan Semua Data Wajib diisi';
  } else if (strlen($post['username']) < 6) {
    return 'Username terlalu pendek!';
  } else if ($post['password'] !== $post['konfirmasi-password']) {
    return 'Pastikan password dengan konfirmasi password harus sama';
  } else if (strlen($post['password']) < 6) {
    return 'Password terlalu pendek!';
  }
  $username = filter($post['username']);
  $password = password_hash(filter($post['password']), PASSWORD_DEFAULT);
  $query = "SELECT `username` FROM `user` WHERE username = '$username'";
  $statusUser = getQuery($query);
  if ($statusUser) {
    return 'username sudah terdaftar!';
  } else {
    $query = "INSERT INTO `user` VALUES (NULL, '$username', '$password')";
    $statusQuery = query($query);
    if ($statusQuery) {
      return [
        'status' => 'success',
        'message' => 'selamat anda berhasil daftar',
        'username' => $username,
        // password input (plaint text)
        'password' => filter($post['password'])
      ];
    }
    return 'maaf data gagal mohon coba lagi';
  }
}

function login($post)
{
  if (!isset($post['username']) && !isset($post['password'])) {
    return 'pastikan semua data wajib diisi';
  }
  $username = filter($post['username']);
  $password = filter($post['password']);
  $query = "SELECT `username`, `password` FROM `user` WHERE username = '$username'";
  $result = getQuery($query)[0];
  // cek username
  if ($result) {

    // cek password
    $verify = password_verify($password, $result['password']);
    if ($verify) {
      return [
        'status' => 'success',
        'message' => 'Selamat Anda Berhasil Login',
        'password' => $result['password'],
        'username' => $username
      ];
    }
  }
  return 'Username / Password Salah!';
}
