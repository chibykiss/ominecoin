<?php
ob_start();
session_start();

require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Ominecoin limited || Admin Dashboard || Home </title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <?php
    if (!isset($_SESSION["admin_name"]) && !isset($_SESSION["admin_id"])) {

        echo '
                <script>
                    window.location.assign("../");
                </script>
           ';
    }
    ?>
    <link rel="shortcut icon" href="../../customer/icon52.png">
    <!-- Retina iPad Touch Icon-->
    <!-- Styles -->
    <link href="../../customer/assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="../../customer/assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="../../customer/assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="../../customer/assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../../customer/assets/css/lib/unix.css" rel="stylesheet">
    <link href="../../customer/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/datatables.min.css" />
    <link rel="shortcut icon" href="../favicon.png" />

</head>

<body>

    <?php include("header.php"); ?>
    <p style="height: 40px;"></p>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome Admin</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Dashboard</a></li>
                                    <li class="active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">
                                            <a href="users.php">Total users</a> <br>
                                        </div>
                                        <div class="pull-right">
                                            <a href="ccpage.php"> credit card </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <span class="stat-digit"> <?php $classObj->num_users(); ?></span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">
                                            <a href="#">Total deposite</a> <br>

                                        </div>
                                        <div class="pull-right">
                                            <?php $classObj->lockadmin1(); ?>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <span class="stat-digit">$
                                                <?php $classObj->total_depsite(); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">
                                            <a href="#">Total Investment</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <span class="stat-digit"> $ <?php $classObj->total_invest(); ?> </span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">
                                            <a href="testimony.php">Add Testimony</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        Add testimoney youtube videos
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p> Blustonewealth &copy; <span id="date-time"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="search">
        <button type="button" class="close">??</button>
        <form>
            <input type="search" value="" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>WElcome to Mistri mama!!!</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>A welcome note and a welcome picture goes here :</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info  pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <script src="../../customer/assets/js/lib/jquery.min.js"></script>
    <!-- jquery vendor -->
    <script src="../../customer/assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../../customer/assets/js/lib/menubar/sidebar.js"></script>
    <script src="../../customer/assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../../customer/assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="../../customer/assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="../../customer/assets/js/scripts.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>

<?php ob_end_flush(); ?>