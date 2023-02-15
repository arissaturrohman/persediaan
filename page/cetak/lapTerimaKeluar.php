<?php
if ($_POST) {
  echo $smt = $_POST['cetak'];

 }

include('../../inc/config.php');
include('../../inc/tgl_indo.php');
include('../../inc/romawi.php');
include('../../inc/bulan.php');
include('../../vendor/autoload.php');

ob_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Penerimaan & Pengeluaran</title>
  <link rel="shortcut icon" href="../../assets/img/logo.png" type="image/x-icon">
  <!-- <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet"> -->
  <style>
    /* table,
    th,
    td {
      border: 1px solid;
    } */

    h5,
    h4,
    h3,
    p {
      text-align: center;
    }

    .b {
      margin-bottom: auto;
    }

    .text {
      margin-top: 2px;
    }

    .isi {
      font-size: 7px;
    }
  </style>
</head>

<body>
  <table align="center">
    <tr>
      <td rowspan="4" width="10%"><img src="../../assets/img/logo.png" alt="logo" width="5%"></td>
      <td align="center">
        <h4>PEMERINTAH KABUPATEN DEMAK</h4>
        <h3>KECAMATAN GAJAH</h3>
        <p>Jl. Raya Gajah No. 45 Telp 0291-685250 Kode Pos 59581</p>
        <p>Website : https://kecgajah.demakkab.go.id - Email : office.kec.gajah@gmail.com</p>
      </td>
    </tr>
  </table>
  <hr>

  <h5 class="b">LAPORAN PENERIMAAN & PENGELUARAN BARANG </h5>
  <h5 class="text">SEMESTER
    <?php
    if ($smt <= 06) {
      echo "I (SATU)";
    } else {
      echo "II (DUA)";
    }
    ?>
    TAHUN ANGGARAN <?= $_SESSION['tahun']; ?></h5>
  <table border="1" width="100%" cellspacing="0">
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
      $sql = $conn->query("SELECT * FROM tb_pembelian_detail WHERE month(tahun) <= '$smt'");
      foreach ($sql as $key => $value) :
      ?>
        <tr>
          <?php
          if ($value['volume'] <= 0) {
            $tampil = "d-none";
          }
          ?>
          <td class="<?= $tampil; ?>"><?= $value['kode_barang']; ?></td>
          <?php
          $barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$value[kode_barang]'");
          $dataBrg = $barang->fetch_assoc();

          ?>
          <td><?= $dataBrg['nama_barang']; ?></td>
          <td><?= $dataBrg['satuan_barang']; ?></td>

          <!-- Jumlah Saldo Awal -->
          <?php
          $sqlSaldo = $conn->query("SELECT * FROM tb_saldo_awal WHERE year(tanggal) = '$_SESSION[tahun]' AND month(tanggal) <= '$smt' AND volume > 0 AND kode_barang = '$value[kode_barang]' GROUP BY kode_barang");
          $dataSaldo = $sqlSaldo->fetch_assoc();
          $saldo = $dataSaldo['volume'];
          $harga = $dataSaldo['jumlah_harga'];
          ?>
          <td align="right"><?= $saldo; ?></td>
          <td align="right"><?= number_format($harga); ?></td>

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
          <td>-</td>
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
        <th colspan="2"></th>
      </tr>
    </tbody>
  </table>
  <br>
  <table align="center">
    <tr>
      <td align="center">Mengetahui,</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <?php 
      if ($smt <= 06) {
        $tgl = "30 Juni ";
      } else {
        $tgl = "31 Desember ";
      }
      ?>
      <td align="center">Demak, <?= $tgl. $_SESSION['tahun']; ?></td>
    </tr>
    <?php
    $camat = $conn->query("SELECT * FROM tb_pegawai WHERE jabatan = 'Camat'");
    $dataPegawai = $camat->fetch_assoc();
    ?>
    <?php
    $pengurus = $conn->query("SELECT * FROM tb_pegawai WHERE jabatan = 'Pengurus Barang'");
    $dataPegawai1 = $pengurus->fetch_assoc();
    ?>
    <tr>
      <td align="center">Pengguna Barang</td>
      <td width="60%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td align="center">Pengurus Barang</td>
    </tr>
    <tr>
      <td height="50%">&nbsp; </td>
    </tr>
    <tr>
      <td height="50%">&nbsp; </td>
    </tr>
    <tr>
      <td height="50%">&nbsp; </td>
    </tr>

    <tr>
      <td align="center" width="20%"><b><u><?= $dataPegawai['nama_pegawai']; ?></u></b></td>
      <td width="60%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td align="center"><b><u><?= $dataPegawai1['nama_pegawai']; ?></u></b></td>
    </tr>
    <tr>
      <td align="center"><?= "NIP. " . $dataPegawai['nip']; ?></td>
      <td width="60%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td align="center"><?= "NIP. " . $dataPegawai1['nip']; ?></td>
    </tr>
  </table>
</body>

</html>

<?php

//Meload library mPDF
// require 'vendor/autoload.php';

//Membuat inisialisasi objek mPDF
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal', 'margin_top' => 15, 'margin_bottom' => 25, 'margin_left' => 15, 'margin_right' => 15]);

$mpdf->AddPage('L');

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

//Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->OutputHttpInline("Laporan Pengeluaran.pdf", "I");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>