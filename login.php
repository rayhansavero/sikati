<!--?php
session_start();
if(isset($_SESSION['NAMA_ADMIN'])){
    header("location:index.php?page=home");
}else{
?-->
<?php $con = mysqli_connect('localhost','root','','sikati'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login | Sikati</title>

    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="font/material_icon.css" rel="stylesheet" type="text/css">

    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Sikati</b></a>
            <small>Sistem Informasi Keuangan HMJ TI</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" action="" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="ID_ADMIN" placeholder="Id Admin" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="PASSWORD" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" name="signin" value="SIGN IN">SIGN IN</button>
                        </div>
                    </div>
                </form>

                <?php
                    $con=mysqli_connect('localhost','root','','sikati');
                    if (isset($_POST['signin'])){
                        $cek = mysqli_query($con, "SELECT * FROM list_admin WHERE ID_ADMIN = '".$_POST['ID_ADMIN']."' AND PASSWORD = '".$_POST['PASSWORD']."' ");
                        $hasil = mysqli_fetch_array($cek);
                        $count = mysqli_num_rows($cek);
                        $nama_admin = $hasil['NAMA_ADMIN'];

                        if($count > 0){
                            session_start();
                            $_SESSION['NAMA_ADMIN'] = $nama_admin;
                            //$_SESSION['level'] = $hasil1;
                            header("location:index.php?page=home");
                        }else{
                            echo "gagal masuk";
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <script src="plugins/node-waves/waves.js"></script>
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>
<!--?php } ?-->
