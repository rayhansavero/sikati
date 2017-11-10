<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>List Pengurus HMJ TI</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="font/material_icon.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
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

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">SI Keuangan HMJ TI</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
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
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">KAHIM</div>
                    <div class="email">Misbahul Hasan</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li>
                        <a href="index0.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="list_pengurus.php">
                            <i class="material-icons">supervisor_account</i>
                            <span>Pengurus HMJ TI</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Kas Rutin</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="list_kas_rutin.php">List Data Kas Rutin</a>
                            </li>
                            <li>
                                <a href="#">Laporan Kas Rutin</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Keuangan Kegiatan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="#">List Data Kegiatan</a>
                            </li>
                            <li>
                                <a href="#">Laporan Kegiatan</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Iuran</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="#">List Data Baru</a>
                            </li>
                            <li>
                                <a href="#">Laporan Iuran</a>
                            </li>
                        </ul>
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
          <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              Daftar Pengurus HMJ TI
                          </h2>
                      </div>
                      <div class="body">
                        <div class="icon-and-text-button-demo">
                            <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">
                                <i class="material-icons">add</i>
                                <span>Tambah Data</span>
                            </button>

                            <!--Tabel Data Pengurus-->
                            <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                  <thead>
                                      <tr>
                                          <th>NIM</th>
                                          <th>Nama</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $con=mysqli_connect('localhost','root','','sikati');
                                    $qu=mysqli_query($con,"select * from list_pengurus");
                                    while($has=mysqli_fetch_row($qu))
                                    {
                                      echo "
                                      <tr>
                                      <td>$has[0]</td>
                                      <td>$has[1]</td>
                                      <td style='text-align:center'>
                                      <a href='#&id=$has[0]'>
                                      <span data-placement='top' data-toggle='tooltip' title='Edit'>
                                        <button class='btn btn-primary btn-xs' data-title='Edit' data-toggle='modal' data-target='#edit' >
                                          <span class='medium material-icons'>create</span>
                                        </button>
                                      <span></a>
                                      <span data-placement='top' data-toggle='tooltip' title='Delete'>
                                        <button onclick='datadel($has[0],&#39;list_staf_jurkes&#39;)' class='btn btn-danger btn-xs' data-title='Delete' data-toggle='modal' data-target='#myModal' >
                                          <span class='medium material-icons'>delete</span>
                                        </button>
                                      <span>
                                      </td>
                                      </tr>
                                      ";
                                    }
                                    ?>
                                  </tbody>
                              </table>
                            </div>

                            <!--MODAL PENGURUS-->
                            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="defaultModalLabel">Masukkan Data Pengurus Baru</h4>
                                        </div>
                                        <div class="modal-body">
                                              <div class="col-md-6">
                                                  <div class="input-group">
                                                      <span class="input-group-addon">
                                                          <i class="material-icons">fingerprint</i>
                                                      </span>
                                                      <div class="form-line">
                                                          <input type="text" class="form-control date" placeholder="NIM" value="<?php echo isset($data[0])?$data[0]:''; ?>">
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="input-group">
                                                      <span class="input-group-addon">
                                                          <i class="material-icons">person</i>
                                                      </span>
                                                      <div class="form-line">
                                                          <input type="text" class="form-control date" placeholder="Nama Pengurus" value="<?php echo isset($data[1])?$data[1]:''; ?>">
                                                      </div>
                                                  </div>
                                              </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                                            <button type="submit" class="btn btn-link waves-effect" name="<?php echo isset($_GET['id'])?'update':'save'; ?>">SAVE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END MODAL PENGURUS-->

                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/ui/modals.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>
