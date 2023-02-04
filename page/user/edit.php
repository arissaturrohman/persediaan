<?php
$id = $_GET['id'];
$sql = $conn->query("SELECT * FROM tb_user WHERE id_user = '$id'");
$data = $sql->fetch_assoc();
?>
<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Edit Data User
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $data['id_user']; ?>">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama_user']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" value="<?= $data['username']; ?>">
        </div>
        <div class="form-group">
          <label for="level">Level</label>
          <select name="level" class="form-control" required>
            <option>Pilih Level</option>
            <?php
            if ($data['level'] == 'admin') {
            ?>
              <option value="admin" selected>Admin</option>
              <option value="user">User</option>
            <?php
            } else {
            ?>
              <option value="admin">Admin</option>
              <option value="user" selected>User</option>
            <?php
            }
            ?>
          </select>
        </div>
        <button type="submit" name="add" class="btn btn-sm btn-primary">Submit</button>
        <a href="user" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>

</div>

<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $level = $_POST['level'];

  // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = $conn->query("UPDATE tb_user SET nama_user = '$nama', username = '$username', level = '$level' WHERE id_user = '$id'");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil diubah";
    $_SESSION['link'] = "user";
  }
}
?>