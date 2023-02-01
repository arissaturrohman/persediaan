<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Add Data Saldo Awal
    </div>
    <div class="card-body">
      <?php
      $instansi = $conn->query("SELECT * FROM tb_instansi WHERE id_user = '$_SESSION[id_user]'");
      $data = $instansi->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" name="id_instansi" value="<?= $data['id_instansi']; ?>">
        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
        <input type="hidden" name="id_pembelian" id="id_pembelian" value="<?= $_POST['id_pembelian']; ?>">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="kode">Cari Barang</label>
            <a href="" class="btn btn-outline-info btn-block" data-placement="top" data-toggle="modal" data-target="#saldoModal">Klik disini</a>
            </span>
          </div>
          <div class="form-group col-md-4">
            <label for="kode">Kode Barang</label>
            <span data-toggle="tooltip" title="Klik disini">
              <input type="text" class="form-control" id="kode" name="kode" data-placement="top" data-toggle="modal" data-target="#kodeModal" required readonly>
            </span>
          </div>
          <div class="form-group col-md-4">
            <label for="tanggal_beli">Tanggal Input</label>
            <input type="date" class="form-control" id="tanggal_input" name="tanggal_input" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="satuan_barang">Satuan Barang</label>
            <input type="text" class="form-control" id="satuan_barang" name="satuan_barang" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="satuan_barang">Sisa Stok</label>
            <input type="text" class="form-control" id="volume" name="sisa" disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="volume">Jumlah Barang</label>
            <input type="text" class="form-control" id="volume" name="volume" onkeyup="kali()" value="<?= $_POST['volume']; ?>" placeholder="0" required>
          </div>
          <div class="form-group col-md-6">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="text" class="form-control" id="harga_satuan" onkeyup="kali()" name="harga_satuan" value="<?= $_POST['harga_satuan']; ?>" placeholder="0" required>
          </div>
        </div>
        <div class="form-group">
          <label for="jumlah_harga">Jumlah Harga</label>
          <input type="text" class="form-control" id="jumlah_harga" name="jumlah_harga" value="0" readonly>
        </div>
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
        <a href="saldo" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $id_pembelian = $_POST['id_pembelian'];
  $id_instansi = $_POST['id_instansi'];
  $id_user = $_POST['id_user'];
  $kode = $_POST['kode'];
  $volume = $_POST['volume'];
  $harga_satuan = $_POST['harga_satuan'];
  $jumlah_harga = $_POST['jumlah_harga'];
  $tanggal_input = $_POST['tanggal_input'];
  $tahun = date('Y');

  $sql_stok = $conn->query("SELECT * FROM tb_pembelian WHERE kode_barang = '$kode'");
  $result = $sql_stok->fetch_assoc();
  $stok = $result['volume'];
  $sisa = $stok - $volume;

  if ($stok < $volume) {
?>
    <script language="JavaScript">
      alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
    </script>
<?php
  } else {

    $sql = $conn->query("INSERT INTO tb_saldo_awal (id_pembelian,id_instansi, id_user, kode_barang, volume, harga_satuan, jumlah_harga, tanggal) VALUES ('$id_pembelian','$id_instansi','$id_user','$kode','$volume','$harga_satuan', '$jumlah_harga', '$tanggal_input')");

    $sql1 = $conn->query("INSERT INTO tb_saldo_awal_detail (id_pembelian,id_instansi, id_user, kode_barang, volume, harga_satuan, jumlah_harga, tanggal) VALUES ('$id_pembelian','$id_instansi','$id_user','$kode','$volume','$harga_satuan', '$jumlah_harga', '$tanggal_input')");

    if (!$sql && $sql1) {
      echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Alhamdulillah";
      $_SESSION['desc'] = "Saldo berhasil ditambah";
      $_SESSION['link'] = "saldo";

      $hapusBarang = $conn->query("DELETE FROM tb_pembelian WHERE id_pembelian = '$id_pembelian'");
    }
  }
}
?>