<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Edit Data Kategori
    </div>
    <div class="card-body">
      <?php
      $id_edit = base64_decode(urldecode($_GET['id']));
      $sql = $conn->query("SELECT * FROM tb_kategori WHERE id_kategori = '$id_edit'");
      $data = $sql->fetch_assoc();
      ?>
      <form action="" method="POST">
        <input type="hidden" class="form-control" id="id_kategori" name="id_kategori" value="<?= $data['id_kategori']; ?>">
        <div class="form-group">
          <label for="instansi">Nama Kategori</label>
          <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $data['kategori']; ?>" autofocus>
        </div>
        <button type="submit" name="edit" class="btn btn-sm btn-primary">Submit</button>
        <a href="kategori" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>
</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['edit'])) {
  $id = $_POST['id_kategori'];
  $kategori = $_POST['kategori'];

  $sql = $conn->query("UPDATE tb_kategori SET kategori = '$kategori' WHERE id_kategori = '$id'");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil diedit";
    $_SESSION['link'] = "kategori";
  }
}
?>