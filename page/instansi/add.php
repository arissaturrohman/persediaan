<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Add Data Instansi
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="instansi">Nama Instansi</label>
          <input type="text" class="form-control" id="instansi" name="instansi" value="<?= $_POST['instansi']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $_POST['alamat']; ?>">
        </div>
        <div class="form-group">
          <label for="telp">No Telp.</label>
          <input type="text" class="form-control" id="telp" name="telp" value="<?= $_POST['telp']; ?>">
        </div>
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $instansi = $_POST['instansi'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];
  $tahun = date("Y-m-d");

  $sql = $conn->query("INSERT INTO tb_instansi (nama_instansi, alamat_instansi,no_telp,tahun, id_user) VALUES ('$instansi','$alamat','$telp','$tahun','$_SESSION[id_user]')");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "?page=instansi";
  }
}
?>