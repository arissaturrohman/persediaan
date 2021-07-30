<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Edit Data Pengeluaran
    </div>
    <div class="card-body">
      <?php
      $id_edit = base64_decode(urldecode($_GET['id']));
      $sql = $conn->query("SELECT * FROM tb_pengeluaran WHERE id_pengeluaran = '$id_edit'");
      $data = $sql->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" name="trx" value="<?= $_GET['trx']; ?>">
        <input type="hidden" name="id_instansi" value="<?= $data['id_instansi']; ?>">
        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
        <input type="hidden" name="id_pembelian" id="id_pembelian" value="<?= $data['id_pembelian']; ?>">
        <input type="hidden" name="id_pengeluaran" id="id_pengeluaran" value="<?= $data['id_pengeluaran']; ?>">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="kode">Kode Barang</label>
            <span data-toggle="tooltip" title="Klik disini">
              <input type="text" class="form-control" id="kode" name="kode" data-placement="top" data-toggle="modal" data-target="#keluarModal" value="<?= $data['kode_barang']; ?>" autofocus required readonly>
            </span>
          </div>
          <div class="form-group col-md-6">
            <label for="tanggal_spb">Tanggal Permintaan</label>
            <input type="date" class="form-control" id="tanggal_spb" name="tanggal_spb" value="<?= $data['tanggal_spb']; ?>" required>
          </div>
        </div>
        <?php
        $id_barang = $data['kode_barang'];
        $sql_barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$id_barang'");
        $dataBarang = $sql_barang->fetch_assoc();
        ?>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $dataBarang['nama_barang']; ?>" disabled>
          </div>
          <?php
          $id_beli = $data['id_pembelian'];
          $sql_beli = $conn->query("SELECT * FROM tb_pembelian WHERE id_pembelian = '$id_beli'");
          $dataBeli = $sql_beli->fetch_assoc();
          ?>
          <div class="form-group col-md-3">
            <label for="stok">Sisa Stok</label>
            <input type="text" class="form-control" id="stok" name="stok" value="<?= $dataBeli['volume']; ?>" disabled>
          </div>
          <div class="form-group col-md-3">
            <label for="satuan_barang">Satuan Barang</label>
            <input type="text" class="form-control" id="satuan_barang" name="satuan_barang" value="<?= $dataBarang['satuan_barang']; ?>" disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="volume">Jumlah Barang</label>
            <input type="text" class="form-control" id="volume" name="volume" onkeyup="kali()" value="<?= $data['volume']; ?>" placeholder="0" required>
          </div>
          <div class="form-group col-md-6">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="text" class="form-control" id="harga_satuan" onkeyup="kali()" name="harga_satuan" value="<?= $data['harga_satuan']; ?>" placeholder="0" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="jumlah_harga">Jumlah Harga</label>
          <input type="text" class="form-control" id="jumlah_harga" name="jumlah_harga" value="<?= $data['jumlah_harga']; ?>" readonly>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="penanggungjawab">Penanggungjawab</label>
            <select class="form-control" id="penanggungjawab" name="penanggungjawab" required>
              <option>-- Pilih --</option>
              <?php
              // $id_pegawai = $data['penangungjawab'];
              $sql_pegawai = $conn->query("SELECT * FROM tb_pegawai");
              foreach ($sql_pegawai as $key => $dataPegawai) :
                if ($data['penanggungjawab'] == $dataPegawai['id_pegawai']) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
                echo "<option value='$dataPegawai[id_pegawai]' $selected>$dataPegawai[nama_pegawai]</option>";
              ?>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="no_spb">No Keluar</label>
            <select class="form-control" id="no_spb" name="no_spb" required>
              <option>-- Pilih --</option>
              <?php
              $no = "001";
              for ($no = 1; $no <= 200; $no++) {
                if ($data['no_spb'] == $no) {
                  $select = "selected";
                } else {
                  $select = "";
                }
                echo "<option value='$no'$select>$no</option>";
              }

              ?>
            </select>
          </div>
        </div>
        <button type="submit" name="edit" class="btn btn-sm btn-primary">Submit</button>
        <a href="pengeluaran" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['edit'])) {
  $trx = $_POST['trx'];
  $id_instansi = $_POST['id_instansi'];
  $id_user = $_POST['id_user'];
  $id_pembelian = $_POST['id_pembelian'];
  $id_pengeluaran = $_POST['id_pengeluaran'];
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

    // Cek apakah stok bertambah atau berkurang
    $cekStok = $conn->query("SELECT * FROM tb_pengeluaran WHERE id_pengeluaran = '$id_pengeluaran'");
    $dataCek = $cekStok->fetch_assoc();
    $stokAwal = $dataCek['volume'];
    $cekVolume = $stokAwal - $volume;
    $stokAkhir = $cekVolume + $stok;
    // var_dump($stokAkhir);
    // die;
    $sql = $conn->query("UPDATE tb_pengeluaran SET id_instansi = '$id_instansi', id_user = '$id_user', id_pembelian = '$id_pembelian', kode_barang = '$kode', volume = '$volume', harga_satuan = '$harga_satuan', jumlah_harga = '$jumlah_harga', penanggungjawab = '$penanggungjawab', no_spb = '$no_spb', tanggal_spb = '$tanggal_spb', trx = '$trx' WHERE id_pengeluaran = '$id_pengeluaran'");

    if ($stokAwal < $volume) {
      $update_stok = $conn->query("UPDATE tb_pembelian SET volume = '$cekVolume' WHERE id_pembelian = '$id_pembelian'");
    }
    if ($stokAwal > $volume) {
      $update_stok = $conn->query("UPDATE tb_pembelian SET volume = '$stokAkhir' WHERE id_pembelian = '$id_pembelian'");
    }

    if (!$sql) {
      // die();
      echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Alhamdulillah";
      $_SESSION['desc'] = "Data berhasil ditambah";
      $_SESSION['link'] = "pengeluaran";
    }
  }
}


?>