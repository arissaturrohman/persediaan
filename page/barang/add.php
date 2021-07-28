<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Add Data Barang
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="kode_barang">Kode Barang</label>
          <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $_POST['kode_barang']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="nama_barang">Nama Barang</label>
          <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $_POST['nama_barang']; ?>">
        </div>
        <div class="form-group">
          <label for="kategori">Kategori</label>
          <select class="form-control" id="kategori" name="kategori">
            <option>-- Pilih --</option>
            <?php
            $sql_kategori = $conn->query("SELECT * FROM tb_kategori");
            foreach ($sql_kategori as $key => $data) :

            ?>
              <option value="<?= $data['id_kategori']; ?>"><?= $data['kategori']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="satuan_barang">Satuan Barang</label>
          <input type="text" class="form-control" id="satuan_barang" name="satuan_barang" value="<?= $_POST['satuan_barang']; ?>">
        </div>
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
        <a href="barang" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $kode_barang = $_POST['kode_barang'];
  $nama_barang = $_POST['nama_barang'];
  $kategori = $_POST['kategori'];
  $satuan_barang = $_POST['satuan_barang'];

  $sql = $conn->query("INSERT INTO tb_barang (id_kategori, kode_barang,nama_barang, satuan_barang) VALUES ('$kategori', '$kode_barang', '$nama_barang','$satuan_barang')");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "barang";
  }
}
?>