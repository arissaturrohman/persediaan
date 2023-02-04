<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Add Data User
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= $_POST['nama']; ?>" autofocus>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" value="<?= $_POST['username']; ?>">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" value="<?= $_POST['password']; ?>">
        </div>
        <div class="form-group">
          <label for="level">Level</label>
          <select name="level" class="form-control" required>
            <option>Pilih Level</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
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

  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = $conn->query("INSERT INTO tb_user (nama_user, username, password, level) VALUES ('$nama','$username','$password','$level')");

  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "?page=user";
  }
}
?>