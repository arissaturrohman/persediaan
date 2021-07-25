<?php
//menampilkan menu
if ($_SESSION['level'] == "admin") {
  $display = "";
} else {
  $display = "d-none";
}
?>

<?php
//mengaktifkan menu
if ($page = "instansi") {
  $aktif = "active";
  $show = "show";
} elseif ($page = "pegawai") {
  $aktif = "active";
  $show = "show";
} else {
  $aktif = "";
  $show = "";
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
<li class="nav-item">
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
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-folder-open"></i>
    <span>Data Master</span>
  </a>
  <div id="collapseTwo" class="collapse <?= $show; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data Master:</h6>
      <a class="collapse-item <?= $aktif; ?>" href="instansi">Instansi</a>
      <a class="collapse-item <?= $aktif; ?>" href="pegawai">Pegawai</a>
      <a class="collapse-item <?= $display; ?>" href="barang">Barang</a>
      <a class="collapse-item <?= $display; ?>" href="kategori">Kategori</a>
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
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Transaksi</span>
  </a>
  <!-- <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar"> -->
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data Transaksi:</h6>
      <a class="collapse-item" href="pembelian">Pembelian</a>
      <a class="collapse-item" href="pengeluaran">Pengeluaran</a>
      <a class="collapse-item" href="saldo">Saldo Awal</a>
      <!-- <a class="collapse-item active" href="#">Pengeluaran</a> -->
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0 <?= $display; ?>">

<div class="sidebar-heading <?= $display; ?>">
  User
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?= $display; ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
    <i class="fas fa-fw fa-users"></i>
    <span>Users</span>
  </a>
  <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data User:</h6>
      <a class="collapse-item" href="user">User</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>