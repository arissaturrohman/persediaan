<h5 class="h5 mb-4 text-gray-800">Data Barang</h5>

<div class="row">
  <div class="col-md-6">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">

        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="fileimport" class="custom-file-input custom-file-input-sm" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
          <div class="input-group-append">
            <a href="data.xlsx" class="btn btn-outline-info">Template</a>
          </div>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" name="import" class="btn btn-dark btn-sm">Import</button>
      </div>
    </form>
  </div>
</div>
<!-- DataTales Example -->
<div class="card shadow my-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Satuan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = $conn->query("SELECT * FROM tb_barang");
          foreach ($sql as $key => $value) :

          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['kode_barang']; ?></td>
              <td><?= $value['nama_barang']; ?></td>
              <?php
              $id_kategori = $value['id_kategori'];
              $kategori = $conn->query("SELECT * FROM tb_kategori WHERE id_kategori = '$id_kategori'");
              foreach ($kategori as $key => $data_kategori) {
                echo "<td>$data_kategori[kategori]</td>";
              }
              ?>

              <td><?= $value['satuan_barang']; ?></td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['fileimport']['name']) && in_array($_FILES['fileimport']['type'], $file_mimes)) {

  $arr_file = explode('.', $_FILES['fileimport']['name']);
  $extension = end($arr_file);

  if ('csv' == $extension) {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
  } else {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  }

  $spreadsheet = $reader->load($_FILES['fileimport']['tmp_name']);

  $sheetData = $spreadsheet->getActiveSheet()->toArray();
  for ($i = 1; $i < count($sheetData); $i++) {
    $kategori = $sheetData[$i]['0'];
    $kode = $sheetData[$i]['1'];
    $nama = $sheetData[$i]['2'];
    $satuan = $sheetData[$i]['3'];
    $sql = $conn->query("INSERT INTO tb_barang (id_kategori,kode_barang,nama_barang,satuan_barang) VALUES ('$kategori','$kode','$nama','$satuan')");
  }
  if (!$sql) {
    // die();
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Alhamdulillah";
    $_SESSION['desc'] = "Data berhasil diimport";
    $_SESSION['link'] = "";
  }
}

?>