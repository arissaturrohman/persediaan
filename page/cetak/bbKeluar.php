<?php

session_start();
$jenis = $_SESSION['jenis'];
$spmb = $_SESSION['spmb'];

include('../../inc/config.php');
include('../../inc/tgl_indo.php');
include('../../inc/terbilang.php');
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
  <title>SURAT BUKTI PENGELUARAN BARANG DARI GUDANG</title>
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
        <h2 class="upper"><?= $dataOpd['nama_instansi']; ?></h2>
        <p><?= $dataOpd['alamat_instansi'] . " Telp. " . $dataOpd['no_telp'] . " Kode Pos " . $dataOpd['kd_pos']; ?></p>
        <p>Website : <?= $dataOpd['website']; ?> - Email : <?= $dataOpd['email']; ?></p>
      </td>
    </tr>
  </table>
  <hr>

  <h5 class="b"><u>SURAT BUKTI PENGELUARAN BARANG DARI GUDANG</u></h5>
  <?php
  $no_spb = $conn->query("SELECT * FROM tb_pengeluaran_detail WHERE no_spb = '$spmb'");
  $dataSpb = $no_spb->fetch_assoc();
  ?>
  <h5 class="text">Nomor : <?= "0" . $dataSpb['no_spb'] . " / SBPB / " . BulanRomawi($dataSpb['tanggal']); ?></h5>


  <table width="100%">
    <tr>
      <td width="12%">Dasar</td>
      <td width="1%">:</td>
      <td align="justify">Surat Perintah Penyaluran Barang (SPPB) Nomor <?= "0" . $dataSpb['no_spb'] . " / SPPB / " . BulanRomawi($dataSpb['tanggal']); ?> Tanggal <?= TanggalIndo($dataSpb['tanggal']); ?></td>
    </tr>
  </table>
  <?php
  $jabatan = $conn->query("SELECT * FROM tb_pegawai WHERE id_pegawai = '$dataSpb[penanggungjawab]'");
  $dataJab = $jabatan->fetch_assoc();
  ?>
  <p align="justify">Telah dikeluarkan barang dari gudang/tempat penyimpanan barang dan disalurkan barang tersebut untuk <?= $dataJab['jabatan']; ?> Kec. Gajah, sesuai dengan Surat Permintaan Barang (SPB) Nomor <?= "0" . $dataSpb['no_spb'] . " / SPB / " . BulanRomawi($dataSpb['tanggal']); ?> Tanggal <?= TanggalIndo($dataSpb['tanggal']); ?> yang berupa barang persediaan, sebagaimana daftar dibawah ini :</p>
  <table border="1" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th class="text-center align-middle">No</th>
        <th class="text-center align-middle">Kode Brg</th>
        <th class="text-center align-middle">Nama Brg</th>
        <th class="text-center align-middle">Satuan</th>
        <th class="text-center align-middle">Vol</th>
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
          <td align="right"><?= $value['volume']; ?></td>
          <td align="right"><?= number_format($value['harga_satuan']); ?></td>
          <td align="right"><?= number_format($value['jumlah_harga']); ?></td>
          <td><?= $value['ket']; ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <th align="center" colspan="6">JUMLAH</th>
        <th align="right">
          <?php
          $hitungKeluar = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pengeluaran_detail WHERE id_user = '$_SESSION[id_user]' AND no_spb = '$_SESSION[spmb]' AND year(tahun) = '$_SESSION[tahun]' GROUP BY no_spb");
          $dataHitungKeluar = $hitungKeluar->fetch_assoc();
          echo $sisaKeluar = number_format($dataHitungKeluar['total']);
          ?>

        </th>
        <th></th>
      </tr>
    </tbody>
  </table>
  <br>
  <table align="center">
    <tr>
      <td align="center">Mengetahui,</td>
      <td></td>
      <td></td>
      <td align="center">Demak, <?= TanggalIndo($dataSpb['tanggal']); ?></td>
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
      <td align="center">Pejabat Penatausaha Barang</td>
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
      <td align="center" width="30%"><b><u><?= $dataTU['nama']; ?></u></b></td>
      <td width="20%"></td>
      <td></td>
      <td align="center"><b><u><?= $dataPengurus['nama']; ?></u></b></td>
    </tr>
    <tr>
      <td align="center"><?= "NIP. " . $dataTU['nip']; ?></td>
      <td width="20%"></td>
      <td></td>
      <td align="center"><?= "NIP. " . $dataPengurus['nip']; ?></td>
    </tr>
  </table>
  <br>
  <table align="center">
    <tr>
      <td align="center">Mengetahui/Menyetujui,</td>
    </tr>
    <tr>
      <td align="center">Pengguna/Kuasa Pengguna Barang</td>
    </tr>
    <tr>
      <td height="20%">&nbsp; </td>
    </tr>
    <tr>
      <td height="20%">&nbsp; </td>
    </tr>
    <tr>
      <td height="20%">&nbsp; </td>
    </tr>
    <tr>
      <td height="20%">&nbsp; </td>
    </tr>
    <tr>
      <td align="center"><b><u><?= $dataPengguna['nama']; ?></u></b></td>
    </tr>
    <tr>
      <td align="center"><?= "NIP. " . $dataPengguna['nip']; ?></td>
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
$content = $mpdf->OutputHttpInline("BB Keluar.pdf", "I");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>