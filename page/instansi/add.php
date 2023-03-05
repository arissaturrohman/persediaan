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
        <div class="form-group">
          <label for="kd_pos">Kode Pos</label>
          <input type="text" class="form-control" id="kd_pos" name="kd_pos" value="<?= $_POST['kd_pos']; ?>">
        </div>
        <div class="form-group">
          <label for="web">Website</label>
          <input type="text" class="form-control" id="web" name="web" value="<?= $_POST['web']; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= $_POST['email']; ?>">
        </div>
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
        <a href="instansi" class="btn btn-sm btn-dark">Cancel</a>
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
  $kd_pos = $_POST['kd_pos'];
  $web = $_POST['web'];
  $email = $_POST['email'];
  $tahun = date("Y-m-d");

  $sql = $conn->query("INSERT INTO tb_instansi (nama_instansi, alamat_instansi,no_telp,kd_pos,website,email,tahun, id_user) VALUES ('$instansi','$alamat','$telp','$kd_pos','$web','$email','$tahun','$_SESSION[id_user]')");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "instansi";
  }
}
?>