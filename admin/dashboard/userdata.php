<?php
ob_start();
session_start();
require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->blockk();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title> Omine coin limited || Admin Dashboard || User Data </title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="../../customer/icon52.png">
    <?php
    if (!isset($_SESSION["admin_name"]) && !isset($_SESSION["admin_id"])) {

        echo '
                <script>
                    window.location.assign("../");
                </script>
           ';
    }
    ?>
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
                                    <li class="active"><?php $classObj->uuname(); ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row d-flex">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-items-center justify-content-center">
                            <div class="card">
                                <form method="GET" id="profile2">
                                    <?php $classObj->load_profile2(); ?>
                                    <div class="form-group">
                                        <div class="alert alert-info hidden" id="lo">
                                            Email or phone number already taken by another user
                                        </div>
                                        <button type="submit" id="sun" class="btn btn-info btn-rounded btn-outline" name="submit"> Update User </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <h4 class="text-center"> $<?php $classObj->balance(); ?></h4>
                                    </div>
                                    <div class="panel-body  table-responsive">

                                        <table class="display table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $classObj->getuserData(); ?>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <h4 class="text-center"> reffered users</h4>
                                    </div>
                                    <div class="panel-body  table-responsive">

                                        <table id="" class="display table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th> Id</th>
                                                    <th> User name </th>
                                                    <th> Full name </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $classObj->getreffeduser(); ?>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p> Ominecoin limited &copy; <span id="date-time"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="search">
        <button type="button" class="close">×</button>
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
            $('#profile2').submit(function(e) {
                e.preventDefault();
                var un = $("#un").val();
                var fn = $("#fn").val();
                var em = $("#em").val();
                var ph = $("#ph").val();
                var pwd = $("#pwd").val();
                var ref = $("#ref").val();
                var hash = $("#hash").val();
                var btc = $("#btc").val();
                var ether = $("#ether").val();
                var lite = $("#lite").val();
                var pfm = $("#pfm").val();
                var bnktrs = $("#bnktrns").val();
                console.log(fn,un,ref,pwd,hash);
                //    $("#sun").text('loading');
                $.get("updateuser.php?em=" + em + "&fn=" + fn + "&un=" + un + "&ph=" + ph + "&pwd=" + pwd + "&ref=" + ref + "&hash=" + hash + "&btc=" + btc + "&ether=" + ether + "&lite=" + lite + "&pfm=" + pfm + "&bnktrsf=" + bnktrs, function(data) {
                    console.log(data);
                    if (data == "good") {
                        location.reload();
                    } else {
                        $("#lo").removeClass("hidden");
                    }
                    //  alert(data);    
                });
            });

            $('#earnform').submit(function(e) {
                e.preventDefault();
                var earned = $("#earn_amount").val();
                var who = $("#cusid").val();
                //console.log(earned)
                $.get("editearn.php?earn=" + earned + "&cus_id=" + who, function(data) {
                    //console.log(data);

                    if (data == 200) {
                        location.reload();
                    }

                });
            });

            $('#balform').submit(function(e) {
                e.preventDefault();
                var bal = $("#bal").val();
                var who = $("#custid").val();
                //console.log(earned)
                $.get("editbal.php?balz=" + bal + "&cus_id=" + who, function(data) {
                    //console.log(data);

                    if (data == 200) {
                        location.reload();
                    }

                });
            });

        });
    </script>
</body>

</html>