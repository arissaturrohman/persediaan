<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Edit Data Instansi
    </div>
    <div class="card-body">
      <?php
      $id_edit = base64_decode(urldecode($_GET['id']));
      $sql = $conn->query("SELECT * FROM tb_barang WHERE id_barang = '$id_edit'");
      $data = $sql->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" class="form-control" id="id_barang" name="id_barang" value="<?= $data['id_barang']; ?>" autofocus>
        <div class="form-group">
          <label for="kode_barang">Kode Barang</label>
          <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $data['kode_barang']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="nama_barang">Nama Barang</label>
          <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $data['nama_barang']; ?>">
        </div>
        <div class="form-group">
          <label for="kategori">Kategori</label>
          <select class="form-control" id="kategori" name="kategori">
            <option>-- Pilih --</option>
            <?php
            // $id_kategori = $data['id_kategori'];
            $sql_kategori = $conn->query("SELECT * FROM tb_kategori");
            foreach ($sql_kategori as $key => $data_kategori) :
              if ($data['id_kategori'] == $data_kategori['id_kategori']) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo "<option value='$data_kategori[id_kategori]' $selected>$data_kategori[kategori]</option>";
            ?>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="satuan_barang">Satuan Barang</label>
          <input type="text" class="form-control" id="satuan_barang" name="satuan_barang" value="<?= $data['satuan_barang']; ?>">
        </div>
        <button type="submit" name="edit" class="btn btn-sm btn-primary">Submit</button>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['edit'])) {
  $id = $_POST['id_barang'];
  $kategori = $_POST['kategori'];
  $kode_barang = $_POST['kode_barang'];
  $nama_barang = $_POST['nama_barang'];
  $satuan_barang = $_POST['satuan_barang'];

  $sql = $conn->query("UPDATE tb_barang SET id_kategori = '$kategori', kode_barang = '$kode_barang' ,nama_barang = '$nama_barang', satuan_barang = '$satuan_barang' WHERE id_barang = '$id'");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil diedit";
    $_SESSION['link'] = "barang";
  }
}
?>