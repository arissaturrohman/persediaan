<?php
$tahun = $_SESSION['tahun'];
$query = mysqli_query($conn, "SELECT max(trx) as kodeTerbesar FROM tb_pengeluaran WHERE year(tahun) = '$tahun'");
$data = mysqli_fetch_array($query);
$trx = $data['kodeTerbesar'];

// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($trx, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya TRX 
$huruf = "TRX";
$trx = $huruf . sprintf("%03s", $urutan);
// echo $trx;
?>

<h5 class="h5 mb-4 text-gray-800">Data Pengeluaran</h5>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="?page=pengeluaran&action=addJab" class="btn btn-sm btn-outline-primary">Tambah</a>
    <a href="?page=pengeluaran&action=addImport" class="btn btn-sm btn-outline-info float-right">Saldo Awal</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Bulan</th>
            <th>Kode Trx</th>
            <th>Jumlah Total</th>
            <th width="8%">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = $conn->query("SELECT * FROM tb_pengeluaran WHERE id_user = '$_SESSION[id_user]' AND year(tahun) = '$_SESSION[tahun]' GROUP BY trx");
          foreach ($sql as $key => $value) :
            $kodeTrx = $value['trx'];
            $ket = $value['ket'];

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $bulanTrx = BulanIndo($value['tanggal']); ?></td>
              <td><?= $value['trx']; ?></td>
              <?php $sqlTotal = $conn->query("SELECT SUM(jumlah_harga) AS total FROM tb_pengeluaran WHERE trx = '$kodeTrx'");
              $datatotal = $sqlTotal->fetch_assoc();
              ?>
              <td><?= number_format($datatotal['total']); ?></td>
              <td>
                <?php
                if ($ket == '-') {
                  $queryPegawai = $conn->query("SELECT * FROM tb_pengeluaran_detail WHERE trx = '$kodeTrx'");
                  $dataPegawai = $queryPegawai->fetch_assoc();
                ?>
                  <form action="?page=pengeluaran&action=add&trx=<?= $kodeTrx; ?>" method="POST">
                    <input type="hidden" name="trx" value="<?= $kodeTrx; ?>">
                    <input type="hidden" name="penanggungjawab" value="<?= $dataPegawai['penanggungjawab']; ?>">
                    <button type="submit" name="kirim" class="btn btn-sm btn-circle btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye"></i></button>
                  </form>
                <?php
                } else {
                  $queryPegawai = $conn->query("SELECT * FROM tb_pengeluaran_detail WHERE trx = '$kodeTrx'");
                  $dataPegawai = $queryPegawai->fetch_assoc();
                ?>
                  <form action="?page=pengeluaran&action=import&trx=<?= $kodeTrx; ?>" method="post">
                    <input type="hidden" name="trx" value="<?= $kodeTrx; ?>">
                    <input type="hidden" name="penanggungjawab" value="<?= $dataPegawai['penanggungjawab']; ?>">
                    <button type="submit" name="kirim" class="btn btn-sm btn-circle btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye"></i></button>
                  </form>

                <?php
                }
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>