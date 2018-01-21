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
    <title>Welcome to Sikati</title>

    <link rel="icon" href="invention.ico" type="image/x-icon">

    <link href="font/roboto_400_700_latin_cyrillic.css" rel="stylesheet" type="text/css">
    <link href="font/material_icon.css" rel="stylesheet" type="text/css">

    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">

    <link href="css/themes/all-themes.css" rel="stylesheet" />


    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery/jquery.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="plugins/node-waves/waves.js"></script>

    <!--Jquery Untuk Datatables -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>

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

    <!-- Jquery untuk Datetime Picker -->
    <script src="plugins/autosize/autosize.js"></script>
    <script src="plugins/momentjs/moment.js"></script>
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>
    <script src="js/pages/ui/modals.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>

    <script src="js/demo.js"></script>
    <script src="js/jquery.chained.min.js"></script>

</head>
<body class="theme-red">
  <!-- Page Loader >
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

  <div class="overlay"></div>

  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
        <a href="javascript:void(0);" class="bars"></a>
        <a class="navbar-brand" href="index.php?page=home">Sistem Informasi Keuangan HMJ TI</a>
      </div>
    </div>
  </nav>

  <section>
    <aside id="leftsidebar" class="sidebar">
      <div class="user-info">
        <div class="image">
          <img src="images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;">welcome <?php echo $_SESSION['LEVEL'] ?></div>
        </div>
      </div>

      <div class="menu">
        <ul class="list">
          <li class="header">MENU</li>
            <?php
                $masuk1 = $_SESSION['LEVEL'] == 'bendahara';
                if ($masuk1){
                //if(isset($_SESSION['LEVEL']) && $_SESSION['LEVEL'] != 'admin') {
            ?>
          <!--MENU HOME-->
          <li <?php if($_GET['page']=='home') {echo "class='active'";}?>>
            <a href="index.php?page=home"><i class="material-icons">home</i><span>Home</span></a>
          </li>
          <!--MENU PENGURUS-->
          <li <?php if($_GET['page']=='pengurus') {echo "class='active'";}?>>
            <a href="index.php?page=pengurus"><i class="material-icons">people</i><span>List Pengurus</span></a>
          </li>
          <!--MENU KAS RUTIN-->
          <li <?php if($_GET['page']=='kas_rutin') {echo "class='active'";}
                    elseif($_GET['page']=='laporan_kas') {echo "class='active'";}?>>
            <a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">assignment</i><span>List Kas Rutin</span></a>
            <ul class="ml-menu">
              <li <?php if($_GET['page']=='kas_rutin') {echo "class='active'";}?>>
                <a href="index.php?page=kas_rutin">Data Kas Rutin</a>
              </li>
              <li <?php if($_GET['page']=='laporan_kas') {echo "class='active'";}?>>
                <a href="index.php?page=laporan_kas">Laporan Kas Rutin</a>
              </li>
            </ul>
          </li>
          <!--MENU BUKU BESAR KAS-->
          <li <?php if($_GET['page']=='buku_besar_kas') {echo "class='active'";}
                    elseif($_GET['page']=='laporan_buku_besar_kas') {echo "class='active'";}?>>
            <a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">assignment</i><span>List Buku Besar Kas</span></a>
            <ul class="ml-menu">
              <li <?php if($_GET['page']=='buku_besar_kas') {echo "class='active'";}?>>
                <a href="index.php?page=buku_besar_kas">Data Buku Besar Kas</a>
              </li>
              <li <?php if($_GET['page']=='laporan_buku_besar_kas') {echo "class='active'";}?>>
                <a href="index.php?page=laporan_buku_besar_kas">Laporan Buku Besar Kas</a>
              </li>
            </ul>
          </li>
          <!--MENU KEGIATAN-->
          <li <?php if($_GET['page']=='pra_kegiatan') {echo "class='active'";}
                      elseif($_GET['page']=='pasca_kegiatan') {echo "class='active'";}
                      elseif($_GET['page']=='laporan_pra') {echo "class='active'";}
                      elseif($_GET['page']=='laporan_pasca') {echo "class='active'";}?>>
            <a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">assignment</i><span>List Keuangan Kegiatan</span></a>
            <ul class="ml-menu">
              <li <?php if($_GET['page']=='pra_kegiatan') {echo "class='active'";}?>>
                <a href="index.php?page=pra_kegiatan">Data Pra Kegiatan</a>
              </li>
              <li <?php if($_GET['page']=='pasca_kegiatan') {echo "class='active'";}?>>
                <a href="index.php?page=pasca_kegiatan">Data Pasca Kegiatan</a>
              </li>
              <li <?php if($_GET['page']=='laporan_pra') {echo "class='active'";}?>>
                <a href="index.php?page=laporan_pra">Laporan Pra Kegiatan</a>
              </li>
              <li <?php if($_GET['page']=='laporan_pasca') {echo "class='active'";}?>>
                <a href="index.php?page=laporan_pasca">Laporan Pasca Kegiatan</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="logout.php"><i class="material-icons">power_settings_new</i><span>Log Out</span></a>
          </li>
            <?php } ?>
