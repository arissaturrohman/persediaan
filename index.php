<?php
include('inc/config.php');
include('inc/tgl_indo.php');
include('inc/romawi.php');
include('inc/bulan.php');
include('vendor/autoload.php');

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$uri_path = "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$uri_segments = explode('/', $uri_path);
$uri_segments[1];
?>

<?php
include('layout/header.php');
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <?php

      include('layout/sidebar.php');

      ?>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php
        include('layout/nav.php');
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <?php
          include('layout/content.php');
          ?>





          <?php include('layout/footer.php'); ?>