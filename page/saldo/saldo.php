<h5 class="h5 mb-4 text-gray-800">Data Saldo Awal Tahun <?= $_SESSION['tahun']; ?></h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">


  
    <a href="?page=saldo&action=add" class="btn btn-sm btn-outline-primary">Klik untuk Saldo Awal Tahun <?= date('Y'); ?></a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Jumlah Harga</th>
            <!-- <th width="8%">Opsi</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = $conn->query("SELECT * FROM tb_pembelian WHERE volume > 0 AND tahun = '$_SESSION[tahun]' AND id_user = '$_SESSION[id_user]'");

          $no = 1;
          foreach ($sql as $key => $value) :

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <?php
              $kode_barang = $value['kode_barang'];
              $barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'");
              foreach ($barang as $key => $data) {
                # code...
                echo "<td>$data[kode_barang]</td>";
                echo "<td>$data[nama_barang]</td>";
                echo "<td>$data[satuan_barang]</td>";
              }
              ?>

              <td><?= $value['volume']; ?></td>
              <td><?= number_format($value['harga_satuan']); ?></td>
              <td><?= number_format($value['jumlah_harga']); ?></td>
              <!-- <td> -->



              <!-- <a href="?page=pembelian&action=edit&id=<?= urlencode(base64_encode($value['id_pembelian'])); ?>" class="btn btn-sm btn-circle btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                <a href="?page=pembelian&action=delete&id=<?= urlencode(base64_encode($value['id_pembelian'])); ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a> -->


              <!-- </td> -->
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>