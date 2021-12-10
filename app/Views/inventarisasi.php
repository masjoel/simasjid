<?= $this->extend("template/index") ?>
<?= $this->section("isi-halaman") ?>
<?= $this->section("style") ?>
<style>
  .merah {
    color: red !important
  }
</style>
<?= $this->endSection() ?>

<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 merah" onclick="test()">Inventarisasi</h1>
  </div>

</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
  function test() {
    alert("halaman INVENTARISASI")
  }
</script>
<?= $this->endSection() ?>