<?php
$id = base64_decode(urldecode($_GET['id']));

$sql = $conn->query("DELETE FROM tb_barang WHERE id_barang = $id");

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
      window.location.replace('barang');
    }, 3000);
  </script>
<?php
}
