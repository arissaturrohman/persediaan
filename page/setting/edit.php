<!-- <div class="col-lg-6 offset-3"> -->

<!-- Default Card Example -->
<div class="card mb-4">
  <div class="card-header">
    Edit Data
  </div>
  <div class="card-body">
    <?php
    $id_edit = $_GET['id'];
    $sql = $conn->query("SELECT * FROM tb_setting WHERE id_setting = '$id_edit'");
    $data = $sql->fetch_assoc();
    ?>
    <form action="" method="POST">
      <input type="hidden" class="form-control" id="id_setting" name="id_setting" value="<?= $data['id_setting']; ?>">
      <div class="form-group row">
        <label for="pegawai" class="col-sm-2 col-form-label col-form-label-sm">Nama Pegawai</label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" id="pegawai" name="pegawai" value="<?= $data['nama']; ?>" autofocus>
        </div>
      </div>
      <div class="form-group row">
        <label for="nip" class="col-sm-2 col-form-label col-form-label-sm">NIP</label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" id="nip" name="nip" value="<?= $data['nip']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label for="jabatan" class="col-sm-2 col-form-label col-form-label-sm">Jabatan</label>
        <div class="col-sm-6">
          <select class="form-control form-control-sm" name="jabatan">
            <option>--Pilih--</option>
            <?php
            $jab = $data['jabatan'];
            if ($jab == 'Pengguna Barang') { ?>
              <option value="Pengguna Barang" selected>Pengguna Barang</option>
              <option value="Pengurus Barang">Pengurus Barang</option>
              <option value="Penatausaha Barang">Penatausaha Barang</option>
            <?php } elseif ($jab == 'Pengurus Barang') { ?>
              <option value="Pengguna Barang">Pengguna Barang</option>
              <option value="Pengurus Barang" selected>Pengurus Barang</option>
              <option value="Penatausaha Barang">Penatausaha Barang</option>
            <?php } elseif ($jab == 'Penatausaha Barang') { ?>
              <option value="Pengguna Barang">Pengguna Barang</option>
              <option value="Pengurus Barang">Pengurus Barang</option>
              <option value="Penatausaha Barang" selected>Penatausaha Barang</option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="pangkat" class="col-sm-2 col-form-label col-form-label-sm">Pangkat</label>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-sm" id="pangkat" name="pangkat" value="<?= $data['pangkat']; ?>">
        </div>
      </div>
      <button type="submit" name="edit" class="btn btn-sm btn-primary">Submit</button>
      <a href="setting" class="btn btn-sm btn-dark">Cancel</a>
    </form>
  </div>
</div>
<!-- </div> -->

<!-- </div> -->

<!-- Proses Simpan -->
<?php
if (isset($_POST['edit'])) {
  $id_setting = $_POST['id_setting'];
  $nama = $_POST['pegawai'];
  $nip = $_POST['nip'];
  $jabatan = $_POST['jabatan'];
  $pangkat = $_POST['pangkat'];

  $sql = $conn->query("UPDATE tb_setting SET nama = '$nama',nip = '$nip',jabatan = '$jabatan', pangkat = '$pangkat' WHERE id_setting = '$id_setting'");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil diubah";
    $_SESSION['link'] = "setting";
  }
}
?>