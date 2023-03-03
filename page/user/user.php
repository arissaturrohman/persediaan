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
                <!-- <a href="?page=user&action=delete&id=<?= $value['id_user']; ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a> -->


                <a href="?page=user&action=reset&id=<?= $value['id_user']; ?>" class="reset btn btn-sm btn-circle btn-warning" data-toggle="tooltip" data-placement="top" title="Reset Password"><i class="fas fa-cogs"></i></a>


                <!-- Aktivasi User -->

                <?php
                $aktif = $conn->query("SELECT * FROM tb_user WHERE id_user = '$_SESSION[id_user]'");
                $hasil = $aktif->fetch_assoc();
                if ($hasil['tgl_aktivasi'] < date("Y-m-d")) {
                  $title = "Nonaktif";
                } else {
                  $title = "Aktif";
                }
                ?>

                <a href="?page=user&action=aktif&id=<?= $value['id_user']; ?>" class=" btn btn-sm btn-circle btn-dark" data-toggle="tooltip" data-placement="top" title="<?= $title; ?>"><i class="fas fa-unlock"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>