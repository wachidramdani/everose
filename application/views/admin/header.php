<?php

    if(!isset($pagetitle)) {

        $pagetitle = "Admin - sepatoe.id";

    }

?>

<!DOCTYPE html>

<!--

This is a starter template page. Use this page to start your new project from

scratch. This page gets rid of all links and provides the needed markup only.

-->

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="x-ua-compatible" content="ie=edge">



  <title><?=$pagetitle;?></title>



  <!-- Font Awesome Icons -->

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.css">

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/datatables/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/dist/css/adminlte.min.css">  

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/summernote/summernote-bs4.css">

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/daterangepicker/daterangepicker.css">



  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Google Font: Source Sans Pro -->

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="<?=base_url();?>assets/adminlte/plugins/pace-progress/themes/blue/pace-theme-flash.css">



  <style>

    .img-inserted .delete {

      display:none;

      background: rgba(0,0,0,0.4);

      justify-content: center;

      align-items: center;

      height: 100%;

      width: 100%;

    }



    .img-inserted:hover .delete {

      display:flex;

    }



    .dt-center {

      text-align: center;

    }



    .dt-right {

      text-align: right;

    }

  </style>

  <script>

      paceOptions = {

      restartOnRequestAfter: 5,

      ajax: {

        trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']

      }

    }

  </script>

  <script src="<?=base_url();?>assets/adminlte/plugins/pace-progress/pace.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">

<script src="<?=base_url();?>assets/adminlte/plugins/jquery/jquery.js"></script>

<script src="<?=base_url();?>assets/adminlte/plugins/datatables/js/jquery.dataTables.min.js"></script>

<script src="<?=base_url();?>assets/adminlte/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>

<script src="<?=base_url("assets/adminlte");?>/plugins/moment/moment.min.js"></script>

<script src="<?=base_url("assets/adminlte");?>/plugins/daterangepicker/daterangepicker.js"></script>



