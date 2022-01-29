<?php include "db.php" ?>
<?php ob_start(); ?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIA</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SISTEM AKADEMIK</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <?php if ($_SESSION['user_status'] == "admin") : ?>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="guru.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Guru</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mapel.php">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Data Mapel</span></a>
        </li>
      <?php endif; ?>
      <script>
        $(document).ready(function() {
          $.each($('#accordionSidebar').find('li'), function() {
            $(this).toggleClass('active',
              window.location.pathname.indexOf($(this).find('a').attr('href')) > -1);
          });
        });
      </script>
      <li class="nav-item">
        <form action="" method="POST">
          <button type="submit" name="logout_btn" class="btn text-white mx-2">Logout</button></a>
        </form>
        <?php
        if (isset($_POST['logout_btn'])) {
          $_SESSION['user_nip'] == null;
          session_destroy();
          header("Location:index.php");
        }
        ?>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
            </li>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["user_nama"] ?></span>
                <img class="img-profile rounded-circle" src="img/<?php echo $_SESSION["user_profile"] ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <form action="" method="POST">
                    <button type="submit" name="logout_btn" class="btn mx-2">Logout</button>
                  </form>
                </a>
                <?php
                if (isset($_POST['logout_btn'])) {
                  $_SESSION['user_nip'] == null;
                  session_destroy();
                  header("Location:index.php");
                }
                ?>
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->