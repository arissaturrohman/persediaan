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
$barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$brg'");
$dataBarang = $barang->fetch_assoc();
$setting = $conn->query("SELECT * FROM tb_setting WHERE id_user = '$_SESSION[id_user]' AND jabatan = 'Pengurus Barang'");
$dataSet = $setting->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KARTU PERSEDIAAN</title>
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
      <td align="left" rowspan="4" width="10%"><img src="../../assets/img/logo.png" alt="logo" width="5%"></td>
      <td align="center">
        <h4>PEMERINTAH KABUPATEN DEMAK</h4>
        <h2 class="upper"><?= $dataOpd['nama_instansi']; ?></h2>
        <p><?= $dataOpd['alamat_instansi'] . " Telp. " . $dataOpd['no_telp'] . " Kode Pos " . $dataOpd['kd_pos']; ?></p>
        <p>Website : <?= $dataOpd['website']; ?> - Email : <?= $dataOpd['email']; ?></p>
      </td>
    </tr>
  </table>
  <hr>
  <h5 class="b">KARTU PERSEDIAAN </h5>
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
      <td><?= $dataBarang['nama_barang']; ?></td>
    </tr>
    <tr>
      <td>Satuan</td>
      <td>:</td>
      <td><?= $dataBarang['satuan_barang']; ?></td>
    </tr>
  </table>
  <br>
  <table border="1" width="100%" cellspacing="0">
    <thead height="5%">
      <tr>
        <th width="3%" rowspan="2">No</th>
        <th width="10%" rowspan="2">Tanggal Pembukuan</th>
        <th colspan="3">Jumlah Barang</th>
        <th rowspan="2">Harga Satuan</th>
        <th colspan="3">Jumlah Harga</th>
        <th rowspan="2">Ket</th>
      </tr>
      <tr>
        <th>Masuk</th>
        <th>Keluar</th>
        <th>Sisa</th>
        <th>Bertambah</th>
        <th>Berkurang</th>
        <th>Saldo</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $querySaldo = $conn->query("SELECT * FROM tb_saldo_awal WHERE kode_barang = '$brg'");
      $dataTrx = $querySaldo->fetch_assoc();
      if ($dataTrx != null) {
        $saldoAwal = $dataTrx['volume'];
        $tanggalAwal = $dataTrx['tanggal'];
        $harga = $dataTrx['jumlah_harga'];
        $hargaSatuan = $dataTrx['harga_satuan'];
      } else {
        $saldoAwal = 0;
        $tanggalAwal = '';
        $harga = 0;
      }
      echo '
      <tr>
      <td>1</td>
      <td>' . date("d-m-Y", strtotime($tanggalAwal)) . '</td>
      <td align="right">' . $saldoAwal . '</td>
      <td></td>
      <td  align="right">' . $saldoAwal . '</td>
      <td align="right">' . number_format($hargaSatuan) . '</td>
      <td></td>
      <td></td>
      <td align="right">' . number_format($harga) . '</td>
      <td>Saldo Awal</td>      
      </tr>
      ';
      $no = 2;
      $queryTrx = $conn->query("SELECT a.kode_barang, a.volume AS masuk, 0 AS keluar, a.harga_satuan AS harga, 0 AS satuan, a.jumlah_harga AS tambah, 0 AS kurang, a.tanggal FROM tb_pembelian_detail a WHERE a.kode_barang = '$brg' UNION ALL SELECT b.kode_barang, 0 AS masuk, b.volume AS keluar, 0 AS harga, b.harga_satuan AS satuan, 0 AS tambah, b.jumlah_harga AS kurang, b.tanggal FROM tb_pengeluaran_detail b WHERE b.kode_barang = '" . $brg . "' AND month(tanggal) <= '" . $smt . "' ORDER BY tanggal ASC;");

      foreach ($queryTrx as $value) {
        $saldoAwal = $saldoAwal + $value['masuk'] - $value['keluar'];
        $harga = $harga + $value['tambah'] - $value['kurang'];

        if ($value['masuk'] > 0) {
          $satuan = $value['harga'];
        } else {
          $satuan = $value['satuan'];
        }

        echo '        
        <tr>
          <td>' . $no++ . '</td>
          <td>' . $value["tanggal"] . '</td>
          <td align="right">' . $value["masuk"] . '</td>
          <td align="right">' . $value["keluar"] . '</td>
          <td align="right">' . $saldoAwal . '</td>
          <td align="right">' . number_format($satuan) . '</td>
          <td align="right">' . number_format($value["tambah"]) . '</td>
          <td align="right">' . number_format($value["kurang"]) . '</td>
          <td align="right">' . number_format($harga) . '</td>
          <td> -</td>
        </tr>
        ';
      }
      ?>
    </tbody>
  </table>
  <br>
  <table align="center">
    <tr>
      <td width="40%" align="center">Mengetahui,</td>
      <td width="40%">&nbsp;</td>
      <td width="40%">&nbsp;</td>
      <td width="40%" align="center">Demak,
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
      <td width="40%" align="center">Pengguna Barang</td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%" align="center">Pengurus Barang</td>
    </tr>
    <tr>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
    </tr>
    <tr>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
    </tr>
    <tr>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
    </tr>

    <tr>
      <td align="center" width="40%"><b><u><?= $dataPengguna['nama']; ?></u></b></td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%" align="center"><b><u><?= $dataPengurus['nama']; ?></u></b></td>
    </tr>
    <tr>
      <td width="40%" align="center"><?= "NIP. " . $dataPengguna['nip']; ?></td>
      <td width="40%">&nbsp; </td>
      <td width="40%">&nbsp; </td>
      <td width="40%" align="center"><?= "NIP. " . $dataPengurus['nip']; ?></td>
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
$content = $mpdf->OutputHttpInline("Kartu Persediaan.pdf", "I");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>