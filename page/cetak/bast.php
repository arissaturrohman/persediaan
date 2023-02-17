<?php

if ($_POST) {
  $smt = $_POST['smt'];
  $spmb = $_POST['spmb'];
}

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BERITA ACARA SERAH TERIMA BARANG (BAST)</title>
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
        <p><?= $dataOpd['alamat_instansi'] . " Telp. ".$dataOpd['no_telp']; ?></p>
        <p>Website : https://kecgajah.demakkab.go.id - Email : office.kec.gajah@gmail.com</p>
      </td>
    </tr>
  </table>
  <hr>

  <h5 class="b"><u>BERITA ACARA SERAH TERIMA BARANG (BAST)</u></h5>
  <?php
  $no_spb = $conn->query("SELECT * FROM tb_pengeluaran_detail WHERE no_spb = '$spmb'");
  $dataSpb = $no_spb->fetch_assoc();
  ?>
  <h5 class="text">Nomor : <?= "0" . $dataSpb['no_spb'] . " / BAST / " . BulanRomawi($dataSpb['tanggal_spb']); ?></h5>
  <?php
  // nama hari indo
  $hari = date($dataSpb['tanggal_spb']);
  $query = $conn->query("SELECT datediff('$hari', CURDATE()) AS Selisih");
  $hasil = $query->fetch_assoc();
  $selisih = $hasil['Selisih'];
  $x  = mktime(0, 0, 0, date("m"), date("d") + $selisih, date("Y"));
  $namahari = date("l", $x);

  // Tanggal jadi Text
  $tgl = date('d', strtotime($dataSpb['tanggal_spb']));

  ?>
  <p align="left">Pada hari ini <?= hariIndo($namahari); ?> tanggal <?= terbilang($tgl); ?> bulan <?= BulanIndo($dataSpb['tanggal_spb']); ?> tahun <?= terbilang($_SESSION['tahun']) . " (" . date("d-m-Y", strtotime($dataSpb['tanggal_spb'])) . ")"; ?> bertempat di <?= $dataOpd['nama_instansi']; ?> Kab. Demak, kami yang bertanda tangan dibawah ini:</p>
  <table width="100%">
    <tr>
      <td width="5%"></td>
      <td>Nama</td>
      <td width="1%">:</td>
      <td>HARTINI</td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>NIP</td>
      <td width="1%">:</td>
      <td>1515456</td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>Jabatan</td>
      <td width="1%">:</td>
      <td>CAMAT</td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td></td>
      <td width="1%"></td>
      <td>Selanjutnya disebut sebagai Pihak I (Kesatu) atau Yang Menyerahkan,</td>
    </tr>
    <tr>
      <td height="10%">&nbsp; </td>
      <td height="10%">&nbsp; </td>
      <td height="10%">&nbsp; </td>
      <td height="10%">&nbsp; </td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>Nama</td>
      <td width="1%">:</td>
      <td>HARTINI</td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>NIP</td>
      <td width="1%">:</td>
      <td>1515456</td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>Jabatan</td>
      <td width="1%">:</td>
      <td>CAMAT</td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td></td>
      <td width="1%"></td>
      <td>Selanjutnya disebut sebagai Pihak II (Kedua atau Yang Menerima,</td>
    </tr>
  </table>
  <?php
  $jabatan = $conn->query("SELECT * FROM tb_pegawai WHERE id_pegawai = '$dataSpb[penanggungjawab]'");
  $dataJab = $jabatan->fetch_assoc();
  ?>
  <p align="left">Kami sepakat menyatakan bahwa telah melakukan serah terima barang dari Pihak I (Kesatu) kepada Pihak II (Kedua), sesuai dengan Surat Permintaan Barang (SPB) Nomor <?= "0" . $dataSpb['no_spb'] . " / SPB / " . BulanRomawi($dataSpb['tanggal_spb']); ?> Tanggal <?= TanggalIndo($dataSpb['tanggal_spb']); ?> yang berupa barang persediaan, sebagaimana daftar dibawah ini :</p>
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
          $hitungKeluar = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pengeluaran_detail WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]' GROUP BY no_spb");
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
      <td align="center">Demak, <?= TanggalIndo($dataSpb['tanggal_spb']); ?></td>
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
      <td align="center" width="30%"><b><u><?= $dataPegawai['nama_pegawai']; ?></u></b></td>
      <td width="20%"></td>
      <td></td>
      <td align="center"><b><u><?= $dataPegawai1['nama_pegawai']; ?></u></b></td>
    </tr>
    <tr>
      <td align="center"><?= "NIP. " . $dataPegawai['nip']; ?></td>
      <td width="20%"></td>
      <td></td>
      <td align="center"><?= "NIP. " . $dataPegawai1['nip']; ?></td>
    </tr>
  </table>
  <br>
  <br>
  <table align="center">
    <tr>
      <td align="center">Mengetahui,</td>
      <td></td>
      <td></td>
      <td align="center">Demak, <?= TanggalIndo($dataSpb['tanggal_spb']); ?></td>
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
      <td align="center" width="30%"><b><u><?= $dataPegawai['nama_pegawai']; ?></u></b></td>
      <td width="20%"></td>
      <td></td>
      <td align="center"><b><u><?= $dataPegawai1['nama_pegawai']; ?></u></b></td>
    </tr>
    <tr>
      <td align="center"><?= "NIP. " . $dataPegawai['nip']; ?></td>
      <td width="20%"></td>
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

$mpdf->AddPage('P');

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

//Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->OutputHttpInline("BAST.pdf", "I");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>