<?php
$id = $_GET['id'];
$sql = $conn->query("DELETE FROM tb_pembelian WHERE id_pembelian = $id");

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
      window.location.replace('pembelian');
    }, 3000);
  </script>
<?php
}
?>