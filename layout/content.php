<?php


$aktif = $conn->query("SELECT * FROM tb_user WHERE  id_user = '$_SESSION[id_user]'");
$hasil = $aktif->fetch_assoc();
// $current_date = date('Y-m-d');
$hitung_hari = strtotime($hasil['tgl_aktivasi']) - strtotime(date('Y-m-d'));
$selisih_hari = round($hitung_hari / (60 * 60 * 14));
if ($selisih_hari <= 5 &&  $selisih_hari >= 0 && $hitung_hari != $hasil['tgl_aktivasi']) {
  if ($selisih_hari == $hitung_hari) {
    $tgl = '<b>hari ini</b>';
  } else {
    $tgl = "dalam <b>".$selisih_hari." hari</b>";
  }
?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <b>Perhatian</b>, masa aktif akun Anda akan berakhir <?= $tgl; ?>. <br> Silahkan hubungi admin untuk perpanjang akun Anda. <br>
    <strong>WA : 089677017239 (Aris)</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
}
if ($hasil['tgl_aktivasi'] < date("Y-m-d")) {
?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Masa aktif akun Anda telah berakhir sejak tanggal <b><?= TanggalIndo($hasil['tgl_aktivasi']); ?></b>. Untuk sementara tidak dapat menggunakan fasilitas aplikasi ini.<br> Silahkan hubungi admin untuk aktivasi akun Anda. <br>
    <strong>WA : 089677017239</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
} else {


  $page = $_GET['page'];
  $action = $_GET['action'];

  if ($page == "instansi") {
    if ($action == "") {
      include "page/instansi/instansi.php";
    } elseif ($action == "add") {
      include "page/instansi/add.php";
    } elseif ($action == "edit") {
      include "page/instansi/edit.php";
    } elseif ($action == "delete") {
      include "page/instansi/delete.php";
    }
  } elseif ($page == "setting") {
    if ($action == "") {
      include "page/setting/setting.php";
    } elseif ($action == "add") {
      include "page/setting/add.php";
    } elseif ($action == "edit") {
      include "page/setting/edit.php";
    } elseif ($action == "delete") {
      include "page/setting/delete.php";
    }
  } elseif ($page == "pegawai") {
    if ($action == "") {
      include "page/pegawai/pegawai.php";
    } elseif ($action == "add") {
      include "page/pegawai/add.php";
    } elseif ($action == "edit") {
      include "page/pegawai/edit.php";
    } elseif ($action == "delete") {
      include "page/pegawai/delete.php";
    }
  } elseif ($page == "barang") {
    if ($action == "") {
      include "page/barang/barang.php";
    } elseif ($action == "add") {
      include "page/barang/add.php";
    } elseif ($action == "edit") {
      include "page/barang/edit.php";
    } elseif ($action == "delete") {
      include "page/barang/delete.php";
    } elseif ($action == "import") {
      include "page/barang/import.php";
    }
  } elseif ($page == "kategori") {
    if ($action == "") {
      include "page/kategori/kategori.php";
    } elseif ($action == "add") {
      include "page/kategori/add.php";
    } elseif ($action == "edit") {
      include "page/kategori/edit.php";
    } elseif ($action == "delete") {
      include "page/kategori/delete.php";
    }
  } elseif ($page == "pembelian") {
    if ($action == "") {
      include "page/pembelian/pembelian.php";
    } elseif ($action == "add") {
      include "page/pembelian/add.php";
    } elseif ($action == "edit") {
      include "page/pembelian/edit.php";
    } elseif ($action == "delete") {
      include "page/pembelian/delete.php";
    }
  } elseif ($page == "pengeluaran") {
    if ($action == "") {
      include "page/pengeluaran/pengeluaran.php";
    } elseif ($action == "addJab") {
      include "page/pengeluaran/addJab.php";
    } elseif ($action == "addImport") {
      include "page/pengeluaran/addImport.php";
    } elseif ($action == "add") {
      include "page/pengeluaran/add.php";
    } elseif ($action == "edit") {
      include "page/pengeluaran/edit.php";
    } elseif ($action == "edit_trx") {
      include "page/pengeluaran/edit_trx.php";
    } elseif ($action == "delete") {
      include "page/pengeluaran/delete.php";
    } elseif ($action == "import") {
      include "page/pengeluaran/import_saldo.php";
    } elseif ($action == "deletesaldo") {
      include "page/pengeluaran/deletesaldo.php";
    }
  } elseif ($page == "laporan") {
    if ($action == "") {
      include "page/laporan/laporan.php";
    }
  } elseif ($page == "user") {
    if ($action == "") {
      include "page/user/user.php";
    } elseif ($action == "add") {
      include "page/user/add.php";
    } elseif ($action == "edit") {
      include "page/user/edit.php";
    } elseif ($action == "delete") {
      include "page/user/delete.php";
    } elseif ($action == "gantiPass") {
      include "page/user/gantiPass.php";
    } elseif ($action == "aktif") {
      include "page/user/aktif.php";
    } elseif ($action == "reset") {
      include "page/user/reset.php";
    }
  } elseif ($page == "saldo") {
    if ($action == "") {
      include "page/saldo/saldo.php";
    } elseif ($action == "add") {
      include "page/saldo/add.php";
    }
  } elseif ($page == "sisa") {
    if ($action == "") {
      include "page/pembelian/sisa.php";
    }
  }else {
    include "layout/dashboard.php";
  }
}
