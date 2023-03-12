<?php
if (isset($_POST['trx'])) {
  $trx = $_POST['trx'];
  $penanggungjawab = $_POST['penanggungjawab'];
  $_SESSION['trx'] = $trx;
  $_SESSION['penanggungjawab'] = $penanggungjawab;
  $arr = str_split($trx);
  $no1 =  $arr[4];
  $no2 = $arr[5];
  $tampil = $no1 . $no2;
}
?>
<div class="col-lg-8 offset-2">

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
        <input type="hidden" name="trx" value="<?= $_SESSION['trx']; ?>">
        <input type="hidden" name="id_instansi" value="<?= $data['id_instansi']; ?>">
        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
        <input type="hidden" name="id_pembelian" id="id_pembelian" value="<?= $_POST['id_pembelian']; ?>">
        <input type="hidden" name="kategori" value="<?= $_POST['kategori']; ?>" id="kategori">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="kode">Cari Barang</label>
            <a href="" class="btn btn-outline-info btn-block" data-placement="top" data-toggle="modal" data-target="#keluarModal">Cari Barang</a>
            </span>
          </div>
          <div class="form-group col-md-4">
            <label for="kode">Kode Barang</label>
            <!-- <span data-toggle="tooltip" title="Klik disini"> -->
            <input type="text" class="form-control" id="kode" name="kode" data-placement="top" data-toggle="modal" data-target="#keluarModal" value="<?= $_POST['kode']; ?>" required readonly>
            </span>
          </div>
          <div class="form-group col-md-4">
            <label for="tanggal_spb">Tanggal Permintaan</label>
            <input type="date" class="form-control" id="tanggal_spb" name="tanggal_spb" value="<?= $_POST['tanggal_spb']; ?>" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $_POST['nama_barang']; ?>" disabled>
          </div>
          <div class="form-group col-md-3">
            <label for="stok">Sisa Stok</label>
            <input type="text" class="form-control" id="stok" name="stok" value="<?= $_POST['satuan_barang']; ?>" disabled>
          </div>
          <div class="form-group col-md-3">
            <label for="satuan_barang">Satuan Barang</label>
            <input type="text" class="form-control" id="satuan_barang" name="satuan_barang" value="<?= $_POST['satuan_barang']; ?>" disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="volume">Jumlah Barang</label>
            <input type="text" class="form-control" id="volume" name="volume" onkeyup="kali()" value="<?= $_POST['volume']; ?>" placeholder="0" required>
          </div>
          <div class="form-group col-md-4">
            <label for="harga_satuan">Harga Satuan</label>
            <input type="text" class="form-control" id="harga_satuan" onkeyup="kali()" name="harga_satuan" value="<?= $_POST['harga_satuan']; ?>" placeholder="0" readonly>
          </div>
          <div class="form-group  col-md-4">
            <label for="jumlah_harga">Jumlah Harga</label>
            <input type="text" class="form-control" id="jumlah_harga" name="jumlah_harga" value="0" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="penanggungjawab">Penanggungjawab</label>
          <!-- <select class="form-control" id="penanggungjawab" name="penanggungjawab" required>
            <option>-- Pilih --</option>
              <option value="<?= $data['id_pegawai']; ?>"><?= $data['nama_pegawai']; ?></option>
            
          </select> -->
          <?php
          $sql_pegawai = $conn->query("SELECT * FROM tb_pegawai WHERE id_pegawai = '$_SESSION[penanggungjawab]'");
          $dataPegawai = $sql_pegawai->fetch_assoc();


          ?>
          <input type="hidden" class="form-control" name="penanggungjawab" value="<?= $_SESSION['penanggungjawab']; ?>" readonly>
          <input type="text" class="form-control" value="<?= $dataPegawai['nama_pegawai']; ?>" readonly>
        </div>
        <!-- <div class="form-group col-md-6">
            <label for="no_spb">No Keluar</label>
            <select class="form-control" id="no_spb" name="no_spb" required>
              <option>-- Pilih --</option>
              <?php
              $no = "001";
              for ($no = 1; $no <= 200; $no++) {
                echo "<option value='$no'>$no</option>";
              }

              ?>
            </select>
          </div>
        </div> -->
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
        <a href="pengeluaran" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>

