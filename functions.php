<?php 

function koneksi() {
  return mysqli_connect('localhost', 'root', '', 'phpdasar');
}

function filter($input) {
  return htmlspecialchars(mysqli_escape_string(koneksi(), $input));
}

function query($query) {
 return mysqli_fetch_all( mysqli_query(koneksi(), $query), MYSQLI_ASSOC);
}

