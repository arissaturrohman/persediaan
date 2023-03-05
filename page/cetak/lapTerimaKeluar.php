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

    .upper {
      text-transform: uppercase;
    }
  </style>
</head>

<body>
  <table align="center">
    <tr>
      <td rowspan="4" width="10%"><img src="../../assets/img/logo.png" alt="logo" width="5%"></td>
      <td align="center">
        <h4>PEMERINTAH KABUPATEN DEMAK</h4>
        <h2 class="upper"><?= $dataOpd['nama_instansi']; ?></h2>
        <p><?= $dataOpd['alamat_instansi'] . " Telp. " . $dataOpd['no_telp'] . " Kode Pos " . $dataOpd['kd_pos']; ?></p>
        <p>Website : <?= $dataOpd['website']; ?> - Email : <?= $dataOpd['email']; ?></p>
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
      $sql = $conn->query("SELECT 
      b.kode_barang, 
      b.nama_barang, 
      b.satuan_barang,
      s.volume_saldo_awal,
      COALESCE(p.volume_pembelian, 0) AS volume_pembelian,
      COALESCE(k.volume_pengeluaran, 0) AS volume_pengeluaran,
      (s.volume_saldo_awal + COALESCE(p.volume_pembelian, 0) - COALESCE(k.volume_pengeluaran, 0)) AS volume_saldo_akhir,
      s.jumlah_harga AS jumlah_harga_saldo_awal,
      COALESCE(p.jumlah_harga_pembelian, 0) AS jumlah_harga_pembelian,
      COALESCE(k.jumlah_harga_pengeluaran, 0) AS jumlah_harga_pengeluaran,
      (s.jumlah_harga + COALESCE(p.jumlah_harga_pembelian, 0) - COALESCE(k.jumlah_harga_pengeluaran, 0)) AS jumlah_harga_saldo_akhir
    FROM tb_barang b
    LEFT JOIN (
      SELECT kode_barang, SUM(volume) AS volume_saldo_awal, SUM(jumlah_harga) AS jumlah_harga
      FROM tb_saldo_awal WHERE month(tanggal) <= '$smt'
      GROUP BY kode_barang
    ) s ON b.kode_barang = s.kode_barang
    LEFT JOIN (
      SELECT kode_barang, SUM(volume) AS volume_pembelian, SUM(jumlah_harga) AS jumlah_harga_pembelian
      FROM tb_pembelian_detail WHERE month(tahun) <= '$smt'
      GROUP BY kode_barang
    ) p ON b.kode_barang = p.kode_barang
    LEFT JOIN (
      SELECT kode_barang, SUM(volume) AS volume_pengeluaran, SUM(jumlah_harga) AS jumlah_harga_pengeluaran
      FROM tb_pengeluaran_detail WHERE month(tahun) <= '$smt'
      GROUP BY kode_barang
    ) k ON b.kode_barang = k.kode_barang
    ORDER BY b.kode_barang ASC;
    ");
      foreach ($sql as $key => $value) :
        $tambah = $value['jumlah_harga_saldo_awal'] + $value['jumlah_harga_pembelian'];
        $sisaVol = $value['volume_saldo_awal'] + $value['volume_pembelian'] - $value['volume_pengeluaran'];
        $sisaHarga = $value['jumlah_harga_saldo_awal'] + $value['jumlah_harga_pembelian'] - $value['jumlah_harga_pengeluaran'];
        // Jumlah total volume saldo awal
        $rowVolSaldo[] = $value['volume_saldo_awal'];
        $jumlahVolSaldo = array_sum($rowVolSaldo);
        // Jumlah total harga saldo awal
        $rowHargaSaldo[] = $value['jumlah_harga_saldo_awal'];
        $jumlahHargaSaldo = array_sum($rowHargaSaldo);
        // Jumlah total volume masuk
        $rowVolMasuk[] = $value['volume_pembelian'];
        $jumlahMasuk = array_sum($rowVolMasuk);
        // Jumlah total volume keluar
        $rowVolKeluar[] = $value['volume_pengeluaran'];
        $jumlahKeluar = array_sum($rowVolKeluar);
        // jumlah total sisa volume
        $rowVol[] = $sisaVol;
        $jumlahVol = array_sum($rowVol);
        // jumlah total harga tambah
        $rowTambah[] = $tambah;
        $jumlahTambah = array_sum($rowTambah);
        // jumlah total harga kurang
        $rowKurang[] = $value['jumlah_harga_pengeluaran'];
        $jumlahKurang = array_sum($rowKurang);
        // jumlah total harga saldo
        $row[] = $sisaHarga;
        $jumlahSaldo = array_sum($row);

      ?>
        <tr>
          <td><?= $value['kode_barang']; ?></td>
          <td><?= $value['nama_barang']; ?></td>
          <td><?= $value['satuan_barang']; ?></td>
          <td align="right"><?= number_format($value['volume_saldo_awal']); ?></td>
          <td align="right"><?= number_format($value['jumlah_harga_saldo_awal']); ?></td>
          <td align="right"><?= number_format($value['volume_pembelian']); ?></td>
          <td align="right"><?= number_format($value['volume_pengeluaran']); ?></td>
          <td align="right"><?= number_format($sisaVol); ?></td>
          <td align="right"><?= number_format($tambah); ?></td>
          <td align="right"><?= number_format($value['jumlah_harga_pengeluaran']); ?></td>
          <td align="right"><?= number_format($sisaHarga); ?></td>
          <td></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <th colspan="3">JUMLAH</th>
        <th align="right"><?= number_format($jumlahVolSaldo); ?></th>
        <th align="right"><?= number_format($jumlahHargaSaldo); ?></th>
        <th align="right"><?= number_format($jumlahMasuk); ?></th>
        <th align="right"><?= number_format($jumlahKeluar); ?></th>
        <th align="right"><?= number_format($jumlahVol); ?></th>
        <th align="right"><?= number_format($jumlahTambah); ?></th>
        <th align="right"><?= number_format($jumlahKurang); ?></th>
        <th align="right"><?= number_format($jumlahSaldo); ?></th>
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
$content = $mpdf->OutputHttpInline("Laporan Pengeluaran.pdf", "I");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>