<?php 
include("inc/config.php");

$kode = $_GET['kode'];
$sql = $conn->query("SELECT * FROM tb_barang WHERE kode_barang = '$kode'");
$result = $sql->fetch_array();
$data = [
  'nama_barang' => $result['nama_barang'],
  'satuan_barang' => $result['satuan_barang'],
];

echo json_encode($data);
