<?php
include("inc/config.php");
$kode_barang = $_GET['query'];
$sql = $conn->query("SELECT * FROM tb_barang ");
