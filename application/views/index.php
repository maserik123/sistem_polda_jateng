<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets') ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets') ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- Sweetalert -->
    <link href="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><img src="<?php echo base_url('assets/images/polda.png') ?>" width="40px" height="50px"> <span>Polda Jateng</span></a>
                    </div>

                    <div class="clearfix"></div>
                    <!-- /menu profile quick info -->

                    <br />
                    <script type="text/javascript">
                        function logout() {
                            swal({
                                    title: "Do you want to logout ?",
                                    type: "warning",
                                    // imageUrl: "<?php echo base_url() ?>assets/images/user.png",
                                    text: "Click yes if you have been finished all the transactions in this system ",
                                    showCancelButton: true,
                                    showLoaderOnConfirm: true,
                                    confirmButtonText: "Yes",
                                    closeOnConfirm: false
                                },
                                function() {
                                    $.ajax({
                                        url: "<?php echo site_url('auth/logout'); ?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data: {
                                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                        },
                                        success: function(data) {
                                            $url = '<?php echo base_url('/auth/') ?>';
                                            setTimeout(() => {
                                                $(location).attr('href', $url)
                                            }, 1400);
                                            return swal({
                                                html: true,
                                                timer: 1300,
                                                showConfirmButton: false,
                                                title: data['msg'],
                                                type: data['status']
                                            });
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            alert('Error to Log out, check the connection or configuration !');
                                        }
                                    });
                                });
                        }
                    </script>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Menu Manajemen</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url('manajemen') ?>"><i class="fa fa-home"></i> Home </a>
                                </li>
                                <li><a href="<?php echo base_url('manajemen/daftarRanmor') ?>"><i class="fa fa-edit"></i> Daftar Ranmor </a>
                                </li>
                                <li><a><i class="fa fa-desktop"></i>Kendaraan Hilang<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url('manajemen/ranmorJmlRoda') ?>">Berdasarkan Jumlah Roda</a></li>
                                        <li><a href="<?php echo base_url('manajemen/ranmorModusOperandi') ?>">Berd. Modus Operandi</a></li>
                                        <li><a href="<?php echo base_url('manajemen/ranmorLokasi') ?>">Berd. Lokasi</a></li>
                                        <li><a href="<?php echo base_url('manajemen/ranmorWaktu') ?>">Berd. Waktu</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url('manajemen/rekapRanmor') ?>"><i class="fa fa-table"></i> Summary Kendaraan Hilang </a>
                                </li>
                                <li><a href="<?php echo base_url('manajemen/kesatuan') ?>"><i class="fa fa-edit"></i> Data Kesatuan </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <span class="fa fa-user"></span>
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <?php echo $this->session->userdata('username'); ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" onclick="logout()"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <?php include 'pages/' . $pageName . '.php' ?>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets') ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets') ?>/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets') ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets') ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url('assets') ?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url('assets') ?>/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('assets') ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets') ?>/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url('assets') ?>/vendors/skycons/skycons.js"></script>
    <!-- Flot -->

    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.min.js"></script>


    <script src="<?php echo base_url('assets') ?>/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url('assets') ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url('assets') ?>/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('assets') ?>/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets') ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets') ?>/build/js/custom.min.js"></script>

</body>

</html>