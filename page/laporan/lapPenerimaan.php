<h5 class="h5 mb-0 text-center text-gray-800">BUKU PENERIMAAN BARANG PERSEDIAAN</h5>
<h5 class="h5 mb-4 text-center text-gray-800">TAHUN ANGGARAN <?= $_SESSION['tahun']; ?></h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="page/cetak/lapPenerimaan.php" class="btn btn-sm btn-outline-primary float-right" target="_blank"><i class="fas fa-fw fa-print"></i> Print</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="tableLap" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="text-center align-middle" rowspan="2" width="5%">No</th>
            <th class="text-center align-middle" rowspan="2">Tanggal</th>
            <th class="text-center align-middle" rowspan="2">Nama Rekanan</th>
            <th class="text-center align-middle" colspan="2">Dokumen Pengadaan</th>
            <th class="text-center align-middle" rowspan="2">Kode Barang</th>
            <th class="text-center align-middle" rowspan="2">Satuan</th>
            <th class="text-center align-middle" rowspan="2">Volume</th>
            <th class="text-center align-middle" rowspan="2">Harga Satuan</th>
            <th class="text-center align-middle" rowspan="2">Jumlah Harga</th>
            <th class="text-center align-middle" colspan="2">Bukti Penerimaan</th>
            <th class="text-center align-middle" rowspan="2">Ket</th>
          </tr>
          <tr>
            <!-- <th></th>
            <th></th>
            <th></th> -->
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Tanggal</th>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Tanggal</th>
            <!-- <th></th> -->
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = $conn->query("SELECT * FROM tb_pembelian_detail WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]'");
          foreach ($sql as $key => $value) :
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= TanggalIndo($value['tanggal_beli']); ?></td>
              <td><?= $value['nama_rekanan']; ?></td>
              <td><?= $value['no_dokumen']; ?></td>
              <?php
              if ($value['tanggal_dokumen'] == '0000-00-00') {
                echo "<td></td>";
              } else {
              ?>
                <td><?= TanggalIndo($value['tanggal_dokumen']); ?></td>
              <?php
              }
              ?>
              <td><?= $value['kode_barang']; ?></td>
              <?php
              $kd = $value['kode_barang'];
              $namaBarang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kd'");
              $dataBarang = $namaBarang->fetch_assoc();
              ?>
              <td><?= $dataBarang['nama_barang']; ?></td>
              <td><?= $value['volume']; ?></td>
              <td><?= $value['harga_satuan']; ?></td>
              <td><?= $value['jumlah_harga']; ?></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>