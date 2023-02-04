<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Ganti Password
    </div>
    <div class="card-body">
      <?php

      $id = $_GET['id'];
      $sql = $conn->query("SELECT * FROM tb_user WHERE id_user = '$id'");
      $data = $sql->fetch_assoc();

      ?>
      <form action="" method="POST">
        <input type="hidden" class="form-control" id="username" name="username" value="<?= $data['username']; ?>">
        <div class="form-group">
          <label for="pass">Password Lama</label>
          <input type="password" class="form-control" id="password" name="password_lama" placeholder="Password Lama" required>
        </div>
        <div class="form-group">
          <label for="password">Password Baru</label>
          <input type="password" class="form-control" id="password" name="password_baru" placeholder="Password Baru" required>
        </div>
        <button type="submit" name="edit" class="btn btn-sm btn-primary">Submit</button>
        <a href="user" class="btn btn-sm btn-dark">Cancel</a>
      </form>
    </div>
  </div>
</div>
<?php
if (isset($_POST['edit'])) {

  $username  = mysqli_real_escape_string($conn, $_POST['username']);
  $password_lama  = mysqli_real_escape_string($conn, $_POST['password_lama']);

  $sql = $conn->query("SELECT * FROM tb_user WHERE username='$username'");

  if (mysqli_num_rows($sql) === 1) {

    $row = mysqli_fetch_assoc($sql);
    if (password_verify($password_lama, $row['password'])) {


      //enkripsi password
      $password_baru = password_hash($_POST["password_baru"], PASSWORD_DEFAULT);
      $sql_edit = $conn->query("UPDATE tb_user SET password='$password_baru' WHERE id_user='$id'");

      if (!$sql_edit) {
        // die();
        echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
        $conn->close();
      } else {
        $_SESSION['status'] = "Alhamdulillah";
        $_SESSION['desc'] = "Password berhasil diubah";
        $_SESSION['link'] = "logout.php";
      }
    } else {
?>
      <script type="text/javascript">
        alert("Password lama tidak sesuai..!");
      </script>
<?php
    }
  }
}
?>