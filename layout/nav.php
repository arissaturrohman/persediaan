<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <?php
    $date = date("Y-m-d");
    $dhari = array(
      'Sunday' => 'Minggu',
      'Monday' => 'Senin',
      'Tuesday' => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday' => 'Kamis',
      'Friday' => 'Jumat',
      'Saturday' => 'Sabtu'
    );
    $hari = date('l', strtotime($date));


    ?>
    <div class="no-arrow my-auto mr-2 d-none d-lg-inline text-gray-600 small"><?= $dhari[$hari] . ',' . ' ' . TanggalIndo($date); ?> </div>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama']; ?></span>
        <img class="img-profile rounded-circle" src="assets/img/logo.png">
      </a>
      <!-- Dropdown - User Information -->
      <?php
      $sql = $conn->query("SELECT * FROM tb_user WHERE id_user = '$_SESSION[id_user]'");
      $data = $sql->fetch_assoc();
      ?>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="setting">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Setting
        </a>
        <a class="dropdown-item" href="?page=user&action=gantiPass&id=<?= $data['id_user']; ?>">
          <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
          Ganti Password
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>

  </ul>

</nav>
<!-- End of Topbar -->