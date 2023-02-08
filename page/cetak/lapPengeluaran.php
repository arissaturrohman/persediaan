<?php

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
  <title>Laporan Pengeluaran</title>
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

  <h5 class="b">BUKU PENGELUARAN BARANG PERSEDIAAN</h5>
  <h5 class="text">TAHUN ANGGARAN <?= $_SESSION['tahun']; ?></h5>
  <table border="1" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th class="text-center align-middle" rowspan="2">No</th>
        <th class="text-center align-middle" rowspan="2">Tanggal</th>
        <th class="text-center align-middle" colspan="2">Surat Permintaan Brg</th>
        <th class="text-center align-middle" rowspan="2">Penanggungjawab</th>
        <th class="text-center align-middle" rowspan="2">Kode Barang</th>
        <th class="text-center align-middle" rowspan="2">Nama Barang</th>
        <th class="text-center align-middle" rowspan="2">Sat</th>
        <th class="text-center align-middle" rowspan="2">Volume</th>
        <th class="text-center align-middle" rowspan="2">Harga Satuan</th>
        <th class="text-center align-middle" rowspan="2">Jumlah Harga</th>
        <th class="text-center align-middle" rowspan="2">Tanggal Penyerahan</th>
        <th class="text-center align-middle" rowspan="2">Nama Pengambil Brg</th>
        <th class="text-center align-middle" rowspan="2">Keterangan</th>
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
        <tr class="isi">
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
          <td align="right"><?= $value['volume']; ?></td>
          <td><?= $dataBarang['satuan_barang']; ?></td>
          <td align="right"><?= number_format($value['harga_satuan']); ?></td>
          <td align="right"><?= number_format($value['jumlah_harga']); ?></td>
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
  <br>
  <table align="center">
    <tr>
      <td align="center">Mengetahui,</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>Demak,</td>
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