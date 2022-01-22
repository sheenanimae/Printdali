<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printdali | <?php if ($this->session->userdata('User_session')['user_level']==0) { echo "Vendor";}
                else{echo "Admin";}?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?=base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="shortcut icon" type="image/jpg" href="<?= base_url()?>assets/img/logo_yellow.png" />

    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?=base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?=base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Sparkline -->
    <script src="<?=base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url() ?>assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?=base_url() ?>assets/dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?=base_url() ?>assets/dist/js/pages/dashboard.js"></script>
    <!-- Sweet allert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables  & Plugins -->
    <!-- table page -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 1000px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
    </style>
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
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a href="<?=base_url()?>Login/logout" type="button" class="btn btn-primary">Logout <i
                            class="fas fa-sign-out-alt"></i></a>


                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?=base_url() ?>assets/img/logo_yellow.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?php if ($this->session->userdata('User_session')['user_level']==0) { echo "Printing Shop";}
                else{echo "Admin";}?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <p class="img-circle elevation-2 text-white mt-1" style="opacity: .8"> <?php if ($this->session->userdata('User_session')['user_level']==0) { echo "PS";}
                else{echo "A";}?>
                        </p>
                    </div>
                    <div class="info">
                        <a href="#"
                            class="d-block"><?=$this->session->userdata('User_session')['store_name']." " ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <?php if (isset($_SESSION['User_session'])){ 
                            if ($this->session->userdata('User_session')['user_level']==0) { ?>
                        <li class="nav-item " id="Costumerdropdwon">

                            <a href="#" class="nav-link active" id="costumertab">

                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>
                                    Costumer
                                    <i class="right fas fa-angle-left"></i> <span
                                        class="badge badge-danger navbar-badge"><?=!empty($numberofpendinglisting)?$numberofpendinglisting:"";?></span>

                                </p>

                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/CostumerIncoming" class="nav-link" id="ListP">
                                        <i class="fas fa-list nav-icon"></i>
                                        <span
                                            class="badge badge-danger navbar-badge"><?=!empty($numberofpendinglisting)?$numberofpendinglisting:"";?></span>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/CostumerPending" class="nav-link" id="PendngP">
                                        <i class="fas fa-edit nav-icon"></i>
                                        <p>Pending</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/CostumerReadytoPick" class="nav-link" id="ReadytoP">
                                        <i class="fas fa-truck-pickup nav-icon"></i>
                                        <p>Ready to Pickup</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?=base_url()?>Login/ServiceList" class="nav-link" id="servicelist">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Service List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=base_url()?>Login/VendorHistory" class="nav-link" id="vendorhistory">
                                <i class="fas fa-history nav-icon"></i>
                                <p>History</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?=base_url()?>Login/CostumerService" class="nav-link" id="vendorCS">
                                <i class="nav-icon fas fa-phone-square-alt"></i>
                                <p>
                                    Costumer Service
                                </p>
                            </a>
                        </li> -->
                        <?php } else{ ?>
                        <li class="nav-item ">
                            <a href="<?=base_url()?>Login/Shop" class="nav-link active" id="shopMenu">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    Printing Shop
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?=base_url()?>Login/User" class="nav-link" id="respondentMenu">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Respondent User
                                </p>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item" id="dropdowncomplainMenu">
                            <a href="#" class="nav-link" id="complainMenu">
                                <i class="nav-icon fas fa-exclamation-triangle"></i>
                                <p>
                                    Complain
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="<?=base_url()?>Login/VendorComplain" class="nav-link" id="complaindown1">
                                        <i class="fas fa-user-tie nav-icon"></i>
                                        <p>Vendor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/UserComplain" class="nav-link" id="complaindown2">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>

                            </ul>
                        </li> -->

                        <li class="nav-item " id="dropdownapplicationMenu">
                            <a href="#" class="nav-link" id="applicationMenu">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Application
                                    <i class="right fas fa-angle-left"></i>
                                    <span
                                        class="badge badge-danger navbar-badge"><?=!empty($numberofpending)?$numberofpending:"";?></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/ApplicationPending" class="nav-link"
                                        id="applicationdown1">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Pending</p>
                                        <span
                                            class="badge badge-danger navbar-badge"><?=!empty($numberofpending)?$numberofpending:"";?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/ApplicationApproved" class="nav-link"
                                        id="applicationdown2">
                                        <i class="fas fa-thumbs-up nav-icon"></i>
                                        <p>Approved</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/ApplicationDisapproved" class="nav-link"
                                        id="applicationdown3">
                                        <i class="fas fa-thumbs-down nav-icon"></i>
                                        <p>Disapproved</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item" id="dropdownaccountMenu">
                            <a href="#" class="nav-link" id="accountMenu">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>
                                    Accounts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/AccountVendor" class="nav-link" id="accountdown1">
                                        <i class="fas fa-user-tie nav-icon"></i>
                                        <p>Shop</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=base_url()?>Login/AccountUser" class="nav-link" id="accountdown2">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <?php }}?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">