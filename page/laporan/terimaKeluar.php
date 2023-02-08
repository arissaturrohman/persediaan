<div class="card shadow mb-4 col-6">
  <div class="card-body">
    <form action="" method="get">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Semester</label>
        <div class="col-sm-9">
          <select class="form-control form-control-sm" name="smt">
            <option></option>
            <option value="06">I (Satu)</option>
            <option value="12">II (Dua)</option>
          </select>
        </div>
      </div>
      <div class="form-group float-right">
        <button type="submit" name="pilih" class="btn btn-sm btn-info ">Pilih</button>
        <a href="terimaKeluar" class="btn btn-sm btn-dark ">Reset</a>
      </div>
    </form>
  </div>
</div>

<?php
if (isset($_GET['pilih'])) {
  $smt = $_GET['smt'];
?>
  <hr>
  <h5 class="h5 mb-0 text-center text-gray-800">LAPORAN PENERIMAAN DAN PENGELUARAN BARANG</h5>
  <h5 class="h5 mb-4 text-center text-gray-800">SEMESTER
    <?php
    // $smt = date('m');
    if ($smt <= 06) {
      echo "I (SATU)";
    } else {
      echo "II (DUA)";
    }
    ?>
    TAHUN ANGGARAN <?= $_SESSION['tahun']; ?></h5>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="page/cetak/lapTerimaKeluar.php&pilih=<?= $smt; ?>" class="btn btn-sm btn-outline-primary float-right" target="_blank"><i class="fas fa-fw fa-print"></i> Print</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tableLap" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center align-middle" rowspan="2">Kode Brg</th>
              <th class="text-center align-middle" rowspan="2">Nama Brg</th>
              <th class="text-center align-middle" rowspan="2">Satuan</th>
              <th class="text-center align-middle" colspan="2">Jml Saldo Awal</th>
              <th class="text-center align-middle" colspan="3">Jumlah Brg</th>
              <th class="text-center align-middle" colspan="3">Jumlah Harga</th>
              <th class="text-center align-middle" rowspan="2">Ket</th>
            </tr>
            <tr>
              <th class="text-center align-middle">Jml Brg</th>
              <th class="text-center align-middle">Jml Harga</th>
              <th class="text-center align-middle">Masuk</th>
              <th class="text-center align-middle">Keluar</th>
              <th class="text-center align-middle">Sisa</th>
              <th class="text-center align-middle">Bertambah</th>
              <th class="text-center align-middle">Berkurang</th>
              <th class="text-center align-middle">Saldo</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $sql = $conn->query("SELECT * FROM tb_barang");
            foreach ($sql as $key => $value) :
            ?>
              <tr>
                <td><?= $value['kode_barang']; ?></td>
                <td><?= $value['nama_barang']; ?></td>
                <td><?= $value['satuan_barang']; ?></td>

                <!-- Jumlah Saldo Awal -->
                <?php
                $sqlSaldo = $conn->query("SELECT * FROM tb_saldo_awal WHERE year(tanggal) = '$_SESSION[tahun]' AND month(tanggal) <= '$smt' AND volume > 0 AND kode_barang = '$value[kode_barang]' GROUP BY kode_barang");
                $dataSaldo = $sqlSaldo->fetch_assoc();
                $saldo = $dataSaldo['volume'];
                ?>
                <td align="right"><?= $dataSaldo['volume']; ?></td>
                <td align="right"><?= number_format($dataSaldo['jumlah_harga']); ?></td>

                <?php
                $sqlTerima = $conn->query("SELECT * FROM tb_pembelian_detail WHERE year(tahun) = '$_SESSION[tahun]' AND month(tahun) <= '$smt' AND volume > 0 AND kode_barang = '$value[kode_barang]'  GROUP BY kode_barang");
                $dataTerima = $sqlTerima->fetch_assoc();
                $terima = $dataTerima['volume'];
                echo "<td align='right'>$dataTerima[volume]</td>";

                ?>
                <?php
                $sqlKeluar = $conn->query("SELECT * FROM tb_pengeluaran_detail WHERE year(tahun) = '$_SESSION[tahun]' AND month(tahun) <= '$smt' AND volume > 0 AND kode_barang = '$value[kode_barang]'  GROUP BY kode_barang");
                $dataKeluar = $sqlKeluar->fetch_assoc();
                $keluar = $dataKeluar['volume'];
                echo "<td align='right'>$dataKeluar[volume]</td>";
                ?>
                <?php
                $sisaBrg = ($terima + $saldo) - $keluar;
                echo "<td align='right'>$sisaBrg</td>";
                ?>
                <?php
                $hitungSaldo = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_saldo_awal_detail WHERE id_user = '$_SESSION[id_user]' AND year(tanggal) = '$_SESSION[tahun]' AND month(tanggal) <= '$smt' AND volume > 0 AND kode_barang = '$value[kode_barang]'");
                $dataHitungSaldo = $hitungSaldo->fetch_assoc();
                $sisaSaldo = $dataHitungSaldo['total'];
                ?>
                <?php
                $hitungTerima = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pembelian_detail WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]'  AND month(tahun) <= '$smt' AND volume > 0 AND kode_barang = '$value[kode_barang]'");
                $dataHitungTerima = $hitungTerima->fetch_assoc();
                $sisaTerima = $dataHitungTerima['total'];
                ?>
                <?php
                $hitungKeluar = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pengeluaran_detail WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]' AND month(tahun) <= '$smt' AND volume > 0 AND kode_barang = '$value[kode_barang]'");
                $dataHitungKeluar = $hitungKeluar->fetch_assoc();
                $sisaKeluar = $dataHitungKeluar['total'];
                ?>
                <?php
                $bertambah = $sisaSaldo + $sisaTerima;
                $berkurang = $sisaKeluar;
                $sisaHarga = ($sisaSaldo + $sisaTerima) - $sisaKeluar;
                echo "<td align='right'>" . number_format($bertambah) . "</td>";
                echo "<td align='right'>" . number_format($berkurang) . "</td>";
                echo "<td align='right'>" . number_format($sisaHarga) . "</td>";
                ?>
                <td><?= $value['ket']; ?></td>
              </tr>
              <?php
              $array[] = [$sisaHarga][0];
              ?>
            <?php endforeach; ?>
            <?php
            $total = array_sum($array);
            ?>
            <tr>
              <th colspan="10" align="right">JUMLAH</th>
              <th align="right"><?= number_format($total); ?></th>
              <th colspan="3"></th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php } ?>