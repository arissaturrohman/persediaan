<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Edit Data Instansi
    </div>
    <div class="card-body">
      <?php
      $id_edit = base64_decode(urldecode($_GET['id']));
      $sql = $conn->query("SELECT * FROM tb_instansi WHERE id_instansi = '$id_edit'");
      $data = $sql->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" class="form-control" id="id_instansi" name="id_instansi" value="<?= $data['id_instansi']; ?>">
        <div class="form-group">
          <label for="instansi">Nama Instansi</label>
          <input type="text" class="form-control" id="instansi" name="instansi" value="<?= $data['nama_instansi']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat_instansi']; ?>">
        </div>
        <div class="form-group">
          <label for="telp">No Telp.</label>
          <input type="text" class="form-control" id="telp" name="telp" value="<?= $data['no_telp']; ?>">
        </div>
        <button type="submit" name="edit" class="btn btn-sm btn-primary">Submit</button>
        <a href="instansi" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['edit'])) {
  $id = $_POST['id_instansi'];
  $instansi = $_POST['instansi'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];

  $sql = $conn->query("UPDATE tb_instansi SET nama_instansi = '$instansi', alamat_instansi = '$alamat' ,no_telp = '$telp' WHERE id_instansi = '$id'");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil diubah";
    $_SESSION['link'] = "instansi";
  }
}
?>