<!--=============================================================================================================================-->
<!--=============================================================================================================================-->
            <?php
                $masuk2 = $_SESSION['LEVEL'] == 'kahim';
                if ($masuk2){
                //if(isset($_SESSION['LEVEL']) && $_SESSION['LEVEL'] != 'kahim') {
            ?>
          <!--MENU HOME-->
          <li <?php if($_GET['page']=='home') {echo "class='active'";}?>>
            <a href="index.php?page=home"><i class="material-icons">home</i><span>Home</span></a>
          </li>
          <!--MENU PENGURUS-->
          <li <?php if($_GET['page']=='pengurus') {echo "class='active'";}?>>
            <a href="index.php?page=pengurus"><i class="material-icons">people</i><span>List Pengurus</span></a>
          </li>
          <!--MENU KAS RUTIN-->
          <li <?php if($_GET['page']=='kas_rutin') {echo "class='active'";}?>>
            <a href="index.php?page=kas_rutin"><i class="material-icons">assignment</i><span>Laporan Kas Rutin</span></a>
          </li>
          <!--MENU BUKU BESAR KAS-->
          <li <?php if($_GET['page']=='buku_besar_kas') {echo "class='active'";}?>>
            <a href="index.php?page=buku_besar_kas"><i class="material-icons">assignment</i><span>Laporan Buku Besar Kas</span></a>
          </li>
          <!--MENU KEGIATAN-->
          <li <?php if($_GET['page']=='laporan_pra') {echo "class='active'";}
                    elseif($_GET['page']=='laporan_pasca') {echo "class='active'";}?>>
            <a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">assignment</i><span>Laporan Keuangan Kegiatan</span></a>
            <ul class="ml-menu">
              <li <?php if($_GET['page']=='laporan_pra') {echo "class='active'";}?>>
                <a href="index.php?page=laporan_pra">Laporan Pra Kegiatan</a>
              </li>
              <li <?php if($_GET['page']=='laporan_pasca') {echo "class='active'";}?>>
                <a href="index.php?page=laporan_pasca">Laporan Pasca Kegiatan</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="logout.php"><i class="material-icons">power_settings_new</i><span>Log Out</span></a>
          </li>
            <?php } ?>
        </ul>
      </div>




      <!--FOOTER-->
      <div class="legal">
        <div class="copyright">
          &copy; 2017 <a href="javascript:void(0);">Code Lover Team</a>.
        </div>
        <div class="version">
          <b>Version: </b> 1.0.a
        </div>
      </div>
    </aside>
  </section>

  <section class="content">
    <div class="container-fluid">
      <?php
      if(isset($_GET['page'])) {
        $page = $_GET['page'];
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
        case 'buku_besar_kas':
        include "data/buku_besar_kas.php";
        break;
        case 'pra_kegiatan':
        include "data/pra_kegiatan.php";
        break;
        case 'pasca_kegiatan':
        include "data/pasca_kegiatan.php";
        break;

        case 'laporan_kas':
        include "data/laporan_kas_rutin.php";
        break;
        case 'laporan_buku_besar_kas':
        include "data/laporan_buku_besar_kas.php";
        break;
        case 'laporan_pra':
        include "data/laporan_pra_kegiatan.php";
        break;
        case 'laporan_pasca':
        include "data/laporan_pasca_kegiatan.php";
        break;

        case 'tambah_pengurus':
        include "data/tambah_pengurus.php";
        break;
        case 'tambah_kas':
        include "data/tambah_kas.php";
        break;
        }
      }
      else {
        include "data/dashboard.php";
      }
      ?>
    </div>
  </section>

</body>
</html>

<?php } ?>
