<h5 class="h5 mb-4 text-gray-800">Data Sisa Barang</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <!-- <div class="card-header py-3">
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Vol</th>
            <th>Harga</th>
            <th>Jumlah Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // $sql = $conn->query("SELECT *
          // FROM tb_barang b
          // LEFT JOIN tb_saldo_awal sa ON b.kode_barang = sa.kode_barang AND sa.id_user = '$_SESSION[id_user]'
          // LEFT JOIN tb_pembelian p ON b.kode_barang = p.kode_barang AND p.id_user = '$_SESSION[id_user]';
          // ");
          $sql = $conn->query("SELECT b.*, sa.tanggal AS tanggal_saldo_awal, YEAR(sa.tanggal) AS tahun_saldo_awal, 
          COALESCE(sa.volume, 0) + COALESCE(p.volume, 0) AS vol,
          CASE WHEN sa.harga_satuan IS NOT NULL THEN sa.harga_satuan ELSE p.harga_satuan END AS harga_satuan,
          (COALESCE(sa.volume, 0) * sa.harga_satuan) + (COALESCE(p.volume, 0) * p.harga_satuan) AS jumlah_harga
      FROM tb_barang b
      LEFT JOIN tb_saldo_awal_detail sa ON b.kode_barang = sa.kode_barang AND sa.id_user = '$_SESSION[id_user]'
      LEFT JOIN tb_pembelian p ON b.kode_barang = p.kode_barang AND p.id_user = '$_SESSION[id_user]'
      WHERE (sa.id_user IS NOT NULL OR p.id_user IS NOT NULL) AND (YEAR(sa.tanggal) = '$_SESSION[tahun]' OR YEAR(p.tanggal) = '$_SESSION[tahun]');");

          $no = 1;
          foreach ($sql as $key => $value) :
            $jumlah_harga = $value['vol'] * $value['harga_satuan'];

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['kode_barang']; ?></td>
              <td><?= $value['nama_barang']; ?></td>
              <td><?= $value['satuan_barang']; ?></td>
              <td align="right"><?= number_format($value['vol']); ?></td>
              <td align="right"><?= number_format($value['harga_satuan']); ?></td>
              <td align="right"><?= number_format($jumlah_harga); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>