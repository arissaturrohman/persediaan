<?php
$setting = $conn->query("SELECT * FROM tb_setting WHERE  id_user = '$_SESSION[id_user]'");
$result = $setting->fetch_assoc();
if (is_null($result['nama'])) {
?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    Silahkan isi terlebih dahulu Pengguna Barang, Pengurus Barang dan Penatausaha Barang di menu
    <strong>Setting</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
} else {
?>
  <!-- Page Heading -->
  <h5 class="h5 mb-4 text-gray-800">Dashboard </h5>
<?php } ?>