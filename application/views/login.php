<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>CV. Lumeic Indonesia</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?= base_url('assetss/') ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/') ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?= base_url('assetss/') ?>assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?= base_url('assetss/') ?>assets/css/ace.min.css" />
    <link rel="stylesheet" href="<?= base_url('assetss/') ?>assets/css/ace-rtl.min.css" />
</head>

<body class="login-layout">
    <div class="main-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="login-container">
                        <div class="center">
                            <h1>
                                <i class="ace-icon fa fa-leaf green"></i>
                                <span class="red">CV. Lumeic</span>
                                <span class="white" id="id-text2">Indonesia</span>
                            </h1>
                        </div>

                        <div class="space-6"></div>

                        <div class="position-relative">
                            <div id="login-box" class="login-box visible widget-box no-border">
                                <div class="widget-body">
                                    <div class="widget-main">

                                        <div class="space-6"></div>

                                        <form>
                                            <fieldset>
                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" />
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </span>
                                                </label>

                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                                                        <i class="ace-icon fa fa-lock"></i>
                                                    </span>
                                                </label>

                                                <div class="space"></div>

                                                <div class="clearfix">
                                                    <button type="button" name="login" id="login" class="width-35 pull-right btn btn-sm btn-primary">
                                                        <i class="ace-icon fa fa-key"></i>
                                                        <span class="bigger-110">Login</span>
                                                    </button>
                                                </div>

                                                <div class="space-4"></div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="navbar-fixed-top align-right">
                            <br />
                            &nbsp;
                            <a id="btn-login-dark" href="#">Dark</a>
                            &nbsp;
                            <span class="blue">/</span>
                            &nbsp;
                            <a id="btn-login-blur" href="#">Blur</a>
                            &nbsp;
                            <span class="blue">/</span>
                            &nbsp;
                            <a id="btn-login-light" href="#">Light</a>
                            &nbsp; &nbsp; &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assetss/') ?>assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?= base_url('assetss/'); ?>assets/js/sweetalert.min.js"></script>
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url('assetss/') ?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
            $(document).on('click', '.toolbar a[data-target]', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $('.widget-box.visible').removeClass('visible'); //hide others
                $(target).addClass('visible'); //show target
            });
        });

        //you don't need this, just used for changing background
        jQuery(function($) {
            $('#btn-login-dark').on('click', function(e) {
                $('body').attr('class', 'login-layout');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'blue');

                e.preventDefault();
            });
            $('#btn-login-light').on('click', function(e) {
                $('body').attr('class', 'login-layout light-login');
                $('#id-text2').attr('class', 'grey');
                $('#id-company-text').attr('class', 'blue');

                e.preventDefault();
            });
            $('#btn-login-blur').on('click', function(e) {
                $('body').attr('class', 'login-layout blur-login');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'light-blue');

                e.preventDefault();
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#login').click(function(e) {

                var username = $('#username').val();
                var password = $('#password').val();
                if (username == "") {
                    swal("Gagal", "Username Harus Diisi", "error").then(function() {
                        $("#username").focus().select();
                    });
                    return false;
                }

                if (password == "") {
                    swal("Gagal", "Password Harus Diisi", "error").then(function() {
                        $("#password").focus().select();
                    });
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "auth/proses",
                    data: 'username=' + username + '&password=' + password,
                    dataType: "text",
                    cache: false,
                    success: function(data) {
                        var header = data.split("\t");
                        switch (header[0]) {
                            case 'OK':
                                swal("Success", "Login Berhasil", "success").then(function() {
                                    location.href = "<?php echo base_url(); ?>dashboard";
                                });
                                break;
                            case 'GAGAL':
                                swal("Gagal", "Username Atau Password Salah", "error").then(function() {
                                    location.href = "<?php echo base_url(); ?>auth";
                                });
                                break;
                            default:
                                swal("Gagal", header[0], "error");
                        }
                    }
                });

                e.preventDefault();
            });

        });
    </script>
</body>

</html>