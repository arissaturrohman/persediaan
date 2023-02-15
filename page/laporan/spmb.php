<div class="card shadow mb-4 col-6">
  <div class="card-body">
    <form action="" method="GET">
      <div class="form-row mb-3">
        <div class="col">
          <select class="form-control form-control-sm" id="spmb" name="spmb">
            <option>Pilih No SPB</option>
            <?php
            $noSpb = $conn->query("SELECT * FROM tb_pengeluaran_detail GROUP BY no_spb");
            while ($dataSpb = $noSpb->fetch_assoc()) {

            ?>
              <option value="<?= $dataSpb['no_spb']; ?>"><?= $dataSpb['no_spb']; ?></option>

            <?php
            }
            ?>
          </select>
        </div>
        <div class="col">
          <select class="form-control form-control-sm" id="smt" name="smt">
            <option selected>Semester</option>
            <option value="1">1 (Satu)</option>
            <option value="2">2 (Dua)</option>
          </select>
        </div>
      </div>
      <div class="form-group float-right">
        <button type="submit" name="pilih" class="btn btn-sm btn-info ">Pilih</button>
        <a href="spmb" class="btn btn-sm btn-dark ">Reset</a>
      </div>
    </form>
  </div>
</div>

<?php
if (isset($_GET['pilih'])) {
  $smt = $_GET['smt'];
  $spmb = $_GET['spmb'];
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
      <!-- Example single danger button -->
      <div class="btn-group float-right">
        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-fw fa-print"></i> Print
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="">
            <form action="page/cetak/spmb.php" method="POST" target="_blank">
              <input type="hidden" name="smt" value="<?= $smt; ?>">
              <input type="hidden" name="spmb" value="<?= $spmb; ?>">
              <button type="submit" name="submit" class="btn btn-link">SPmB</button>
            </form>            
          </a>
          <a class="dropdown-item" href="#">
          <form action="page/cetak/sppb.php" method="POST" target="_blank">
              <input type="hidden" name="smt" value="<?= $smt; ?>">
              <input type="hidden" name="spmb" value="<?= $spmb; ?>">
              <button type="submit" name="submit" class="btn btn-link">SPPB</button>
            </form> 
          </a>
          <a class="dropdown-item" href="#">
          <form action="page/cetak/bbKeluar.php" method="POST" target="_blank">
              <input type="hidden" name="smt" value="<?= $smt; ?>">
              <input type="hidden" name="spmb" value="<?= $spmb; ?>">
              <button type="submit" name="submit" class="btn btn-link">BB Keluar</button>
            </form> 
          </a>
          <a class="dropdown-item" href="#">
          <form action="page/cetak/bast.php" method="POST" target="_blank">
              <input type="hidden" name="smt" value="<?= $smt; ?>">
              <input type="hidden" name="spmb" value="<?= $spmb; ?>">
              <button type="submit" name="submit" class="btn btn-link">BAST</button>
            </form> 
          </a>
        </div>
      </div>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="tableLap" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center align-middle">No</th>
              <th class="text-center align-middle">Kode Brg</th>
              <th class="text-center align-middle">Nama Brg</th>
              <th class="text-center align-middle">Satuan</th>
              <th class="text-center align-middle">Volume</th>
              <th class="text-center align-middle">Harga</th>
              <th class="text-center align-middle">Jumlah Harga</th>
              <th class="text-center align-middle">Ket</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $sql = $conn->query("SELECT * FROM tb_pengeluaran_detail WHERE year(tahun) = '$_SESSION[tahun]' AND no_spb = '$spmb'");
            foreach ($sql as $key => $value) :
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $value['kode_barang']; ?></td>
                <?php
                $barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$value[kode_barang]'");
                $dataBrg = $barang->fetch_assoc();

                ?>
                <td><?= $dataBrg['nama_barang']; ?></td>
                <td><?= $dataBrg['satuan_barang']; ?></td>
                <td class="text-right"><?= $value['volume']; ?></td>
                <td class="text-right"><?= number_format($value['harga_satuan']); ?></td>
                <td class="text-right"><?= number_format($value['jumlah_harga']); ?></td>
                <td><?= $value['ket']; ?></td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <th class="text-right" colspan="6">JUMLAH</th>
              <th class="text-right" class="2">
                <?php
                $hitungKeluar = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pengeluaran_detail WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]' GROUP BY no_spb");
                $dataHitungKeluar = $hitungKeluar->fetch_assoc();
                echo $sisaKeluar = $dataHitungKeluar['total'];
                ?>

              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php } ?>