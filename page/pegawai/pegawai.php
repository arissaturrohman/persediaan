<h5 class="h5 mb-4 text-gray-800">Data Instansi</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=pegawai&action=add" class="btn btn-sm btn-outline-primary">Tambah</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Instansi</th>
            <th>Nama Pegawai</th>
            <th>NIP</th>
            <th>Jabatan</th>
            <th>Pangkat</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($_SESSION['level'] == "admin") {
            $sql = $conn->query("SELECT * FROM tb_pegawai");
          } else {
            $sql = $conn->query("SELECT * FROM tb_pegawai WHERE id_user = '$_SESSION[id_user]'");
          }
          $no = 1;
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

              <td><?= $value['nama_pegawai']; ?></td>
              <td><?= $value['nip']; ?></td>
              <td><?= $value['jabatan']; ?></td>
              <td><?= $value['pangkat']; ?></td>
              <td>



                <a href="?page=pegawai&action=edit&id=<?= urlencode(base64_encode($value['id_pegawai'])); ?>" class="btn btn-sm btn-circle btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                <a href="?page=pegawai&action=delete&id=<?= urlencode(base64_encode($value['id_pegawai'])); ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>


              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>