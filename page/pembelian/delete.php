<?php
$id = base64_decode(urldecode($_GET['id']));
$sql = $conn->query("DELETE FROM tb_pegawai WHERE id_pegawai = $id");

if ($sql) {
?>
  <script>
    setTimeout(function() {
      swal({
        title: 'Alhamdulillah',
        text: 'Data berhasil dihapus',
        icon: 'success',
        timer: 3000,
        button: false
      });
    }, 10);
    window.setTimeout(function() {
      window.location.replace('pegawai');
    }, 3000);
  </script>
<?php
}
?>