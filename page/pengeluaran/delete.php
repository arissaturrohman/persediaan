<?php
$id = $_GET['id'];

$keluar = $conn->query("SELECT * FROM tb_pengeluaran WHERE id_pengeluaran = '$id'");
$dataKeluar = $keluar->fetch_assoc();
$stok = $dataKeluar['volume'];
$kode_barang = $dataKeluar['kode_barang'];
$id_pembelian = $dataKeluar['id_pembelian'];

$pembelian = $conn->query("SELECT * FROM tb_pembelian WHERE id_pembelian = '$id_pembelian'");
$dataBeli = $pembelian->fetch_assoc();
$volume = $dataBeli['volume'];

$tambahStok = $stok + $volume;

$update_stok = $conn->query("UPDATE tb_pembelian SET volume = '$tambahStok' WHERE id_pembelian = '$id_pembelian'");


$sql = $conn->query("DELETE FROM tb_pengeluaran WHERE id_pengeluaran = $id");

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
      window.location.replace('pengeluaran');
    }, 3000);
  </script>
<?php
}
?>