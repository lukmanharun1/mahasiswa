<?php 
require_once 'functions.php';
$uri = $_SERVER['REQUEST_URI'];
$cariData = filter(explode('/', $uri)[3]);
$query = "SELECT * FROM `mahasiswa` WHERE 
          nama LIKE '%$cariData%' OR
          nrp LIKE '%$cariData%' OR
          email LIKE '%$cariData%' OR
          jurusan LIKE '%$cariData%'";
if (!$cariData) {
  $query = "SELECT * FROM `mahasiswa`";
}

$mahasiswaCari = getQuery($query);
$i = 1;
?>


<?php foreach($mahasiswaCari as $mhs) : ?>
  <tr>
    <th scope="row"><?= $i++; ?></th>
    <td>
      <button type="button" class="btn btn-sm btn-primary update" data-id="<?= $mhs['id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20" fill="#fff" data-id="<?= $mhs['id']; ?>">
          <path d="M0 0h24v24H0z" fill="none" data-id="<?= $mhs['id']; ?>" />
          <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" data-id="<?= $mhs['id']; ?>" />
        </svg>
      </button>
      <a href="hapus.php/<?= $mhs['id']; ?>/<?= $mhs['gambar']; ?>" class="btn btn-sm btn-danger"
        onclick="return confirm('yakin ingin hapus data ini?')">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  width="20" height="20">
          <path fill="#fff" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
        </svg>
      </a>
    </td>
    <td>
      <?= $mhs['nama']; ?>
    </td>
    <td>
      <?= $mhs['nrp']; ?>
    </td>
    <td>
      <?= $mhs['email']; ?>
    </td>
    <td>
      <?= $mhs['jurusan']; ?>
    </td>
    <td>
      <img 
        src="upload-gambar/<?= $mhs['gambar']; ?>" 
        alt="gambar mahasiswa" 
        width="35"
        height="35"
      />
    </td>
  </tr>
<?php endforeach; ?>