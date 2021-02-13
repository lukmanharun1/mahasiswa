// inisialisasi
const containerModal = document.getElementsByClassName('container-modal')[0];
const modalContent = document.getElementsByClassName('modal-content')[0];
// tombol tambah
const tombolTambah = document.getElementsByClassName('tombol-tambah')[0];
tombolTambah.addEventListener('click', function() {
  modalContent.innerHTML = `
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
          <label for="nrp" class="form-label">Nrp</label>
          <input type="number" class="form-control" id="nrp" name="nrp" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="jurusan" class="form-label">Jurusan</label>
          <input type="text" class="form-control" id="jurusan" name="jurusan" required>
        </div>
        <div class="update-gambar"></div>
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar</label>
          <input type="file" class="form-control" id="gambar" name="gambar" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" name="tambah" class="btn btn-primary" id="tombol-submit">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="#fff">
            <path d="M0 0h24v24H0z"fill="none"/>
            <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
          </svg>
          Simpan Data Mahasiswa
        </button>
      </div>
    </form>`;

});



// tombol update -> menggunakan event mouse
const tombolupdate = document.addEventListener('click', event => {
  const dataId = event.target.dataset.id;
  if (dataId) {
    fetch(`http://localhost/mahasiswa/ajax-update.php/${dataId}`)
      .then(response => response.text())
      .catch(error => console.log(error))
      .then(responseHTML => {
        modalContent.innerHTML = responseHTML;
      });
  }
});

// cari data

const inputSearch = document.getElementsByClassName('search')[0];
const tbody = document.getElementsByTagName('tbody')[0];
inputSearch.addEventListener('keyup', function() {
  const cariData = inputSearch.value;
  fetch('http://localhost/mahasiswa/ajax-cari.php/' + cariData)
    .then(response => response.text())
    .then(response => {
      tbody.innerHTML = response;
    });
});