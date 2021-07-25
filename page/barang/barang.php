<h5 class="h5 mb-4 text-gray-800">Data Barang</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=barang&action=add" class="btn btn-sm btn-outline-primary">Tambah</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = $conn->query("SELECT * FROM tb_barang");
          foreach ($sql as $key => $value) :

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['kode_barang']; ?></td>
              <td><?= $value['nama_barang']; ?></td>
              <?php
              $id_kategori = $value['id_kategori'];
              $kategori = $conn->query("SELECT * FROM tb_kategori WHERE id_kategori = '$id_kategori'");
              foreach ($kategori as $key => $data_kategori) {
                echo "<td>$data_kategori[kategori]</td>";
              }
              ?>

              <td><?= $value['satuan_barang']; ?></td>
              <td>
                <a href="?page=barang&action=edit&id=<?= urlencode(base64_encode($value['id_barang'])); ?>" class="btn btn-sm btn-circle btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                <a href="?page=barang&action=delete&id=<?= urlencode(base64_encode($value['id_barang'])); ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>


              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>