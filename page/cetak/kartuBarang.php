<?php

session_start();
// $jenis = $_SESSION['jenis'];
$smt = $_SESSION['smt'];
$brg = $_SESSION['brg'];

include('../../inc/config.php');
include('../../inc/tgl_indo.php');
include('../../inc/terbilang.php');
include('../../inc/hariIndo.php');
include('../../inc/romawi.php');
include('../../inc/bulan.php');
include('../../vendor/autoload.php');

ob_start();

$opd = $conn->query("SELECT * FROM tb_instansi WHERE id_user = '$_SESSION[id_user]'");
$dataOpd = $opd->fetch_assoc();
$setting = $conn->query("SELECT * FROM tb_setting WHERE id_user = '$_SESSION[id_user]' AND jabatan = 'Pengurus Barang'");
$dataSet = $setting->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KARTU BARANG</title>
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

    .upper {
      text-transform: uppercase;
    }
  </style>
</head>

<body>
  <table align="center">
    <tr>
      <td align="left" rowspan="4" width="10%"><img src="../../assets/img/logo.png" alt="logo" width="8%"></td>
      <td align="center">
        <h4>PEMERINTAH KABUPATEN DEMAK</h4>
        <h3 class="upper"><?= $dataOpd['nama_instansi']; ?></h3>
        <p><?= $dataOpd['alamat_instansi'] . " Telp. " . $dataOpd['no_telp'] . " Kode Pos " . $dataOpd['kd_pos']; ?></p>
        <p>Website : <?= $dataOpd['website']; ?> - Email : <?= $dataOpd['email']; ?></p>
      </td>
    </tr>
  </table>
  <hr>
  <h5 class="b">KARTU BARANG </h5>
  <h5 class="text">SEMESTER
    <?php
    if ($smt <= 06) {
      echo "I (SATU)";
    } else {
      echo "II (DUA)";
    }
    ?>
    TAHUN ANGGARAN <?= $_SESSION['tahun']; ?></h5>
  <table>
    <tr>
      <td>Kode Barang</td>
      <td>:</td>
      <td><?= $brg; ?></td>
    </tr>
    <tr>
      <td>Nama Barang</td>
      <td>:</td>
      <td>HVS</td>
    </tr>
    <tr>
      <td>Satuan</td>
      <td>:</td>
      <td>Rim</td>
    </tr>
  </table>
  <br>
  <table border="1" width="100%" cellspacing="0">
    <thead height="5%">
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Masuk</th>
        <th>Keluar</th>
        <th>Sisa</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $querySaldo = $conn->query("SELECT * FROM tb_saldo_awal WHERE kode_barang = '$brg'");
      $dataTrx = $querySaldo->fetch_assoc();
      if ($dataTrx != null) {
        $saldoAwal = $dataTrx['volume'];
        $tanggalAwal = $dataTrx['tanggal'];
      } else {
        $saldoAwal = 0;
        $tanggalAwal = '';
      }
      echo '
      <tr>
      <td>1</td>
      <td>' . $tanggalAwal . '</td>
      <td align="right">' . $saldoAwal . '</td>
      <td></td>
      <td  align="right">' . $saldoAwal . '</td>
      <td>Saldo Awal</td>
      </tr>
      ';


      $no = 2;
      $queryTrx = $conn->query("SELECT bb.* FROM ( SELECT a.kode_barang, a.volume AS masuk, '' AS keluar, a.regdate,a.tanggal FROM tb_pembelian_detail a UNION SELECT b.kode_barang, '' AS masuk, b.volume AS keluar, b.regdate,b.tanggal FROM tb_pengeluaran_detail b ) AS bb WHERE bb.kode_barang = '" . $brg . "' AND month(bb.tanggal) <= '" . $smt . "' ORDER BY bb.tanggal ASC;");
      foreach ($queryTrx as $key => $value) {
        $saldoAwal = $saldoAwal + $value['masuk'] - $value['keluar'];

      ?>
        <tr>
          <td><?= $no; ?></td>
          <td><?= date("d-m-Y", strtotime($value['tanggal'])); ?></td>
          <td  align="right"><?= $value['masuk']; ?></td>
          <td  align="right"><?= $value['keluar']; ?></td>
          <td  align="right"><?= $saldoAwal; ?></td>
          <td> -</td>
        </tr>

      <?php
        $no++;
      }
      ?>

    </tbody>
  </table>
  <table align="center">
    <tr>
      <td align="center">Mengetahui,</td>
      <td></td>
      <td></td>
      <td align="center">Demak,
        <?php
        if ($smt <= 06) {
          echo "30 Juni " . date('Y');
        } else {
          echo "31 Desember " . date('Y');
        }
        ?>
      </td>
    </tr>
    <?php
    $pengguna = $conn->query("SELECT * FROM tb_setting WHERE jabatan = 'Pengguna Barang' AND id_user = '$_SESSION[id_user]'");
    $dataPengguna = $pengguna->fetch_assoc();
    $pengurus = $conn->query("SELECT * FROM tb_setting WHERE jabatan = 'Pengurus Barang' AND id_user = '$_SESSION[id_user]'");
    $dataPengurus = $pengurus->fetch_assoc();
    $penatausaha = $conn->query("SELECT * FROM tb_setting WHERE jabatan = 'Penatausaha Barang' AND id_user = '$_SESSION[id_user]'");
    $dataTU = $penatausaha->fetch_assoc();
    ?>
    <tr>
      <td align="center">Pengguna Barang</td>
      <td width="40%"></td>
      <td></td>
      <td align="center">Pengurus Barang</td>
    </tr>
    <tr>
      <td height="30%">&nbsp; </td>
    </tr>
    <tr>
      <td height="30%">&nbsp; </td>
    </tr>
    <tr>
      <td height="30%">&nbsp; </td>
    </tr>
    <tr>
      <td height="30%">&nbsp; </td>
    </tr>

    <tr>
      <td align="center" width="30%"><b><u><?= $dataPengguna['nama']; ?></u></b></td>
      <td width="20%"></td>
      <td></td>
      <td align="center"><b><u><?= $dataPengurus['nama']; ?></u></b></td>
    </tr>
    <tr>
      <td align="center"><?= "NIP. " . $dataPengguna['nip']; ?></td>
      <td width="20%"></td>
      <td></td>
      <td align="center"><?= "NIP. " . $dataPengurus['nip']; ?></td>
    </tr>
  </table>
</body>

</html>

<?php

//Meload library mPDF
// require 'vendor/autoload.php';

//Membuat inisialisasi objek mPDF
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal', 'margin_top' => 15, 'margin_bottom' => 25, 'margin_left' => 15, 'margin_right' => 15]);

$mpdf->AddPage('P');

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

//Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->OutputHttpInline("Kartu Barang.pdf", "I");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>