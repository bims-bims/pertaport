<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta http-equiv="refresh" content="60">
    <meta name="author" content="" />
    <title>PertaReport</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="sb-nav-fixed">
    
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light shadow">
        <!-- Navbar Brand-->
        <a class="navbar-brand bg ps-2" href="#">
            <img class="" src="../assets/img/Pertamedika.png" width="260" height="145" alt="">
            
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-3 my-md-0">
            <p class="text-center text-capitalize text-black bg-transparent  my-3 h4 ">
            <?php
            session_start();
            if ($_SESSION['status'] != "login") {
                header("location:../index.php?pesan=belum_login");
            }
            ?>
            <?php echo $_SESSION['username']; ?>
            </p>
        </form>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="notifikasi-baru" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
      <strong>Ada laporan baru!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion bg-primary" id="sidenavAccordion">
                <div class="sb-sidenav-menu text-white">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Selamat Datang <?php echo $_SESSION['username']; ?></div>
                        <!-- <a class="nav-link text-white  " href="./index.php">
                            <div class="sb-nav-link-icon "><i class="fa-solid fa-book"></i></div>
                            Dashboard
                        </a> -->
                        <div class="sb-sidenav-menu-heading ">Menu Utama</div>
                        <a class="nav-link collapsed text-white" adminhref="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                            Master Data
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-white" href="../admin/user.php">Tambah User</a>
                                <a class="nav-link text-white" href="../admin/devisi.php">Tambah Divisi</a>
                                <a class="nav-link text-white" href="layout-sidenav-light.html">Tambah Perangkat</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed text-white" href="../admin/pelaporan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-triangle-exclamation"></i></i></div>
                            Laporan Kerusakan 
                        </a>
                        <a class="nav-link collapsed text-white" href="#">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></i></div>
                            Permintaan Data
                        </a>
                        <div class="sb-sidenav-menu-heading">Pemberitahuan</div>
                        <a class="nav-link collapsed text-white" href="#">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-wifi"></i></i></div>
                            Jaringan
                        </a>
                        </div>
                </div>

            </nav>
        </div>
        











