<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Add Data Kategori
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="kategori">Nama Kategori</label>
          <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $_POST['kategori']; ?>" autofocus>
        </div>
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
        <a href="kategori" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>
</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $kategori = $_POST['kategori'];

  $sql = $conn->query("INSERT INTO tb_kategori (kategori) VALUES ('$kategori')");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "kategori";
  }
}
?>