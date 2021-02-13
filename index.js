// inisialisasi
const modal = document.getElementById('exampleModal');

// tombol tambah
const tombolTambah = document.getElementsByClassName('tombol-tambah')[0];
tombolTambah.addEventListener('click', function() {
  modal.innerHTML = `
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
     <form action="" method="POST" enctype="multipart/form-data">
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
         <div class="edit-gambar"></div>
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
    </form>
  </div>
</div>`;

});



// tombol edit
const tombolEdit = document.querySelectorAll('button.edit');
tombolEdit.forEach(edit => {
  edit.addEventListener('click', function() {
    const dataId = this.dataset.id;
    fetch(`http://localhost/mahasiswa/ajax-edit.php/${dataId}`)
      .then(response => response.text())
      .then(response => {
        modal.innerHTML = response;
      });
  });
});