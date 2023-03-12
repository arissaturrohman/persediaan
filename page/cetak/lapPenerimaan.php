<?php

session_start();
$jenis = $_SESSION['jenis'];
$smt = $_SESSION['smt'];

include('../../inc/config.php');
include('../../inc/tgl_indo.php');
include('../../inc/romawi.php');
include('../../inc/bulan.php');
include('../../vendor/autoload.php');

ob_start();

$instansi = $conn->query("SELECT * FROM tb_instansi WHERE id_user = '$_SESSION[id_user]'");
$dataOpd = $instansi->fetch_assoc();
$setting = $conn->query("SELECT * FROM tb_setting WHERE id_user = '$_SESSION[id_user]'");
$dataSet = $setting->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Penerimaan</title>
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

    .upper {
      text-transform: uppercase;
    }
  </style>
</head>

<body>
  <table align="center">
    <tr>
      <td rowspan="4"><img src="../../assets/img/logo.png" alt="logo" width="5%"></td>
      <td align="center">
        <h4>PEMERINTAH KABUPATEN DEMAK</h4>
        <h2 class="upper"><?= $dataOpd['nama_instansi']; ?></h2>
        <p><?= $dataOpd['alamat_instansi'] . " Telp. " . $dataOpd['no_telp'] . " Kode Pos " . $dataOpd['kd_pos']; ?></p>
        <p>Website : <?= $dataOpd['website']; ?> - Email : <?= $dataOpd['email']; ?></p>
      </td>
    </tr>
  </table>
  <hr>

  <h5 class="b">BUKU PENERIMAAN BARANG PERSEDIAAN</h5>
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
        <th class="text-center align-middle" rowspan="2">No</th>
        <th class="text-center align-middle" rowspan="2">Tanggal</th>
        <th class="text-center align-middle" rowspan="2">Nama Rekanan</th>
        <th class="text-center align-middle" colspan="2">Dokumen Pengadaan</th>
        <th class="text-center align-middle" rowspan="2">Kode Barang</th>
        <th class="text-center align-middle" rowspan="2">Nama Barang</th>
        <th class="text-center align-middle" rowspan="2">Satuan</th>
        <th class="text-center align-middle" rowspan="2">Volume</th>
        <th class="text-center align-middle" rowspan="2">Harga Satuan</th>
        <th class="text-center align-middle" rowspan="2">Jumlah Harga</th>
        <th class="text-center align-middle" colspan="2">Bukti Penerimaan</th>
        <th class="text-center align-middle" rowspan="2">Keterangan</th>
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
      $sql = $conn->query("SELECT * FROM tb_pembelian_detail WHERE id_user = '$_SESSION[id_user]' AND month(tahun) <= '$smt' AND year(tahun) = '$_SESSION[tahun]' GROUP BY kode_barang");
      foreach ($sql as $key => $value) :
      ?>
        <tr>
          <td align="center"><?= $no++; ?></td>
          <td><?= TanggalIndo($value['tanggal']); ?></td>
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
          <td align="center"><?= $value['kode_barang']; ?></td>
          <?php
          $kd = $value['kode_barang'];
          $namaBarang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kd'");
          $dataBarang = $namaBarang->fetch_assoc();
          ?>
          <td><?= $dataBarang['nama_barang']; ?></td>
          <td><?= $dataBarang['satuan_barang']; ?></td>
          <td align="right"><?= $value['volume']; ?></td>
          <td align="right"><?= number_format($value['harga_satuan']); ?></td>
          <td align="right"><?= number_format($value['jumlah_harga']); ?></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      <?php endforeach; ?>
      <?php
      $hitung = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pembelian_detail WHERE id_user = '$_SESSION[id_user]' AND month(tahun) <= '$smt' AND year(tahun) = '$_SESSION[tahun]'");
      $dataHitung = $hitung->fetch_assoc();
      ?>
      <tr>
        <th colspan="10" align="center">JUMLAH</th>
        <th align="center"><?= number_format($dataHitung['total']); ?></th>
        <td colspan="3"></td>
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
      <td>Demak,
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
    ?>
    <?php
    $pengurus = $conn->query("SELECT * FROM tb_setting WHERE jabatan = 'Pengurus Barang' AND id_user = '$_SESSION[id_user]'");
    $dataPengurus = $pengurus->fetch_assoc();
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
      <td align="center" width="20%"><b><u><?= $dataPengguna['nama']; ?></u></b></td>
      <td width="60%"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td align="center"><b><u><?= $dataPengurus['nama']; ?></u></b></td>
    </tr>
    <tr>
      <td align="center"><?= "NIP. " . $dataPengguna['nip']; ?></td>
      <td width="60%"></td>
      <td></td>
      <td></td>
      <td></td>
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

$mpdf->AddPage('L');

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

//Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->Output("Laporan Penerimaan.pdf", "D");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>