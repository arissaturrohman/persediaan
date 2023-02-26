<h5 class="h5 mb-4 text-gray-800">Data User</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=user&action=add" class="btn btn-sm btn-outline-primary">Tambah</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Level</th>
            <th width="20%">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $no = 1;
          $sql = $conn->query("SELECT * FROM tb_user");
          foreach ($sql as $key => $value) :

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['nama_user']; ?></td>
              <td><?= $value['username']; ?></td>
              <td><?= $value['level']; ?></td>
              <td>
                <a href="?page=user&action=edit&id=<?= $value['id_user']; ?>" class="btn btn-sm btn-circle btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                <a href="?page=user&action=delete&id=<?= $value['id_user']; ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>
                <a href="?page=user&action=gantiPass&id=<?= $value['id_user']; ?>" class=" btn btn-sm btn-circle btn-warning" data-toggle="tooltip" data-placement="top" title="Ganti Password"><i class="fas fa-cogs"></i></a>
                <form action="?page=user&action=gantiPass&id=<?= $value['id_user']; ?>" method="post">
                <input type="text" value="status">
                  <button type="submit" name="kirim" class=" btn btn-sm btn-circle btn-dark" data-toggle="tooltip" data-placement="top" title="Aktif/Nonaktif"><i class="fas fa-unlock"></i></button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>