<h5 class="h5 mb-4 text-gray-800">Data Pengadaan</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=pengeluaran&action=add" class="btn btn-sm btn-outline-primary">Tambah</a>
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
            <th>Penanggungjawab</th>
            <th>No SPB</th>
            <th>Tanggal SPB</th>
            <th width="8%">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = $conn->query("SELECT * FROM tb_pengeluaran");
          foreach ($sql as $key => $value) :

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <?php
              $kode_barang = $value['kode_barang'];
              $barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'");
              foreach ($barang as $key => $data) {                # code...
                echo "<td>$data[kode_barang]</td>";
                echo "<td>$data[nama_barang]</td>";
                echo "<td>$data[satuan_barang]</td>";
              }
              ?>

              <td><?= $value['volume']; ?></td>
              <td><?= number_format($value['harga_satuan']); ?></td>
              <td><?= number_format($value['jumlah_harga']); ?></td>
              <?php
              $id_pegawai = $value['penanggungjawab'];
              $pegawai = $conn->query("SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_pegawai'");
              foreach ($pegawai as $key => $data) {
                echo "<td>$data[nama_pegawai]</td>";
              }
              ?>
              <td><?= $value['no_spb']; ?></td>
              <td><?= TanggalIndo($value['tanggal_spb']); ?></td>
              <td>



                <a href="?page=pengeluaran&action=edit&id=<?= urlencode(base64_encode($value['id_pengeluaran'])); ?>" class="btn btn-sm btn-circle btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                <a href="?page=pengeluaran&action=delete&id=<?= urlencode(base64_encode($value['id_pengeluaran'])); ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>


              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>