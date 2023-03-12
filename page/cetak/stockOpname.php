<?php

session_start();
// $jenis = $_SESSION['jenis'];
$smt = $_SESSION['smt'];

include('../../inc/config.php');
include('../../inc/tgl_indo.php');
include('../../inc/romawi.php');
include('../../inc/terbilang.php');
include('../../inc/hariIndo.php');
include('../../inc/bulan.php');
include('../../vendor/autoload.php');

ob_start();

$instansi = $conn->query("SELECT * FROM tb_instansi WHERE id_user = '$_SESSION[id_user]'");
$dataOpd = $instansi->fetch_assoc();
$camat = $conn->query("SELECT * FROM tb_pegawai WHERE id_user = '$_SESSION[id_user]'");
$dataPgw = $camat->fetch_assoc();
$setting = $conn->query("SELECT * FROM tb_setting WHERE jabatan = 'Pengguna Barang' AND id_user = '$_SESSION[id_user]'");
$dataSet = $setting->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BA STOCK OPNAME BARANG</title>
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

  <h5 class="b"><u>BERITA ACARA PEMERIKSAAN BARANG PERSEDIAAN (STOK OPNAME)</u></h5>
  <h5 class="text">Nomor : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/ BAP / <?= $smt <= 06 ? 'VI / '  : 'XII / ' ?><?= $_SESSION['tahun']; ?></h5>
  <?php
  if ($smt <= 06) {
    $semester = 'I (SATU)';
  } else {
    $semester = 'II (DUA)';
  }
  if ($smt <= 06) {
    $tglBA = '2023-06-30';
  } else {
    $tglBA = '2023-12-31';
  }
  // nama hari indo
  $hari = date($tglBA);
  $query = $conn->query("SELECT datediff('$hari', CURDATE()) AS Selisih");
  $hasil = $query->fetch_assoc();
  $selisih = $hasil['Selisih'];
  $x  = mktime(0, 0, 0, date("m"), date("d") + $selisih, date("Y"));
  $namahari = date("l", $x);

  // Tanggal jadi Text
  $tgl = date('d', strtotime($tglBA));

  ?>
  <p align="justify">Pada hari ini <?= hariIndo($namahari); ?> tanggal <?= terbilang($tgl); ?> bulan <?= BulanIndo($tglBA); ?> tahun <?= terbilang($_SESSION['tahun']) . " (" . date("d-m-Y", strtotime($tglBA)) . ")"; ?> bertempat di <?= $dataOpd['nama_instansi']; ?> Kab. Demak, kami yang bertanda tangan dibawah ini:</p>
  <table width="100%">
    <tr>
      <td width="5%"></td>
      <td>Nama</td>
      <td width="1%">:</td>
      <td><?= $dataSet['nama']; ?></td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>NIP</td>
      <td width="1%">:</td>
      <td><?= $dataSet['nip']; ?></td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>Jabatan</td>
      <td width="1%">:</td>
      <td><?= $dataPgw['jabatan'] . ' selaku ' . $dataSet['jabatan']; ?></td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td></td>
      <td width="1%"></td>
      <td>Selanjutnya disebut sebagai Pihak I (Kesatu) atau Yang Memeriksa,</td>
    </tr>
    <tr>
      <td height="10%">&nbsp; </td>
      <td height="10%">&nbsp; </td>
      <td height="10%">&nbsp; </td>
      <td height="10%">&nbsp; </td>
    </tr>
    <?php
    $sqlPegawai = $conn->query("SELECT * FROM tb_setting WHERE jabatan = 'Pengurus Barang'");
    $result = $sqlPegawai->fetch_assoc();
    $idPeg = $result['id_pegawai'];
    $sqlStaf = $conn->query("SELECT * FROM tb_pegawai WHERE id_pegawai = '$idPeg'");
    $resultStaf = $sqlStaf->fetch_assoc();

    ?>
    <tr>
      <td width="5%"></td>
      <td>Nama</td>
      <td width="1%">:</td>
      <td><?= $result['nama']; ?></td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>NIP</td>
      <td width="1%">:</td>
      <td><?= $result['nip']; ?></td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td>Jabatan</td>
      <td width="1%">:</td>
      <td><?= $resultStaf['jabatan'] . ' selaku ' . $result['jabatan']; ?></td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td></td>
      <td width="1%"></td>
      <td>Selanjutnya disebut sebagai Pihak II (Kedua) atau Yang diperiksa,</td>
    </tr>
  </table>

  <p align="justify">telah melaksanakan pemeriksaan barang persediaan (Stok Opname) pada OPD <?= $dataOpd['nama_instansi']; ?> Kab. Demak, oleh Pihak I (Kesatu) terhadap Pihak II (Kedua) untuk periode sampai dengan Semester <?= $semester; ?> Tahun Anggaran <?= $_SESSION['tahun']; ?>. Adapun terdapat barang persediaan tersebut, sebagaimana daftar terlampir dibawah ini :</p>
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
      $sqlKategori = $conn->query("SELECT * FROM tb_kategori");
      while ($dataKategori = $sqlKategori->fetch_assoc()) :
        $idKategori = $dataKategori['id_kategori'];
      ?>
        <tr>
          <td colspan="8" style="background-color: #dcdcdc;"><b><?= $dataKategori['kategori']; ?></b></td>
        </tr>
        <?php
        $no = 1;
        $sql = $conn->query("SELECT 
      tb_barang.kode_barang,
      tb_barang.nama_barang,
      tb_barang.satuan_barang,
      tb_barang.id_kategori,
      SUM(tb_pembelian.volume) as volume,
      SUM(tb_pembelian.harga_satuan) as harga_satuan,
      SUM(tb_pembelian.jumlah_harga) as jumlah_harga  
    FROM 
      tb_barang
      INNER JOIN tb_pembelian ON tb_barang.kode_barang = tb_pembelian.kode_barang WHERE
      tb_barang.id_kategori ='$idKategori' AND month(tb_pembelian.tahun) <= '$smt'
    GROUP BY 
      tb_barang.kode_barang,
      tb_barang.nama_barang,
      tb_barang.id_kategori,
      tb_barang.satuan_barang;    
    ");
        
        foreach ($sql as $key => $value) :
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $value['kode_barang']; ?></td>
            <td><?= $value['nama_barang']; ?></td>
            <td><?= $value['satuan_barang']; ?></td>
            <td align="right"><?= $value['volume']; ?></td>
            <td align="right"><?= number_format($value['harga_satuan']); ?></td>
            <td align="right"><?= number_format($value['jumlah_harga']); ?></td>
            <td> -</td>
          </tr>
        <?php endforeach; ?>
      <?php endwhile; ?>
      <tr>
        <th align="center" colspan="6">JUMLAH</th>
        <th align="right">
          <?php
          $hitungKeluar = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pembelian WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]'");
          $dataHitungKeluar = $hitungKeluar->fetch_assoc();
          echo $sisaKeluar = number_format($dataHitungKeluar['total']);
          ?>

        </th>
        <th></th>
      </tr>
    </tbody>
  </table>
  <p align="justify">Demikian Berita Acara ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan, dan apabila dikemudian hari terdapat kekeliruan akan dilakukan perbaikan sebagaimana mestinya.</p>
  <br>
  <table align="center">
    <tr>
      <td align="center">Yang Memeriksa,</td>
      <td></td>
      <td></td>
      <td align="center">Yang diperiksa,</td>
    </tr>
    <?php
    $camat = $conn->query("SELECT * FROM tb_setting WHERE jabatan = 'Pengguna Barang' AND id_user = '$_SESSION[id_user]'");
    $dataPengguna = $camat->fetch_assoc();

    $pengurus = $conn->query("SELECT * FROM tb_setting WHERE jabatan = 'Pengurus Barang' AND id_user = '$_SESSION[id_user]'");
    $dataPengurus = $pengurus->fetch_assoc();
    ?>
    <tr>
      <td align="center"><?= $dataPengguna['jabatan']; ?></td>
      <td width="40%"></td>
      <td></td>
      <td align="center">Penyimpan/Pengurus Barang</td>
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
$content = $mpdf->OutputHttpInline("BAST.pdf", "I");
// $mpdf->OverWrite('Lap.pdf', 'S');
// $content = $mpdf->Output("CETAK.pdf", "I");

?>