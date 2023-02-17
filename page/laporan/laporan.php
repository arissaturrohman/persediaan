<div class="card shadow mb-4 col-6">
  <div class="card-body">
    <form action="" method="POST" target="_blank">
      <div class="form-row mb-3">
        <div class="col">
          <select onChange="coba(this)" class="form-control form-control-sm" id="jenis" name="jenis">
            <option value="0">Jenis Laporan</option>
            <option value="1">Penerimaan</option>
            <option value="2">Pengeluaran</option>
            <option value="3">Laporan Barang</option>
            <option value="4">SPmB</option>
            <option value="5">SPPB</option>
            <option value="6">BB Keluar</option>
            <option value="7">BAST</option>
            <option value="8">Kartu Barang</option>
            <option value="9">Kartu Persediaan</option>
            <option value="10">Rekap Persediaan</option>
            <option value="11">Stock Opname</option>
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
      <div class="form-row mb-3">
        <div class="col">
          <select class="form-control form-control-sm mb-2" id="spmb" name="spmb">
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
          <select class="form-control form-control-sm" id="brg" name="brg">
            <option selected>Pilih Barang</option>
            <?php
            $brg = $conn->query("SELECT * FROM tb_barang");
            while ($dataBrg = $brg->fetch_assoc()) {

            ?>
              <option value="<?= $dataBrg['kode_barang']; ?>"><?= $dataBrg['nama_barang']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-row float-right">
        <button type="submit" name="pilih" id="jajal" class="btn btn-sm btn-info ">Pilih</button>
      </div>
  </div>
  </form>
</div>


<!-- Urutan Jenis

1. Penerimaan
2. Pengeluaran
3. Laporan Barang
4. SPmB
5. SPPB
6. BB Keluar
7. BAST
8. Kartu Barang
9. Kartu Persediaan
10. Rekap Persediaan
11. Stock Opname
-->


<?php
if (isset($_POST['pilih'])) {
  $jenis = $_POST['jenis'];
  $smt = $_POST['smt'];
  $spmb = $_POST['spmb'];
  $brg = $_POST['brg'];

  if ($jenis == 1) {
    $_SESSION['smt'] = $smt;
    $_SESSION['spmb'] = $spmb;
    header('location: page/cetak/laPenerimaan.php');
  }
  if ($jenis == 2) {
    $_SESSION['smt'] = $smt;
    $_SESSION['spmb'] = $spmb;
    header('location: page/cetak/laPengeluaran.php');
  }
  if ($jenis == 3) {
    $_SESSION['smt'] = $smt;
    $_SESSION['spmb'] = $spmb;
    header('location: page/cetak/laTerimaKeluar.php');
  }
  if ($jenis == 4) {
    $_SESSION['spmb'] = $spmb;
    header('location: page/cetak/spmb.php');
  }
  if ($jenis == 5) {
    $_SESSION['spmb'] = $spmb;
    header('location: page/cetak/sppb.php');
  }
  if ($jenis == 6) {
    $_SESSION['spmb'] = $spmb;
    header('location: page/cetak/bbKeluar.php');
  }
  if ($jenis == 7) {
    $_SESSION['spmb'] = $spmb;
    header('location: page/cetak/bast.php');
  }
  if ($jenis == 8) {
    $_SESSION['smt'] = $smt;
    $_SESSION['brg'] = $brg;
    header('location: page/cetak/kartuBarang.php');
  }
  if ($jenis == 9) {
    $_SESSION['smt'] = $smt;
    $_SESSION['brg'] = $brg;
    header('location: page/cetak/kartuPersediaan.php');
  }
  if ($jenis == 10) {
    $_SESSION['smt'] = $smt;
    header('location: page/cetak/rekapPersediaan.php');
  }
  if ($jenis == 11) {
    $_SESSION['smt'] = $smt;
    header('location: page/cetak/stockOpname.php');
  }
}
?>

<!-- Urutan Jenis

1. Penerimaan
2. Pengeluaran
3. Laporan Barang
4. SPmB
5. SPPB
6. BB Keluar
7. BAST
8. Kartu Barang
9. Kartu Persediaan
10. Rekap Persediaan
11. Stock Opname
-->

<script>
  function coba(pilihan) {
    if (pilihan.value == 1) {
      document.getElementById('smt').disabled = false;
      document.getElementById('spmb').disabled = true;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 2) {
      document.getElementById('smt').disabled = false;
      document.getElementById('spmb').disabled = true;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 3) {
      document.getElementById('smt').disabled = false;
      document.getElementById('spmb').disabled = true;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 4) {
      document.getElementById('smt').disabled = true;
      document.getElementById('spmb').disabled = false;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 5) {
      document.getElementById('smt').disabled = true;
      document.getElementById('spmb').disabled = false;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 6) {
      document.getElementById('smt').disabled = true;
      document.getElementById('spmb').disabled = false;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 7) {
      document.getElementById('smt').disabled = true;
      document.getElementById('spmb').disabled = false;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 8) {
      document.getElementById('smt').disabled = false;
      document.getElementById('spmb').disabled = true;
      document.getElementById('brg').disabled = false;
    }
    if (pilihan.value == 9) {
      document.getElementById('smt').disabled = false;
      document.getElementById('spmb').disabled = true;
      document.getElementById('brg').disabled = false;
    }
    if (pilihan.value == 10) {
      document.getElementById('smt').disabled = false;
      document.getElementById('spmb').disabled = true;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 11) {
      document.getElementById('smt').disabled = false;
      document.getElementById('spmb').disabled = true;
      document.getElementById('brg').disabled = true;
    }
    if (pilihan.value == 0) {
      document.getElementById('smt').disabled = false;
      document.getElementById('spmb').disabled = false;
      document.getElementById('brg').disabled = false;
    }
  }
</script>