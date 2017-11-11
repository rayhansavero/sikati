<?php
session_start();
if(!isset($_SESSION['NAMA_ADMIN'])){
    header("location:login.php");
}else{
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>List Pengurus HMJ TI | Sikati</title>

  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <link href="font/roboto_400_700_latin_cyrillic.css" rel="stylesheet" type="text/css">
  <link href="font/material_icon.css" rel="stylesheet" type="text/css">

  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="plugins/node-waves/waves.css" rel="stylesheet" />
  <link href="plugins/animate-css/animate.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
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
    </div>
  </nav>
  <!-- #Top Bar -->

  <section>
    <aside id="leftsidebar" class="sidebar">
      <div class="user-info">
        <div class="image">
          <img src="images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['NAMA_ADMIN'] ?></div>
          <div class="email"></div>
          <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
              <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
              <li role="seperator" class="divider"></li>
              <li><a href="logout.php"><i class="material-icons">input</i>Sign Out</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="menu">
        <ul class="list">
          <li class="header">MENU</li>
          <li>
            <a href="index.php">
              <i class="material-icons">home</i>
              <span>Home</span>
            </a>
          </li>
          <li class="active">
            <a href="list_pengurus.php">
              <i class="material-icons">people</i>
              <span>List Pengurus</span>
            </a>
          </li>
          <li>
            <a href="list_kas_rutin.php">
              <i class="material-icons">assignment</i>
              <span>List Kas Rutin</span>
            </a>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
              <i class="material-icons">assignment</i>
              <span>List Keuangan Kegiatan</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="#">Pra Kegiatan</a>
              </li>
              <li>
                <a href="#">Pasca Kegiatan</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="pages/changelogs.html">
              <i class="material-icons">update</i>
              <span>Dari Template</span>
            </a>
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
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#pengurus">
                    <i class="material-icons">add</i>
                    <span>Tambah Data</span>
                  </button>
                </div>

                <!--TABEL DATA PENGURUS-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                            <a href='#pengurus&id=$has[0]'>
                            <span data-toggle='tooltip' data-placement='right' title='Edit'>
                              <button class='btn btn-primary btn-xs waves-effect' data-title='Edit' data-toggle='modal' data-target='#pengurus' >
                                <span class='material-icons md-18'>create</span>
                              </button>
                            <span>
                            </a>
                            <span data-toggle='tooltip' title='Delete'>
                              <button onclick='datadel($has[0],&#39;list_staf_jurkes&#39;)' class='btn btn-danger btn-xs waves-effect' data-title='Delete' data-toggle='modal' data-target='#myModal' >
                                <span class='material-icons md-18'>delete</span>
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
              </div>
              <!--END TABEL DATA PENGURUS-->

              <!--MODAL PENGURUS-->
              <div class="modal fade" id="pengurus">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="pengurusLabel">Form Data Pengurus</h4>
                    </div>
                    <div class="modal-body">
                      <div class="col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="material-icons">fingerprint</i>
                          </span>
                          <div class="form-line">
                            <input type="text" class="form-control date" placeholder="NIM" name="id_pengurus" value="<?php echo isset($data[0])?$data[0]:''; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="material-icons">person</i>
                          </span>
                          <div class="form-line">
                            <input type="text" class="form-control date" placeholder="Nama Pengurus" name="nama_pengurus"value="<?php echo isset($data[1])?$data[1]:''; ?>">
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

              <!--PROSES TAMBAH/EDIT DATA PENGURUS-->
              <?php
              if(isset($_POST['save']))
              {
                  $getId=mysqli_fetch_row(mysqli_query($con,"select max(id) from list_pengurus"));
                  mysqli_query($con,"insert into list_pengurus values('$ID_PENGURUS','$NAMA_PENGURUS')");
                  echo "
                  <script>
                  location.assign('list_pengurus.php&ps=true1');
                  </script>
                  ";
              }
              elseif(isset($_POST['update']))
              {
                mysqli_query($con,"update list_pengurus set id_pengurus='$ID_PENGURUS',nama_pengurus='$NAMA_PENGURUS' where id='".$_GET['id']."'");
                echo "
                <script>
                location.assign('index.php?page=list_pengurus&ps=true2');
                </script>
                ";
              }
              ?>
              <!--END PROSES TAMBAH/EDIT DATA PENGURUS-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.js"></script>
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
<script src="plugins/node-waves/waves.js"></script>

<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<script src="js/admin.js"></script>
<script src="js/pages/ui/modals.js"></script>
<script src="js/pages/tables/jquery-datatable.js"></script>

<script src="js/demo.js"></script>

</body>
</html>
<?php } ?>
