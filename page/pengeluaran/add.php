<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Add Data Pengeluaran
    </div>
    <div class="card-body">
      <?php
      $instansi = $conn->query("SELECT * FROM tb_instansi WHERE id_user = '$_SESSION[id_user]'");
      $data = $instansi->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" name="id_instansi" value="<?= $data['id_instansi']; ?>">
        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="kode">Kode Barang</label>
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Klik disini">
              <input type="text" class="form-control" id="kode" name="kode" data-placement="top" data-toggle="modal" data-target="#keluarModal" value="<?= $$_POST['kode']; ?>" autofocus required readonly>
            </span>
          </div>
          <div class="form-group col-md-6">
            <label for="tanggal_spb">Tanggal Permintaan</label>
            <input type="date" class="form-control" id="tanggal_spb" name="tanggal_spb" value="<?= $$_POST['tanggal_spb']; ?>" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $$_POST['nama_barang']; ?>" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="satuan_barang">Satuan Barang</label>
            <input type="text" class="form-control" id="satuan_barang" name="satuan_barang" value="<?= $$_POST['satuan_barang']; ?>" disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="volume">Jumlah Barang</label>
            <input type="text" class="form-control" id="volume" name="volume" onkeyup="kali()" value="<?= $_POST['volume']; ?>" placeholder="0" required>
          </div>
          <div class="form-group col-md-6">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="text" class="form-control" id="harga_satuan" onkeyup="kali()" name="harga_satuan" value="<?= $_POST['harga_satuan']; ?>" placeholder="0" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="jumlah_harga">Jumlah Harga</label>
          <input type="text" class="form-control" id="jumlah_harga" name="jumlah_harga" value="0" readonly>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="penanggungjawab">Penanggungjawab</label>
            <select class="form-control" id="penanggungjawab" name="penanggungjawab" required>
              <option>-- Pilih --</option>
              <?php
              $sql_pegawai = $conn->query("SELECT * FROM tb_pegawai");
              foreach ($sql_pegawai as $key => $data) :

              ?>
                <option value="<?= $data['id_pegawai']; ?>"><?= $data['nama_pegawai']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <?php

          $query = $conn->query("SELECT MAX(no_spb) AS spb FROM tb_pengeluaran");
          $data = $query->fetch_assoc();
          $kodeBarang = $data['spb'];
          $urutan = (int) substr($kodeBarang, 9, 4) + 1;
          $kodeBarang = sprintf("%', 04d", $urutan);
          $kode_spb = "00" . $urutan . " / SPB / " . date('Y');
          // echo $invoice;

          ?>
          <div class="form-group">
            <label for="no_spb">No SPB</label>
            <input type="text" class="form-control" value="<?= $kode_spb; ?>" id="no_spb" name="no_spb">
          </div>
        </div>
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $id_instansi = $_POST['id_instansi'];
  $id_user = $_POST['id_user'];
  $kode = $_POST['kode'];
  $volume = $_POST['volume'];
  $harga_satuan = $_POST['harga_satuan'];
  $jumlah_harga = $_POST['jumlah_harga'];
  $penanggungjawab = $_POST['penanggungjawab'];
  $no_spb = $_POST['no_spb'];
  $tanggal_spb = $_POST['tanggal_spb'];

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

    $sql = $conn->query("INSERT INTO tb_pengeluaran (id_instansi, id_user,kode_barang, volume, harga_satuan, jumlah_harga, penanggungjawab, no_spb, tanggal_spb) VALUES ('$id_instansi','$id_user','$kode','$volume','$harga_satuan', '$jumlah_harga', '$penanggungjawab', '$no_spb', '$tanggal_spb')");

    if (!$sql) {
      // die();
      echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Alhamdulillah";
      $_SESSION['desc'] = "Data berhasil ditambah";
      $_SESSION['link'] = "pengeluaran";

      $update_barang = $conn->query("UPDATE tb_pembelian SET volume = '$sisa' WHERE kode_barang = '$kode'");
    }
  }
}
?>