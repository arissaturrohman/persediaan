<?php

session_start();
// $jenis = $_SESSION['jenis'];
$smt = $_SESSION['smt'];
// $brg = $_SESSION['brg'];

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
  <title>Rekap Persediaan</title>
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
  <h5 class="b">REKAP PERSEDIAAN </h5>
  <h5 class="text">SEMESTER
    <?php
    if ($smt <= 06) {
      echo "I (SATU)";
    } else {
      echo "II (DUA)";
    }
    ?>
    TAHUN ANGGARAN <?= $_SESSION['tahun']; ?></h5>

  <br>
  <table border="1" width="100%" cellspacing="0">
    <thead height="5%">
      <tr>
        <th width="8%" rowspan="2">Kode Barang</th>
        <th rowspan="2">Nama Barang</th>
        <th rowspan="2">Satuan Brg</th>
        <th colspan="3">Saldo Awal</th>
        <th colspan="3">Penerimaan</th>
        <th colspan="3">Pengeluaran</th>
        <th colspan="3">Saldo Akhir</th>
        <th rowspan="2">Ket</th>
      </tr>
      <tr>
        <th>Vol</th>
        <th>Harga Satuan</th>
        <th>Jumlah Harga</th>
        <th>Vol</th>
        <th>Harga Satuan</th>
        <th>Jumlah Harga</th>
        <th>Vol</th>
        <th>Harga Satuan</th>
        <th>Jumlah Harga</th>
        <th>Vol</th>
        <th>Harga Satuan</th>
        <th>Jumlah Harga</th>
      </tr>
    </thead>
    <tbody>

      <?php

      $sqlKategori = $conn->query("SELECT * FROM tb_kategori");
      while ($resultKategori = $sqlKategori->fetch_assoc()) {
        $idKategori = $resultKategori['id_kategori'];
        // var_dump($resultKategori); die;

      ?>
        <tr>
          <td colspan="16" style="background-color: #dcdcdc;"><?= $resultKategori['kategori']; ?></td>
        </tr>

        <?php
        // $sqlRekap = $conn->query("SELECT 
        //   tb_barang.nama_barang, 
        //   tb_barang.satuan_barang,
        //   tb_kategori.kategori,
        //   tb_kategori.id_kategori,
        //   subquery.kode_barang, 
        //   SUM(subquery.volSaldo) AS totalVolSaldo, 
        //   SUM(subquery.volTerima) AS totalVolTerima, 
        //   SUM(subquery.volKeluar) AS totalVolKeluar,
        //   SUM(subquery.volSaldo + subquery.volTerima - subquery.volKeluar) AS sisaVol, 
        //   SUM(subquery.hargaSaldo) AS totalHargaSaldo,
        //   subquery.hargaSaldo AS hargaSaldo, 
        //   subquery.hargaTerima AS hargaTerima, 
        //   subquery.hargaKeluar AS hargaKeluar, 
        //   SUM(subquery.jumlahSaldo) AS totalJumlahSaldo, 
        //   SUM(subquery.jumlahTerima) AS totalJumlahTerima, 
        //   SUM(subquery.jumlahKeluar) AS totalJumlahKeluar,
        //   SUM(subquery.jumlahSaldo + subquery.jumlahTerima - subquery.jumlahKeluar) AS saldoAkhir
        // FROM 
        //   (SELECT 
        //     id_kategori, 
        //     kode_barang, 
        //     SUM(volume) AS volSaldo, 
        //     0 AS volTerima, 
        //     0 AS volKeluar, 
        //     SUM(jumlah_harga) AS hargaSaldo, 
        //     harga_satuan AS hargaTerima, 
        //     harga_satuan AS hargaKeluar, 
        //     SUM(jumlah_harga) AS jumlahSaldo, 
        //     0 AS jumlahTerima, 
        //     0 AS jumlahKeluar 
        //   FROM 
        //     tb_saldo_awal WHERE id_kategori = '$idKategori'
        //   GROUP BY 
        //   $idKategori, 
        //     kode_barang 
        //   UNION 
        //   SELECT 
        //     id_kategori, 
        //     kode_barang, 
        //     0 AS volSaldo, 
        //     SUM(volume) AS volTerima, 
        //     0 AS volKeluar, 
        //     harga_satuan AS hargaSaldo, 
        //     harga_satuan AS hargaTerima, 
        //     harga_satuan AS hargaKeluar, 
        //     0 AS jumlahSaldo, 
        //     SUM(jumlah_harga) AS jumlahTerima, 
        //     0 AS jumlahKeluar 
        //   FROM 
        //     tb_pembelian_detail WHERE month(tahun) <= '$smt' AND id_kategori = '$idKategori'
        //   GROUP BY 
        //   $idKategori, 
        //     kode_barang 
        //   UNION ALL 
        //   SELECT 
        //     id_kategori, 
        //     kode_barang, 
        //     0 AS volSaldo, 
        //     0 AS volTerima, 
        //     SUM(volume) AS volKeluar, 
        //     harga_satuan AS hargaSaldo, 
        //     harga_satuan AS hargaTerima, 
        //     harga_satuan AS hargaKeluar, 
        //     0 AS jumlahSaldo, 
        //     0 AS jumlahTerima, 
        //     SUM(jumlah_harga) AS jumlahKeluar 
        //   FROM 
        //     tb_pengeluaran_detail WHERE month(tahun) <= '$smt' AND id_kategori = '$idKategori'
        //   GROUP BY 
        //   $idKategori, 
        //     kode_barang
        //   ) AS subquery
        // JOIN tb_barang ON tb_barang.kode_barang = subquery.kode_barang 
        // JOIN tb_kategori ON tb_kategori.id_kategori = tb_barang.id_kategori
        // WHERE tb_kategori.id_kategori = tb_barang.id_kategori
        // GROUP BY 
        //   tb_barang.nama_barang, 
        //   tb_barang.satuan_barang,
        //   subquery.kode_barang
        //   ORDER BY 
        //   subquery.kode_barang ASC;");

        $sqlRekap = $conn->query("SELECT 
        tb_barang.nama_barang, 
        tb_barang.satuan_barang,
        tb_kategori.kategori,
        tb_kategori.id_kategori,
        subquery.kode_barang, 
        SUM(subquery.volSaldo) AS totalVolSaldo, 
        SUM(subquery.volTerima) AS totalVolTerima, 
        SUM(subquery.volKeluar) AS totalVolKeluar,
        SUM(subquery.volSaldo + subquery.volTerima - subquery.volKeluar) AS sisaVol, 
        SUM(subquery.hargaSaldo) AS totalHargaSaldo, 
        subquery.hargaSaldo AS hargaSaldo, 
        subquery.hargaTerima AS hargaTerima, 
        subquery.hargaKeluar AS hargaKeluar, 
        SUM(subquery.jumlahSaldo) AS totalJumlahSaldo, 
        SUM(subquery.jumlahTerima) AS totalJumlahTerima, 
        SUM(subquery.jumlahKeluar) AS totalJumlahKeluar,
        SUM(subquery.jumlahSaldo + subquery.jumlahTerima - subquery.jumlahKeluar) AS saldoAkhir
        
      FROM 
        (SELECT 
          id_kategori, 
          kode_barang, 
          SUM(volume) AS volSaldo, 
          0 AS volTerima, 
          0 AS volKeluar, 
          SUM(jumlah_harga) AS hargaSaldo, 
          harga_satuan AS hargaTerima, 
          harga_satuan AS hargaKeluar, 
          SUM(jumlah_harga) AS jumlahSaldo, 
          0 AS jumlahTerima, 
          0 AS jumlahKeluar 
        FROM 
          tb_saldo_awal WHERE id_kategori = '$idKategori'
        GROUP BY 
        $idKategori, 
          kode_barang 
        UNION 
        SELECT 
          id_kategori, 
          kode_barang, 
          0 AS volSaldo, 
          SUM(volume) AS volTerima, 
          0 AS volKeluar, 
          harga_satuan AS hargaSaldo, 
          harga_satuan AS hargaTerima, 
          harga_satuan AS hargaKeluar, 
          0 AS jumlahSaldo, 
          SUM(jumlah_harga) AS jumlahTerima, 
          0 AS jumlahKeluar 
        FROM 
          tb_pembelian_detail WHERE month(tahun) <= '$smt' AND id_kategori = '$idKategori'
        GROUP BY 
        $idKategori, 
          kode_barang 
        UNION ALL 
        SELECT 
          id_kategori, 
          kode_barang, 
          0 AS volSaldo, 
          0 AS volTerima, 
          SUM(volume) AS volKeluar, 
          harga_satuan AS hargaSaldo, 
          harga_satuan AS hargaTerima, 
          harga_satuan AS hargaKeluar, 
          0 AS jumlahSaldo, 
          0 AS jumlahTerima, 
          SUM(jumlah_harga) AS jumlahKeluar 
        FROM 
          tb_pengeluaran_detail WHERE month(tahun) <= '$smt' AND id_kategori = '$idKategori'
        GROUP BY 
        $idKategori, 
          kode_barang
        ) AS subquery
      JOIN tb_barang ON tb_barang.kode_barang = subquery.kode_barang 
      JOIN tb_kategori ON tb_kategori.id_kategori = tb_barang.id_kategori
      WHERE tb_kategori.id_kategori = tb_barang.id_kategori
      GROUP BY 
        tb_barang.nama_barang, 
        tb_barang.satuan_barang,
        tb_kategori.kategori,
        tb_kategori.id_kategori
      ORDER BY 
        subquery.kode_barang ASC;
      ");

        foreach ($sqlRekap as $key => $value) {
          // while ($value = $sqlRekap->fetch_assoc()) {
          echo $sisa = $value['totalVolSaldo'] + $value['totalVolTerima'] - $value['totalVolKeluar'];

        ?>


          <tr>
            <!-- saldo awal -->
            <td align="center"><?= $value['kode_barang']; ?></td>
            <td><?= $value['nama_barang']; ?></td>
            <td><?= $value['satuan_barang']; ?></td>
            <td><?= $value['totalVolSaldo']; ?></td>
            <td><?= number_format($value['hargaSaldo']); ?></td>
            <td><?= number_format($value['totalJumlahSaldo']); ?></td>
            <!-- Penerimaan -->
            <td><?= $value['totalVolTerima']; ?></td>
            <td><?= number_format($value['hargaTerima']); ?></td>
            <td><?= number_format($value['totalJumlahTerima']); ?></td>
            <!-- Pengeluaran -->
            <td><?= $value['totalVolKeluar']; ?></td>
            <td><?= number_format($value['hargaKeluar']); ?></td>
            <td><?= number_format($value['totalJumlahKeluar']); ?></td>
            <td><?= number_format($value['sisaVol']); ?></td>
            <td><?= number_format($value['hargaKeluar']); ?></td>
            <td><?= number_format($value['saldoAkhir']); ?></td>
            <td> -</td>
          </tr>
      <?php }
      } ?>
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
$content = $mpdf->OutputHttpInline("Rekap Persediaan.pdf", "I");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>