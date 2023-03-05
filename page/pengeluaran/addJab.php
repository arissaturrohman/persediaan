<?php
$setting = $conn->query("SELECT * FROM tb_pegawai WHERE  id_user = '$_SESSION[id_user]'");
$result = $setting->fetch_assoc();
if (is_null($result['nama_pegawai'])) {
?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    Silahkan isi terlebih dahulu <strong>Data Pegawai</strong> di menu
    Data Master
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
} else {
?>

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
  <div class="card shadow mb-4 col-6">
    <div class="card-body">
      <form action="?page=pengeluaran&action=add" method="POST">
        <div class="form-group">
          <label for="penanggungjawab">Penanggungjawab</label>
          <select class="form-control" id="penanggungjawab" name="penanggungjawab" required>
            <option>-- Pilih --</option>
            <?php
            $sql_pegawai = $conn->query("SELECT * FROM tb_pegawai WHERE id_user = '$_SESSION[id_user]'");
            foreach ($sql_pegawai as $key => $data) :

            ?>
              <option value="<?= $data['id_pegawai']; ?>"><?= $data['nama_pegawai']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <input type="hidden" name="trx" value="<?= $trx; ?>">
        <div class="form-row float-right">
          <a href="pengeluaran" class="btn btn-sm btn-dark mr-2">Cancel</a>
          <button type="submit" name="kirim" id="jajal" class="btn btn-sm btn-info ">Pilih</button>
        </div>
    </div>
    </form>
  </div>
<?php
} ?>