<div class="wrapper">



  <!-- Navbar -->

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->

    <ul class="navbar-nav">

      <li class="nav-item">

        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>

      </li>

    </ul>

    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown user-menu">

        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

          <img src="<?=base_url($admin_info['photo_profile']);?>" class="user-image img-circle elevation-2" alt="User Image">

          <span class="d-none d-md-inline"><?=$admin_info['name_profile'];?></span>

        </a>

        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <!-- User image -->

          <li class="user-header bg-secondary">

            <img src="<?=base_url($admin_info['photo_profile']);?>" class="img-circle elevation-2" alt="User Image">



            <p>

              <?=$admin_info['name_profile'];?>

              <small><?=$admin_info['usn_admin'];?></small>

            </p>

          </li>

          <!-- Menu Footer-->

          <li class="user-footer">

            <a href="<?=base_url('index.php/admin/edit_profile');?>" class="btn btn-default btn-flat"><i class="fas fa-user-edit"></i> Edit Profile</a>

            <a href="<?=base_url('index.php/admin/auth/logout');?>" class="btn btn-default btn-flat float-right"><i class="fas fa-sign-out-alt"></i> Logout</a>

          </li>

        </ul>

      </li>



    </ul>

  </nav>

  <!-- /.navbar -->



  <!-- Main Sidebar Container -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->

    <a href="<?=base_url("admin");?>" class="brand-link">

      <div class="brand-text">Sepatoe.id</span></div>

    </a>



    <!-- Sidebar -->

    <div class="sidebar">



      <!-- Sidebar Menu -->

      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->

          <li class="nav-header">UTAMA</li>

          <li class="nav-item">

              <a href="<?=base_url('index.php/admin/dashboard');?>" class="nav-link">

                <i class="nav-icon fas fa-home"></i>

                <p>

                    Dashboard

                </p>

              </a>

          </li>

          <li class="nav-item">

              <a href="<?=base_url();?>" class="nav-link">

                <i class="nav-icon fas fa-external-link-alt"></i>

                <p>

                    Lihat Website

                </p>

              </a>

          </li>

          <li class="nav-header">KELOLA</li>

          <li class="nav-item">

              <a href="<?=base_url('index.php/admin/product');?>" class="nav-link">

                <i class="nav-icon fas fa-th-list"></i>

                <p>

                    Produk

                </p>

              </a>

          </li>

          <li class="nav-item">

              <a href="<?=base_url('index.php/admin/category');?>" class="nav-link">

                <i class="nav-icon fas fa-cubes"></i>

                <p>

                    Kategori

                </p>

              </a>

          </li>

           <!-- <li class="nav-item">

              <a href="<?=base_url('index.php/admin/metavalue');?>" class="nav-link">

                <i class="nav-icon fas fa-cubes"></i>

                <p>

                    Warna

                </p>

              </a>

          </li> -->

          <li class="nav-item">

              <a href="<?=base_url('index.php/admin/slider');?>" class="nav-link">

                <i class="nav-icon far fa-newspaper"></i>

                <p>

                    Slider

                </p>

              </a>

          </li>

          <li class="nav-item">

              <a href="<?=base_url('index.php/admin/page');?>" class="nav-link">

                <i class="nav-icon far fa-file-alt"></i>

                <p>

                    Halaman

                </p>

              </a>

          </li>

          <li class="nav-item">

              <a href="<?=base_url('index.php/admin/order');?>" class="nav-link">

                <i class="nav-icon far fa-list-alt"></i>

                <p>

                    Orderan

                </p>

              </a>

          </li>

          <?php if($admin_info['id_level'] < 2) { ?>



          <li class="nav-item">

              <a href="<?=base_url('index.php/admin/account');?>" class="nav-link">

                <i class="nav-icon fas fa-users"></i>

                <p>

                    Admin

                </p>

              </a>

          </li>



          <li class="nav-header">LAPORAN</li>

          <li class="nav-item">

              <a href="<?=base_url('index.php/admin/report');?>" class="nav-link">

                <i class="nav-icon fas fa-chart-line"></i>

                <p>

                    Laporan Penjualan

                </p>

              </a>

          </li>

          <?php } ?>



          <li class="nav-header">KONFIGURASI</li>

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-copy"></i>

              <p>

                Rajaongkir API

              </p>

            </a>

            <ul class="nav nav-treeview">

            <?php if($admin_info['id_level'] < 2) { ?>



              <li class="nav-item">

                <a href="<?=base_url('index.php/admin/rajaongkir');?>" class="nav-link">

                <i class="nav-icon far fa-circle"></i>

                  <p>API Key</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="<?=base_url('index.php/admin/rajaongkir/origin');?>" class="nav-link">

                <i class="nav-icon far fa-circle"></i>

                  <p>Origin</p>

                </a>

              </li>

            <?php } ?>



              <li class="nav-item">

                <a href="<?=base_url('index.php/admin/rajaongkir/courier');?>" class="nav-link">

                <i class="nav-icon far fa-circle"></i>

                  <p>Jasa Ekspedisi</p>

                </a>

              </li>

            </ul>

          </li>

          <?php if($admin_info['id_level'] < 2) { ?>



          <li class="nav-item">

            <a href="<?=base_url('index.php/admin/midtrans');?>" class="nav-link">

            <i class="nav-icon fas fa-copy"></i>

              <p>Midtrans API</p>

            </a>

          </li>

          <li class="nav-item">

            <a href="<?=base_url('index.php/admin/shop_setting');?>" class="nav-link">

            <i class="nav-icon fas fa-cogs"></i>

              <p>Pengaturan Toko</p>

            </a>

          </li>

          <?php } ?>

          

          <li class="nav-item">

            <a href="<?=base_url('index.php/admin/password');?>" class="nav-link">

              <i class="nav-icon fas fa-key"></i>

              <p>Ganti Password</p>

            </a>

          </li>

          

        </ul>

      </nav>

      <!-- /.sidebar-menu -->

    </div>

    <!-- /.sidebar -->

  </aside>

