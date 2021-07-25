<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Edit Data Pegawai
    </div>
    <div class="card-body">
      <?php
      $id_edit = base64_decode(urldecode($_GET['id']));
      $sql = $conn->query("SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_edit'");
      $data = $sql->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" class="form-control" id="id_pegawai" name="id_pegawai" value="<?= $data['id_pegawai']; ?>">
        <div class="form-group">
          <label for="pegawai">Nama Pegawai</label>
          <input type="text" class="form-control" id="pegawai" name="pegawai" value="<?= $data['nama_pegawai']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="nip">NIP</label>
          <input type="text" class="form-control" id="nip" name="nip" value="<?= $data['nip']; ?>">
        </div>
        <div class="form-group">
          <label for="jabatan">Jabatan.</label>
          <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $data['jabatan']; ?>">
        </div>
        <div class="form-group">
          <label for="pangkat">pangkat.</label>
          <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= $data['pangkat']; ?>">
        </div>
        <button type="submit" name="edit" class="btn btn-sm btn-primary">Submit</button>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['edit'])) {
  $id_pegawai = $_POST['id_pegawai'];
  $nama_pegawai = $_POST['pegawai'];
  $nip = $_POST['nip'];
  $jabatan = $_POST['jabatan'];
  $pangkat = $_POST['pangkat'];

  $sql = $conn->query("UPDATE tb_pegawai SET nama_pegawai = '$nama_pegawai',nip = '$nip',jabatan = '$jabatan', pangkat = '$pangkat' WHERE id_pegawai = '$id_pegawai'");

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