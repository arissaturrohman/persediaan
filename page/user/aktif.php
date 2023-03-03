<div class="col-lg-6 offset-3">

  <!-- Default Card Example -->
  <div class="card mb-4">
    <div class="card-header">
      Form Aktivasi
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
          <label for="aktif_lama">Aktivasi Lama</label>
          <input type="text" class="form-control" id="aktif_lama" name="aktif_lama" value="<?= date("d-m-Y", strtotime($data['tgl_aktivasi'])); ?>" readonly>
        </div>
        <div class="form-group">
          <label for="aktivasi_baru">Aktivasi Baru</label>
          <input type="date" class="form-control" id="aktivasi_baru" name="aktivasi_baru" required>

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

  $sql = $conn->query("SELECT * FROM tb_user WHERE username='$username'");

  if (mysqli_num_rows($sql) === 1) {

    $row = mysqli_fetch_assoc($sql);
    //enkripsi password
    $aktivasi_baru = $_POST["aktivasi_baru"];
    $sql_edit = $conn->query("UPDATE tb_user SET tgl_aktivasi='$aktivasi_baru' WHERE id_user='$id'");

    if (!$sql_edit) {
      // die();
      echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Alhamdulillah";
      $_SESSION['desc'] = "Aktivasi berhasil diperpanjang";
      $_SESSION['link'] = "user";
    }
  }
}
?>