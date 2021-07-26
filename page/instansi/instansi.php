<h5 class="h5 mb-4 text-gray-800">Data Instansi</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=instansi&action=add" class="btn btn-sm btn-outline-primary">Tambah</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th  width="5%">No</th>
            <th>Nama Instansi</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th  width="8%">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($_SESSION['level'] == "admin") {
            $sql = $conn->query("SELECT * FROM tb_instansi");
          } else {
            $sql = $conn->query("SELECT * FROM tb_instansi WHERE id_user = '$_SESSION[id_user]'");
          }
          $no = 1;
          foreach ($sql as $key => $value) :

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['nama_instansi']; ?></td>
              <td><?= $value['alamat_instansi']; ?></td>
              <td><?= $value['no_telp']; ?></td>
              <td>
                <a href="?page=instansi&action=edit&id=<?= urlencode(base64_encode($value['id_instansi'])); ?>" class="btn btn-sm btn-circle btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                <a href="?page=instansi&action=delete&id=<?= urlencode(base64_encode($value['id_instansi'])); ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>


              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>