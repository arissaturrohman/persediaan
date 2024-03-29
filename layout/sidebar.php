<?php
//menampilkan menu
if ($_SESSION['level'] == "admin") {
  $display = "";
} else {
  $display = "d-none";
}
?>

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-clone"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Si.... </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?php if ($uri_segments[4] == "") {
                      echo 'active';
                    } ?>">
  <a class="nav-link" href="./">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">


<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item 
<?php if ($uri_segments[4] == "instansi") {
  echo 'active';
} elseif ($uri_segments[4] == "pegawai") {
  echo 'active';
} elseif ($uri_segments[4] == "barang") {
  echo 'active';
} elseif ($uri_segments[4] == "kategori") {
  echo 'active';
} ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-folder-open"></i>
    <span>Data Master</span>
  </a>
  <div id="collapseTwo" class="collapse 
  <?php if ($uri_segments[4] == "instansi") {
    echo 'show';
  } elseif ($uri_segments[4] == "pegawai") {
    echo 'show';
  } elseif ($uri_segments[4] == "barang") {
    echo 'show';
  } elseif ($uri_segments[4] == "kategori") {
    echo 'show';
  } ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data Master:</h6>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "instansi") {
        echo 'active';
      } ?>" href="instansi">Instansi</a>
      <a class="collapse-item  
      <?php if ($uri_segments[4] == "pegawai") {
        echo 'active';
      } ?>" href="pegawai">Pegawai</a>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "barang") {
        echo 'active';
      } ?> <?= $display; ?>" href="barang">Barang</a>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "kategori") {
        echo 'active';
      } ?> <?= $display; ?>" href="kategori">Kategori</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Transaksi
</div>

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item active"> -->
<li class="nav-item
<?php if ($uri_segments[4] == "pembelian") {
  echo 'active';
} elseif ($uri_segments[4] == "pengeluaran") {
  echo 'active';
} elseif ($uri_segments[4] == "saldo") {
  echo 'active';
} elseif ($uri_segments[4] == "sisa") {
  echo 'active';
} ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Transaksi</span>
  </a>
  <!-- <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar"> -->
  <div id="collapsePages" class="collapse
  <?php if ($uri_segments[4] == "pembelian") {
    echo 'show';
  } elseif ($uri_segments[4] == "pengeluaran") {
    echo 'show';
  } elseif ($uri_segments[4] == "saldo") {
    echo 'show';
  } elseif ($uri_segments[4] == "sisa") {
    echo 'show';
  } ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data Transaksi:</h6>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "saldo") {
        echo 'active';
      } ?>" href="saldo">Saldo Awal</a>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "pembelian") {
        echo 'active';
      } ?>" href="pembelian">Penerimaan</a>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "pengeluaran") {
        echo 'active';
      } ?>" href="pengeluaran">Pengeluaran</a>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "sisa") {
        echo 'active';
      } ?>" href="sisa">Sisa Barang</a>
      <!-- <a class="collapse-item active" href="#">Pengeluaran</a> -->
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Laporan
</div>

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item active"> -->
<li class="nav-item
<?php if ($uri_segments[4] == "laporan") {
  echo 'active';
} ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLap" aria-expanded="true" aria-controls="collapseLap">
    <i class="fas fa-fw fa-list"></i>
    <span>Laporan</span>
  </a>
  <!-- <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar"> -->
  <div id="collapseLap" class="collapse
  <?php if ($uri_segments[4] == "laporan") {
    echo 'show';
  } ?>" aria-labelledby="headingLap" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data Laporan:</h6>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "laporan") {
        echo 'active';
      } ?>" href="laporan">Laporan</a>
    </div>
  </div>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Setting
</div>

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item active"> -->
<li class="nav-item
<?php if ($uri_segments[4] == "setting") {
  echo 'active';
} ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSet" aria-expanded="true" aria-controls="collapseSet">
    <i class="fas fa-fw fa-cogs"></i>
    <span>Setting</span>
  </a>
  <!-- <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar"> -->
  <div id="collapseSet" class="collapse
  <?php if ($uri_segments[4] == "setting") {
    echo 'show';
  } ?>" aria-labelledby="headingSet" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Pengaturan:</h6>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "setting") {
        echo 'active';
      } ?>" href="setting">Setting</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider <?= $display; ?>">

<div class="sidebar-heading <?= $display; ?>">
  User
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item 
<?php if ($uri_segments[4] == "user") {
  echo 'active';
} ?> <?= $display; ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
    <i class="fas fa-fw fa-users"></i>
    <span>Users</span>
  </a>
  <div id="collapseUser" class="collapse 
  <?php if ($uri_segments[4] == "user") {
    echo 'show';
  } ?>" aria-labelledby="headingUser" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data User:</h6>
      <a class="collapse-item 
      <?php if ($uri_segments[4] == "user") {
        echo 'active';
      } ?>" href="user">User</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>