</div>

<div class="card mb-4">
  <div class="card-header">
    Data Pengeluaran
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="tambahData" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Jumlah Harga</th>
            <th>Penanggungjawab</th>
            <th>No SPB</th>
            <th>Tanggal SPB</th>
            <th width="8%">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          // $trx = $_GET['trx'];
          $sql = $conn->query("SELECT * FROM tb_pengeluaran WHERE trx = '$_SESSION[trx]' AND ket = '-'");
          foreach ($sql as $key => $value) :
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <?php
              $kode_barang = $value['kode_barang'];
              $barang = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'");
              foreach ($barang as $key => $data) {                # code...
                echo "<td>$data[kode_barang]</td>";
                echo "<td>$data[nama_barang]</td>";
                echo "<td>$data[satuan_barang]</td>";
              }
              ?>

              <td><?= $value['volume']; ?></td>
              <td><?= number_format($value['harga_satuan']); ?></td>
              <td><?= number_format($value['jumlah_harga']); ?></td>
              <?php
              $id_pegawai = $value['penanggungjawab'];
              $pegawai = $conn->query("SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_pegawai'");
              foreach ($pegawai as $key => $data) {
                echo "<td>$data[nama_pegawai]</td>";
              }
              ?>
              <td><?= "0" . $value['no_spb'] . " / SPB / " . BulanRomawi($value['tanggal']) ?></td>
              <td><?= TanggalIndo($value['tanggal']); ?></td>
              <td>
                <a href="?page=pengeluaran&action=delete&id=<?= $value['id_pengeluaran']; ?>" name="delete" class=" delete btn btn-sm btn-circle btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $trx = $_POST['trx'];
  $id_instansi = $_POST['id_instansi'];
  $id_user = $_POST['id_user'];
  $id_pembelian = $_POST['id_pembelian'];
  $kode = $_POST['kode'];
  $volume = $_POST['volume'];
  $harga_satuan = $_POST['harga_satuan'];
  $jumlah_harga = $_POST['jumlah_harga'];
  $penanggungjawab = $_POST['penanggungjawab'];
  $no_spb = $tampil;
  $kategori = $_POST['kategori'];
  $ket = "-";
  $tanggal_spb = $_POST['tanggal_spb'];
  // $tahun = $tanggal_spb;

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

    $sql = $conn->query("INSERT INTO tb_pengeluaran (id_instansi, id_user, id_pembelian, kode_barang, volume, harga_satuan, jumlah_harga, penanggungjawab, no_spb, tanggal, trx, ket, tahun, id_kategori) VALUES ('$id_instansi','$id_user', '$id_pembelian', '$kode','$volume','$harga_satuan', '$jumlah_harga', '$penanggungjawab', '$no_spb', '$tanggal_spb', '$trx', '$ket', '$tanggal_spb', '$kategori')");
    $sql1 = $conn->query("INSERT INTO tb_pengeluaran_detail (id_instansi, id_user, id_pembelian, kode_barang, volume, harga_satuan, jumlah_harga, penanggungjawab, no_spb, tanggal, trx, ket, tahun, id_kategori) VALUES ('$id_instansi','$id_user', '$id_pembelian', '$kode','$volume','$harga_satuan', '$jumlah_harga', '$penanggungjawab', '$no_spb', '$tanggal_spb', '$trx', '$ket', '$tanggal_spb', '$kategori')");

    if (!$sql && !$sql1) {
      // die();
      echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Alhamdulillah";
      $_SESSION['desc'] = "Data berhasil ditambah";
      $_SESSION['link'] = "";

      $update_barang = $conn->query("UPDATE tb_pembelian SET volume = '$sisa' WHERE id_pembelian = '$id_pembelian'");

      $update_barang = $conn->query("UPDATE tb_saldo_awal SET volume = '$sisa' WHERE id_pembelian = '$id_pembelian'");
    }
  }
}
?>