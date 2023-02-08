<h5 class="h5 mb-0 text-center text-gray-800">BUKU PENGELUARAN BARANG PERSEDIAAN</h5>
<h5 class="h5 mb-4 text-center text-gray-800">TAHUN ANGGARAN <?= $_SESSION['tahun']; ?></h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="page/cetak/lapPengeluaran.php" class="btn btn-sm btn-outline-primary float-right" target="_blank"><i class="fas fa-fw fa-print"></i> Print</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="tableLap" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="text-center align-middle" rowspan="2" width="5%">No</th>
            <th class="text-center align-middle" rowspan="2">Tanggal</th>
            <th class="text-center align-middle" colspan="2">Surat Permintaan Brg</th>
            <th class="text-center align-middle" rowspan="2">Penanggungjawab</th>
            <th class="text-center align-middle" rowspan="2">Kode Barang</th>
            <th class="text-center align-middle" rowspan="2">Nama Barang</th>
            <th class="text-center align-middle" rowspan="2">Satuan</th>
            <th class="text-center align-middle" rowspan="2">Volume</th>
            <th class="text-center align-middle" rowspan="2">Harga Satuan</th>
            <th class="text-center align-middle" rowspan="2">Jumlah Harga</th>
            <th class="text-center align-middle" rowspan="2">Tanggal Penyerahan</th>
            <th class="text-center align-middle" rowspan="2">Nama Pengambil Brg</th>
            <th class="text-center align-middle" rowspan="2">Ket</th>
          </tr>
          <tr>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = $conn->query("SELECT * FROM tb_pengeluaran_detail WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]'");
          foreach ($sql as $key => $value) :
          ?>
            <tr>
              <td align="center"><?= $no++; ?></td>
              <td><?= TanggalIndo($value['tanggal_spb']); ?></td>
              <td><?= "0" . $value['no_spb'] . " / SPB / " . BulanRomawi($value['tanggal_spb']) ?></td>
              <td><?= TanggalIndo($value['tanggal_spb']); ?></td>
              <?php
              $p = $value['penanggungjawab'];
              $sqlPegawai = $conn->query("SELECT * FROM tb_pegawai WHERE id_pegawai = '$p'");
              $dataNamaPegawai = $sqlPegawai->fetch_assoc();
              echo "<td>$dataNamaPegawai[nama_pegawai]</td>";
              ?>
              <td><?= $value['kode_barang']; ?></td>
              <?php
              $kd = $value['kode_barang'];
              $namaBarang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kd'");
              $dataBarang = $namaBarang->fetch_assoc();
              ?>
              <td><?= $dataBarang['nama_barang']; ?></td>
              <td><?= $value['volume']; ?></td>
              <td><?= $dataBarang['satuan_barang']; ?></td>
              <td><?= number_format($value['harga_satuan']); ?></td>
              <td><?= number_format($value['jumlah_harga']); ?></td>
              <td><?= TanggalIndo($value['tanggal_spb']); ?></td>
              <td></td>
              <td><?= $value['ket']; ?></td>
            </tr>
          <?php endforeach; ?>
          <?php
          $hitung = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pengeluaran_detail WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]'");
          $dataHitung = $hitung->fetch_assoc();
          ?>
          <tr>
            <th colspan="10" align="center">JUMLAH</th>
            <th><?= number_format($dataHitung['total']); ?></th>
            <th colspan="3"></th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>