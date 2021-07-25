<?php include('../../inc/config.php'); ?>
<!-- Proses Simpan -->
<?php
if (isset($_POST['add'])) {
  $instansi = $_POST['instansi'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];
  $tahun = date("Y-m-d");

  $sql = $conn->query("INSERT INTO tb_instansi (nama_instansi, alamat_instansi,no_telp,tahun) VALUES ('$instansi','$alamat','$telp','$tahun')");

  if ($sql) {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "?page=instansi";
?>
    <script>
      // alert("Berhasil");
      // window.location.href = "?page=instansi";
    </script>
<?php
  } else {
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  }
}
?>