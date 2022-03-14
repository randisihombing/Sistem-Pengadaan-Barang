<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>CV. Lumeic Indonesia</title>

    <meta name="description" content="Common form elements and layouts" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/chosen.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/daterangepicker.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/bootstrap-colorpicker.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
			<link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/sweetalert2.css">

    <!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?= base_url('assetss/'); ?>assets/css/ace-ie.min.css" />
		<![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?= base_url('assetss/'); ?>assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
		<script src="<?= base_url('assetss/'); ?>assets/js/html5shiv.min.js"></script>
		<script src="<?= base_url('assetss/'); ?>assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default          ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="index.html" class="navbar-brand">
                    <small>
                        <i class="fa fa-leaf"></i>
                        CV. Lumeic
                    </small>
                </a>
            </div>

            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">

                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="<?= base_url('assetss/'); ?>assets/images/avatars/user.jpg" alt="Jason's Photo" />
                            <span class="user-info">
                                <small>Welcome,</small>
                                <?= $this->session->userdata('username'); ?>
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="profile.html">
                                    <i class="ace-icon fa fa-user"></i>
                                    Profile
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="<?= base_url('auth/logout') ?>">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('sidebar')
                } catch (e) {}
            </script>

            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                    <button class="btn btn-success">
                        <i class="ace-icon fa fa-signal"></i>
                    </button>

                    <button class="btn btn-info">
                        <i class="ace-icon fa fa-pencil"></i>
                    </button>

                    <button class="btn btn-warning">
                        <i class="ace-icon fa fa-users"></i>
                    </button>

                    <button class="btn btn-danger">
                        <i class="ace-icon fa fa-cogs"></i>
                    </button>
                </div>

                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>

                    <span class="btn btn-info"></span>

                    <span class="btn btn-warning"></span>

                    <span class="btn btn-danger"></span>
                </div>
            </div><!-- /.sidebar-shortcuts -->

            <?php if ($this->session->userdata('role') == "admin") { ?>
                <ul class="nav nav-list">
                    <li class="">
                        <a href="<?= base_url('dashboard') ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-desktop"></i>
                            <span class="menu-text">
                                Data master
                            </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Kategori Barang
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="">
                                        <a href="<?= base_url('kategori_barang/tambah_kategori') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Tambah Kategori Barang
                                        </a>

                                        <b class="arrow"></b>
                                    </li>

                                    <li class="">
                                        <a href="<?= base_url('kategori_barang/kelola_kategori') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Kelola Kategori Barang
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Data Barang
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="">
                                        <a href="<?= base_url('barang/tambah_barang') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Tambah Barang
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                    <li class="">
                                        <a href="<?= base_url('barang/kelola_barang') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Kelola Barang
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-folder-o"></i>
                            <span class="menu-text">
                                Stock
                            </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Stock In
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="">
                                        <a href="<?= base_url('stock/tambah_stock_in') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Tambah Stock In
                                        </a>

                                        <b class="arrow"></b>
                                    </li>

                                    <li class="">
                                        <a href="<?= base_url('stock/kelola_stock_in') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Kelola Stock In
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Stock Out
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="">
                                        <a href="<?= base_url('stock/tambah_stock_out') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Tambah Stock Out
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                    <li class="">
                                        <a href="<?= base_url('stock/kelola_stock_out') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Kelola Stock Out
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-pencil-square-o"></i>
                            <span class="menu-text"> Penawaran Harga </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="<?= base_url('sph/tambah_sph') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Tambah SPH
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="<?= base_url('sph/kelola_sph') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Kelola SPH
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-cart-arrow-down"></i>
                            <span class="menu-text"> Pesanan </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="<?= base_url('pesanan/tambah_pesanan') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Tambah Pesanan
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="<?= base_url('pesanan/kelola_pesanan') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Kelola Data Pesanan
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-file-o"></i>
                            <span class="menu-text"> Surat Jalan </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="<?= base_url('surat_jalan/tambah_surat_jalan') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Tambah Surat Jalan
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="<?= base_url('surat_jalan/kelola_surat_jalan') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Kelola Surat Jalan
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-file-o"></i>
                            <span class="menu-text"> Tagihan </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="<?= base_url('tagihan/tambah_tagihan') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Tambah Tagihan
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="<?= base_url('tagihan/kelola_tagihan') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Kelola Tagihan
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text"> User </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="<?= base_url('user/tambah') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Tambah User
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="<?= base_url('user') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Kelola User
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="<?= base_url('auth/logout') ?>">
                            <i class="menu-icon fa fa-sign-out"></i>
                            <span class="menu-text"> Logout </span>
                        </a>
                    </li>
                </ul>
            <?php } elseif ($this->session->userdata('role') == "direktur") { ?>
                <ul class="nav nav-list">
                    <li class="">
                        <a href="<?= base_url('dashboard') ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-desktop"></i>
                            <span class="menu-text">
                                Data Pesanan
                            </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Kelola Pesanan
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>
                                <b class="arrow"></b>
                                <ul class="submenu">
                                    <li class="">
                                        <a href="<?= base_url('pesanan/approve') ?>">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Approve Pesanan
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text"> Data Laporan </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="<?= base_url('laporan/sph') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Rekap SPH
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="<?= base_url('laporan/transaksi') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Rekap Tagihan
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="<?= base_url('laporan/stock') ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Rekap Stok
                                </a>
                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>
        </div>