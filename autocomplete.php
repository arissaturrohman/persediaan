<?php
include("inc/config.php");
// Get Search Term
$searchTerm = $_GET['term'];

// Menampilkan Database
$query = $conn->query("SELECT * FROM tb_barang WHERE kode_barang LIKE '%" . $searchTerm . "%' OR nama_barang LIKE '%" . $searchTerm . "%' ORDER BY kode_barang ASC");

// Generate Array dengan data
$usernameData = array();
if ($query->num_rows > 0) {
  while ($row = $query->fetch_assoc()) {
    $data['value'] = $row['kode_barang'] . " | " . $row['nama_barang'];
    array_push($usernameData, $data);
  }
}



// Mengembalikan hasil sebagai array Json
echo json_encode($usernameData);
