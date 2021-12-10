<?= $this->extend("template/index") ?>
<?= $this->section("isi-halaman") ?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Penduduk</h6>
      <button class="btn btn-danger btn-sm float-right">Tambah +</button>
    </div>
    <!-- Card Body -->
    <div class="card-body table-responsive">
      <table class="table table-striped" style="width: 100%;">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tempat Lahir</th>
            <th>Tgl. Lahir</th>
            <th>Agama</th>
            <th>Status</th>
            <th>Pendidikan</th>
            <th>Pendapatan</th>
            <th>Muzaki</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>