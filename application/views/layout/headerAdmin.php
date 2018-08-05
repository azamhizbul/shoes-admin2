<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= $title; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?php echo base_url('assets/css/googlefont1.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/googlefont2.css'); ?>" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Material Icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/iconfont/material-icons.css'); ?>" />

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/plugins/node-waves/waves.css'); ?> " rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('assets/plugins/animate-css/animate.css'); ?>" rel="stylesheet" />

     <!--WaitMe Css-->
    <link href="<?php echo base_url('assets/plugins/waitme/waitMe.css'); ?>" rel="stylesheet" />

     <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" />

     <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url("assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css") ?>" rel="stylesheet">
    
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css'); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">

    <!-- Custom Css by third party developer -->
    <link href="<?php echo base_url('assets/css/style2.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/style3.css'); ?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url('assets/js/EasyAutocomplete/easy-autocomplete.css'); ?>" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url('assets/css/themes/all-themes.css'); ?>" rel="stylesheet" />

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

    <!-- Jquery EasyAutocomplete -->
    <script src="<?php echo base_url('assets/js/EasyAutocomplete/jquery.easy-autocomplete.js'); ?>"></script>

    <!-- javascript validation -->
    <script src="<?php echo base_url('assets/js/jValidate.js') ?>"></script>

    <!-- jquery mask -->
    <script src="<?php echo base_url('assets/js/jquery.mask.js') ?>"></script>
    
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?= site_url('adminroot/home'); ?>" title="Admin">ADMIN</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url('assets/images/user.png'); ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $akun->nama; ?></div>
                    <div class="name"><?= $akun->jabatan; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?= base_url('adminroot/Profile'); ?>"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?= base_url('Login/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>      
                    <li class="active">
                    <!-- <li class="<?php if($this->uri->segment(1)=="/"){echo "active";}?>" > -->
                        <a href="<?= base_url('adminroot/home'); ?>" >
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shopping_cart</i>
                            <span>Pengelolaan Barang</span>
                        </a>

                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">Pengelolaan Barang Pribadi</a>
                                <ul class="ml-menu">
                                    <li><a href="<?= base_url('adminroot/pengelolaan_barang'); ?>">Pengelolaan Barang Pribadi</a></li>
                                    <li><a href="<?= base_url('adminroot/Pengelolaan_barang/riwayatTambahStok'); ?>">Riwayat Tambah Stok</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= base_url('adminroot/pengelolaan_barang/barangTitipan'); ?>">Pengelolaan Barang Titipan</a>
                            </li>
                        </ul>

                    </li>

                    <li>
                        <a href="<?= base_url('adminroot/pengelolaan_vendor'); ?>">
                            <i class="material-icons">local_mall</i>
                            <span>Pengelolaan Vendor</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('adminroot/pengelolaan_reseller'); ?>">
                            <i class="material-icons">group</i>
                            <span>Pengelolaan Reseller</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('adminroot/pengelolaan_karyawan'); ?>">
                            <i class="material-icons">face</i>
                            <span>Pengelolaan Karyawan</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('adminroot/pengelolaan_akun'); ?>">
                            <i class="material-icons">person</i>
                            <span>Pengelolaan Akun</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">reorder</i>
                            <span>Pemesanan</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="<?= base_url('adminroot/PemesananAdmin'); ?>">Tambah Pemesanan</a></li>
                            <li><a href="<?= base_url('adminroot/PemesananAdmin/riwayatPemesanan'); ?>">Riwayat Pemesanan</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">add_shopping_cart</i>
                            <span>Penjualan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Penjualan</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="<?= base_url('adminroot/PenjualanAdmin'); ?>">Tambah Penjualan</a></li>
                                    <li><a href="<?= base_url('adminroot/PenjualanAdmin/historyPenjualan/'); ?>">Riwayat Penjualan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Reseller</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="<?= base_url('adminroot/PenjualanAdmin/reseller'); ?>">Tambah Penjualan Reseller</a></li>
                                    <li><a href="<?= base_url('adminroot/PenjualanAdmin/historyPenjualanReseller'); ?>">Riwayat Penjualan Reseller</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Merk</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="<?= base_url('adminroot/PenjualanAdmin/merk'); ?>">Tambah Penjualan Merk</a></li>
                                    <li><a href="<?= base_url('adminroot/PenjualanAdmin/historyPenjualanMerk'); ?>">Riwayat Penjualan Merk</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">autorenew</i>
                            <span>Retur Barang</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?= base_url('adminroot/ReturPemesananAdmin/'); ?>">Retur Pemesanan</a>
                            </li>
                            <!-- <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    Retur Reseller
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="<?= base_url('adminroot/ReturResellerAdmin/'); ?>">Tambah Retur Reseller</a></li>
                                    <li><a href="<?= base_url('adminroot/ReturPemesanan/ReturReseller'); ?>">Retur Reseller</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </li>

                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_paste</i>
                            <span>Pengeluaran</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?= base_url('adminroot/PengeluaranHarian'); ?>">Pengeluaran Karyawan</a>
                            </li>
                            <li>
                                <a href="<?= base_url('adminroot/PengeluaranBulanan'); ?>">Pengeluaran Perusahaan</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_paste</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?= base_url('adminroot/laporan_pengeluaran'); ?>">Laporan Pengeluaran</a>
                            </li>
                            <li>
                                <a href="<?= base_url('adminroot/laporan_pemasukan'); ?>">Laporan Pendapatan</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?= base_url('adminroot/invoice'); ?>">
                            <i class="material-icons">insert_drive_file</i>
                            <span>Invoice</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="<?= site_url('adminroot/home'); ?>">Shoes - POS Management</a>.
                </div>
                <div class="version">
                    <b>Version: </b> Beta
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue" class="active">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">