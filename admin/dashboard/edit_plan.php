<?php
ob_start();
session_start();

require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->block_plan();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!--  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>  Crypstaccel Tradefast   || Admin Dashboard || Edit Plans </title>
    <!-- ================= Favicon ================== -->
     <?php
        if ( !isset($_SESSION["admin_name"]) && !isset($_SESSION["admin_id"]) ) {
        
             echo '
                <script>
                    window.location.assign("../");
                </script>
           ';
          
        }
    ?>
    <!-- Standard -->
        <link rel="icon" type="image/icon" href="../../images/favicon/favicon.png">
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/datatables.min.css"/>
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
                                    <li class="active">Edit Plans</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card">
                                <div class="panel panel-primary">
                                    <div class="panel-header">
                                        <h4 class="text-center"> Edit Plans </h4>
                                    </div>
                                    <div class="panel-body"> </h5>
                                        <form class="form-horizontal" id="invest">
                                         <?php $classObj->editnewplan(); ?> 
                                    </div>
                                    <div class="panel-footer">
                                        <div id="result"></div>
                                        <button type="submit" id="sun" class="btn btn-primary btn-block btn-flat"> Edit Plan </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>  Crypstaccel Tradefast   &copy; <span id="date-time"></span>
                                </p>
                            </div>
                        </div>
                    </div>

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

           $('#invest').submit(function(e){
                e.preventDefault(); 
                var mi = $("#mi").val();
                var ids = $("#ids").val();
                var pname = $("#pname").val();
                var ma = $("#ma").val();
                var pect = $("#pect").val();
                var bpect = $("#bonus_pect").val();
                var dura = $("#dura").val();
                var freq = $("#freq").val();
                // alert(amount);
                // alert(bal);
                // alert(who);
               // console.log(mi + ' ' + pname + ' ' + ma + ' ' + pect + ' ' + dura + ' ' + ids);
                
                   /// $("#sun").html('<img src="../images/ajax-loader.gif" width="50" heigth="50" />');
                              
                    $.get("editplan.php?mi="+mi+"&pname="+pname+"&ma="+ma+"&pect="+pect+"&bpect="+bpect+"&dura="+dura+"&freq="+freq+"&id="+ids, function(data){
                     //console.log(data);
                     if (data == 201) {
                        swal("TimeOUT!", "Minimum  amount can't be bigger than the Maximum amount.", "error");
                     }
                    else if(data == 200){
                          location.assign("plan.php");
                     }
                  
                 });
           });
        });
    </script>

</body>

</html>

<?php ob_end_flush(); ?>