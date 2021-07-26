<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Add Data Pegawai
    </div>
    <div class="card-body">
      <?php
      $instansi = $conn->query("SELECT * FROM tb_instansi WHERE id_user = '$_SESSION[id_user]'");
      $data = $instansi->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" name="id_instansi" value="<?= $data['id_instansi']; ?>">
        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
        <div class="form-group">
          <label for="kode_barang">Kode Barang</label>
          <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $_POST['kode_barang']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="volume">Jumlah Barang</label>
          <input type="text" class="form-control" id="volume" name="volume" value="<?= $_POST['volume']; ?>">
        </div>
        <div class="form-group">
          <label for="harga_satuan">Harga Satuan</label>
          <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" value="<?= $_POST['harga_satuan']; ?>">
        </div>
        <div class="form-group">
          <label for="jumlah_harga">Jumlah Harga</label>
          <input type="text" class="form-control" id="jumlah_harga" name="jumlah_harga" value="<?= $_POST['jumlah_harga']; ?>">
        </div>
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $instansi = $_POST['id_instansi'];
  $nama_pegawai = $_POST['pegawai'];
  $nip = $_POST['nip'];
  $jabatan = $_POST['jabatan'];
  $pangkat = $_POST['pangkat'];

  $sql = $conn->query("INSERT INTO tb_pegawai (id_instansi, nama_pegawai,nip,jabatan, pangkat, id_user) VALUES ('$instansi','$nama_pegawai','$nip','$jabatan','$pangkat', '$_SESSION[id_user]')");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "pegawai";
  }
}
?>