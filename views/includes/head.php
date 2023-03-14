<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rstock pro</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/fontawesome-free/css/all.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/jqvmap/jqvmap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= URL; ?>public/frameworks/plugins/summernote/summernote-bs4.min.css">

  <!-- Style propre au module-->
  <?php
  if (isset($this->css)) {
    foreach ($this->css as $css) {
      echo '<link href="' . URL . 'views/' . $css . '" rel="stylesheet"/>';
    }
  }
  ?>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user" title="Utilisateur"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Utilisateur</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-pen mr-2"></i> <?php echo Session::get('nom') . ' ' . Session::get('postnom') . ' ' . Session::get('prenom'); ?>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-unlock mr-2"></i> <?php echo Session::get('nom_privilege'); ?>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-street-view mr-2"></i> Voir mon profil
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo URL; ?>login/logout" class="dropdown-item dropdown-footer bg-warning">
              <i class="fas fa-power-off mr-2"></i>
              Déconnexion
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?php echo URL; ?>public/frameworks/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Rstock pro</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo URL; ?>public/frameworks/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo Session::get('nom') . ' ' . Session::get('postnom') . ' ' . Session::get('prenom'); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Tableaux de bord
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.html" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard logistique</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= URL ?>home" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard admin</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">MODULE</li>
            <li class="nav-item">
              <a href="<?= URL; ?>achat" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Entrées
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= URL ?>achat" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Vente
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= URL; ?>vente/effectuer" class="nav-link">
                    <i class="fas fa-cube nav-icon"></i>
                    <p>Effectuer une vente</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= URL; ?>vente/" class="nav-link">
                    <i class="far fa-file nav-icon"></i>
                    <p>Mes ventes</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?= URL; ?>logistique" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Stock
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-wrench"></i>
                <p>
                  Configurations
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= URL ?>configuration/categorie" class="nav-link">
                    <i class="fas fa-paper-plane nav-icon"></i>
                    <p>Catégorie</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= URL; ?>configuration/produit" class="nav-link">
                    <i class="fas fa-cube nav-icon"></i>
                    <p>Produits</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= URL; ?>configuration/utilisateur" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Utilisateur</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?= URL ?>client" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Client
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>