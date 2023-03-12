<h5 class="h5 mb-4 text-gray-800">Setting</h5>

<div class="col">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <!-- <div class="card-header">
      Add Data Pegawai
    </div> -->
    <div class="card-body">
      <?php
      $instansi = $conn->query("SELECT * FROM tb_instansi WHERE id_user = '$_SESSION[id_user]'");
      $data = $instansi->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" name="id_instansi" value="<?= $data['id_instansi']; ?>">
        <div class="form-group row">
          <label for="pegawai" class="col-sm-2 col-form-label col-form-label-sm">Nama Pegawai</label>
          <div class="col-sm-6">
          <select class="form-control form-control-sm" name="pegawai">
              <option>--Pilih--</option>
              <?php 
              $sql = $conn->query("SELECT * FROM tb_pegawai");
              while($dataSql = $sql->fetch_assoc()) :
              ?>
              <option value="<?= $dataSql['id_pegawai']; ?>"><?= $dataSql['nama_pegawai']; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="nip" class="col-sm-2 col-form-label col-form-label-sm">NIP</label>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" id="nip" name="nip" value="<?= $_POST['nip']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="jabatan" class="col-sm-2 col-form-label col-form-label-sm">Jabatan</label>
          <div class="col-sm-6">
            <select class="form-control form-control-sm" name="jabatan">
              <option>--Pilih--</option>
              <option value="Pengguna Barang">Pengguna Barang</option>
              <option value="Pengurus Barang">Pengurus Barang</option>
              <option value="Penatausaha Barang">Penatausaha Barang</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="pangkat" class="col-sm-2 col-form-label col-form-label-sm">Pangkat</label>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" id="pangkat" name="pangkat" value="<?= $_POST['pangkat']; ?>">
          </div>
        </div>
        <div class="form-group  row">
          <div class="col-sm-6 offset-6">
            <a href="./" class="btn btn-sm btn-dark mx-1 ">Cancel</a>
            <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
          </div>
        </div>
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

  $sql = $conn->query("INSERT INTO tb_setting (id_instansi, id_user, nama,nip,jabatan, pangkat) VALUES ('$instansi','$_SESSION[id_user]','$nama_pegawai','$nip','$jabatan','$pangkat')");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "setting";
  }
}
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <!-- <div class="card-header py-3">
    <a href="?page=pegawai&action=add" class="btn btn-sm btn-outline-primary">Tambah</a>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Instansi</th>
            <th>Nama Pegawai</th>
            <th>NIP</th>
            <th>Jabatan</th>
            <th>Pangkat</th>
            <th width="8%">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = $conn->query("SELECT * FROM tb_setting WHERE id_user = '$_SESSION[id_user]'");

          foreach ($sql as $key => $value) :

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <?php
              $id_instansi = $value['id_instansi'];
              $instansi = $conn->query("SELECT * FROM tb_instansi WHERE id_instansi = '$id_instansi'");
              foreach ($instansi as $key => $data) {
                # code...
                echo "<td>$data[nama_instansi]</td>";
              }
              ?>

              <td><?= $value['nama']; ?></td>
              <td><?= $value['nip']; ?></td>
              <td><?= $value['jabatan']; ?></td>
              <td><?= $value['pangkat']; ?></td>
              <td>



                <a href="?page=setting&action=edit&id=<?= $value['id_setting']; ?>" class="btn btn-sm btn-circle btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                <a href="?page=setting&action=delete&id=<?= $value['id_setting']; ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>


              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>