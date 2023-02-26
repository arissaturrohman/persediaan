<?php
$id = $_GET['id'];
$sql = $conn->query("DELETE FROM tb_pembelian WHERE id_pembelian = $id");
$sql1 = $conn->query("DELETE FROM tb_pembelian_detail WHERE id_pembelian = $id");
$sql2 = $conn->query("DELETE FROM tb_transaksi WHERE id_transaksi = $id");

if ($sql && $sql1) {
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