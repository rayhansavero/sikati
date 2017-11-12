<?php
session_start();
if(!isset($_SESSION['NAMA_ADMIN']))
{
  header("location:login.php");
}
else
{
?>
<!DOCTYPE html>
<html>

<!--PROSES TAMBAH/EDIT DATA PENGURUS-->
<?php
$con=mysqli_connect('localhost','root','','sikati');

if (isset($_POST['simpan']))
{
  $id= $_POST['id_pengurus'];
  $nama= $_POST['nama_pengurus'];
  $query= mysqli_query($con,"insert into list_pengurus values ('$id','$nama')") or die(mysql_error());
  echo "
  <script> alert ('Data Behasil di Tambahkan');
  document.location='list_pengurus.php';
  </script>
  ";
}
elseif (isset($_POST['update']))
{
  $id= $_POST['id_pengurus'];
  $nama= $_POST['nama_pengurus'];
  $query= mysqli_query($con,"update list_pengurus set id_pengurus='$id',nama_pengurus='$nama' where id_pengurus='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Behasil di Update');
  document.location='list_pengurus.php';
  </script>
  ";
}
elseif (isset($_POST['hapus']))
{
  $id= $_POST['hapus'];
  $query= mysqli_query($con,"delete from list_pengurus where id_pengurus='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Behasil di Hapus');
  document.location='list_pengurus.php';
  </script>
  ";
}
?>
<!--END PROSES TAMBAH/EDIT DATA PENGURUS-->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>List Pengurus HMJ TI | Sikati</title>

  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <link href="font/roboto_400_700_latin_cyrillic.css" rel="stylesheet" type="text/css">
  <link href="font/material_icon.css" rel="stylesheet" type="text/css">

  <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

            <!--TOMBOL TAMBAH DATA PENGURUS-->
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#tambahPengurus">
                    <i class="material-icons">add</i>
                    <span>Tambah Data</span>
                  </button>
                </div>
                <!--TOMBOL TAMBAH DATA PENGURUS-->
                <!--MODAL TAMBAH DATA PENGURUS-->
                <div class="modal fade" id="tambahPengurus" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="pengurusLabel">Form Edit Data Pengurus</h4>
                      </div>
                      <div class="modal-body">
                        <form action="" method="POST" role="form">
                        <div class="col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">fingerprint</i>
                            </span>
                            <div class="form-line">
                              <input onkeyup="this.value=this.value.toUpperCase()" type="text" class="form-control" placeholder="NIM" name="id_pengurus">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                              <input type="text" class="form-control" placeholder="Nama Pengurus" name="nama_pengurus">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn btn-link waves-effect" name="simpan">SIMPAN</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!--END MODAL TAMBAH DATA PENGURUS-->

                <!--TABEL DATA PENGURUS-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $qu=mysqli_query($con,"select * from list_pengurus");
                      while($has=mysqli_fetch_row($qu))
                      {
                        ?>
                        <tr>
                          <td><?php echo $has[0]; ?></td>
                          <td><?php echo $has[1]; ?></td>
                          <td td style="text-align:center">
                            <!--TOMBOL EDIT DATA-->
                            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#editPengurus<?php echo $has[0]; ?>">
                              <i class="material-icons">edit</i>
                            </button>
                            <!--MODAL EDIT DATA PENGURUS-->
                            <div class="modal fade" id="editPengurus<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="pengurusLabel">Form Tambah Data Pengurus</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form action="" method="POST" role="form">
                                    <div class="col-md-12">
                                      <div class="input-group">
                                        <span class="input-group-addon">
                                          <i class="material-icons">fingerprint</i>
                                        </span>
                                        <div class="form-line">
                                          <input onkeyup="this.value=this.value.toUpperCase()" type="text" class="form-control" placeholder="NIM" name="id_pengurus" value="<?php echo $has[0]; ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="input-group">
                                        <span class="input-group-addon">
                                          <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                          <input type="text" class="form-control" placeholder="Nama Pengurus" name="nama_pengurus" value="<?php echo $has[1]; ?>">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                                    <button type="submit" class="btn btn-link waves-effect" name="update">UPDATE</button>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--END MODAL EDIT DATA PENGURUS-->

                            <!--TOMBOL HAPUS DATA-->
                            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#hapusPengurus<?php echo $has[0]; ?>">
                              <i class="material-icons">delete</i>
                            </button>
                            <!--MODAL HAPUS DATA PENGURUS-->
                            <div class="modal fade" id="hapusPengurus<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <form action="" method="POST" role="form">
                                      Apakah Anda Ingin Menghapus Data <?php echo $has[1]; ?>?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                                    <button type="submit" class="btn btn-link waves-effect" name="hapus" value="<?php  echo $has[0]; ?>">HAPUS</button>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--END MODAL HAPUS DATA PENGURUS-->
                          </td>
                        </tr>
                        <?php
                        ;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--END TABEL DATA PENGURUS-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="plugins/jquery/jquery.js"></script>
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
