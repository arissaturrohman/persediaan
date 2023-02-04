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
  <title>Document</title>
  <style>
    table,
    th,
    td {
      border: 1px solid;
    }
  </style>
</head>

<body>
  <table class="table table-bordered" id="tableLap" width="100%" cellspacing="0">
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
          <td><?= $dataBarang['satuan_barang']; ?></td>
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
</body>

</html>

<?php

//Meload library mPDF
// require 'vendor/autoload.php';

//Membuat inisialisasi objek mPDF
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal', 'margin_top' => 25, 'margin_bottom' => 25, 'margin_left' => 25, 'margin_right' => 25]);

$mpdf->AddPage('L');

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

//Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->OutputHttpInline("CETAK.pdf", "I");
// $mpdf->OutputHttpDownload('Lap.pdf');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>