<?php

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
} elseif ($page == "user") {
  if ($action == "") {
    include "page/user/user.php";
  } elseif ($action == "add") {
    include "page/user/add.php";
  } elseif ($action == "edit") {
    include "page/user/edit.php";
  } elseif ($action == "delete") {
    include "page/user/delete.php";
  }
} elseif ($page == "saldo") {
  if ($action == "") {
    include "page/saldo/saldo.php";
  } elseif ($action == "add") {
    include "page/saldo/add.php";
  }
} else {
  include "layout/dashboard.php";
}
