<?php
session_start();
if(!isset($_SESSION['LEVEL'])){
    header("location:login.php");
}else{
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin Dashboard | Sikati</title>

    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="font/roboto_400_700_latin_cyrillic.css" rel="stylesheet" type="text/css">
    <link href="font/material_icon.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery/jquery.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery Untuk DataTable -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!--Jquery Untuk Chart Dashboard -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>
    <script src="plugins/chartjs/Chart.bundle.js"></script>
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="js/pages/ui/modals.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <script src="js/jquery.chained.min.js"></script>


</head>

<body class="theme-red">
    <!-- Page Loader -->
    <!--div class="page-loader-wrapper">
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
    </div-->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php?page=home">Sistem Informasi Keuangan HMJ TI</a>
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
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">WELLCOME <?php echo $_SESSION['LEVEL'] ?></div>
                </div>
            </div>
            <!-- #User Info -->


            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li <?php if($_GET['page']=='home') {echo "class='active'";}?>>
                      <a href="index.php?page=home"><i class="material-icons">home</i><span>Home</span></a>
                    </li>
                    <li <?php if($_GET['page']=='pengurus') {echo "class='active'";}?>>
                      <a href="index.php?page=pengurus"><i class="material-icons">people</i><span>List Pengurus</span></a>
                    </li>
                    <li <?php if($_GET['page']=='kas_rutin') {echo "class='active'";}?>>
                      <a href="index.php?page=kas_rutin"><i class="material-icons">assignment</i><span>List Kas Rutin</span></a>
                    </li>
                    <li <?php if($_GET['page']=='pra_kegiatan') {echo "class='active'";}
                          elseif($_GET['page']=='pasca_kegiatan') {echo "class='active'";}?>>
                      <a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">assignment</i><span>List Keuangan Kegiatan</span></a>
                        <ul class="ml-menu">
                            <li <?php if($_GET['page']=='pra_kegiatan') {echo "class='active'";}?>>
                              <a href="index.php?page=pra_kegiatan">Pra Kegiatan</a>
                            </li>
                            <li <?php if($_GET['page']=='pasca_kegiatan') {echo "class='active'";}?>>
                              <a href="index.php?page=pasca_kegiatan">Pasca Kegiatan</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                      <a href="pages/changelogs.html"><i class="material-icons">update</i><span>Dari Template</span></a>
                    </li>
                    <li>
                      <a href="logout.php"><i class="material-icons">power_settings_new</i><span>Log Out</span></a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->

            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">Code Lover Team</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.a
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            //if(!isset($_GET['page'])) {
              //include "data/dashboard.php";
            //}
            //else {
              switch($page) {
                case 'home' :
                include "data/dashboard.php";
                break;
                case 'pengurus':
                include "data/list_pengurus.php";
                break;
                case 'kas_rutin':
                include "data/list_kas_rutin.php";
                break;
                case 'pra_kegiatan':
                include "data/pra_kegiatan.php";
                break;
                case 'pasca_kegiatan':
                include "data/pasca_kegiatan.php";
                break;
                }
            }else{
              include "data/dashboard.php";
            }
            ?>
        </div>
    </section>

    <!--div id="mpengurus" class="modal fade">
    </div-->


</body>

</html>
<!--script>
$(".editPengurus").click(function(e){
  var m = $(this).attr("id");
    $.ajax({
      url:"data/editpengurus.php",
      type:"GET",
      data:{id_pengurus:m,},
      success :function(ajaxData){
        $("#mpengurus").html(ajaxData);
        $("#mpengurus").modal('show',{backdrop:'true'});
      }
    });
    });
</script-->
<?php } ?>
