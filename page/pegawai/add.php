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
        <div class="form-group">
          <label for="pegawai">Nama Pegawai</label>
          <input type="text" class="form-control" id="pegawai" name="pegawai" value="<?= $_POST['pegawai']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="nip">NIP</label>
          <input type="text" class="form-control" id="nip" name="nip" value="<?= $_POST['nip']; ?>">
        </div>
        <div class="form-group">
          <label for="jabatan">Jabatan.</label>
          <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $_POST['jabatan']; ?>">
        </div>
        <div class="form-group">
          <label for="pangkat">pangkat.</label>
          <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= $_POST['pangkat']; ?>">
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