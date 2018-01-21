<?php
$con = mysqli_connect('localhost','root','','sikati');
?>
<!-- Widgets -->
<div class="row clearfix">
  <?php
  $tahun = date('Y');
  $namabulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
  $bulan = date('m');
  ?>
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="info-box bg-cyan hover-expand-effect">
      <div class="icon">
        <i class="material-icons">monetization_on</i>
      </div>
      <div class="content">
        <?php
        $datatahun = mysqli_query($con,"SELECT SUM(jumlah_bayar_kas) FROM bayar_kas WHERE YEAR(tgl_bayar_kas) = '$tahun'");
        $tampiltahun = mysqli_fetch_array($datatahun);
        ?>
        <div class="text" style="text-transform:uppercase;">Total Kas masuk Periode <?php echo $tahun; ?></div>
        <div class="number count-to" data-from="0" data-to="<?php echo $tampiltahun['SUM(jumlah_bayar_kas)']?>" data-speed="1000" data-fresh-interval="20"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="info-box bg-pink hover-expand-effect">
      <div class="icon">
        <i class="material-icons">monetization_on</i>
      </div>
      <div class="content">
        <div class="text" style="text-transform:uppercase;">Total Kas masuk <?php echo $namabulan[date('n')]; ?> <?php echo $tahun; ?></div>
        <?php
        $kasmasuk = mysqli_query($con,"SELECT SUM(debit_bbs) AS debit FROM buku_besar_kas WHERE month(tgl_bbs) = '$bulan' AND year(tgl_bbs)='$tahun'");
        $tampilkas = mysqli_fetch_array($kasmasuk);
        ?>
        <div class="number count-to" data-from="0" data-to="<?php echo $tampilkas['debit']?>" data-speed="15" data-fresh-interval="20"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="info-box bg-teal hover-expand-effect">
      <div class="icon">
        <i class="material-icons">monetization_on</i>
      </div>
      <div class="content">
        <div class="text" style="text-transform:uppercase;">Total Kas keluar <?php echo $namabulan[date('n')]; ?> <?php echo $tahun; ?></div>
        <?php
        $kaskeluar = mysqli_query($con,"SELECT SUM(kredit_bbs) AS kredit FROM buku_besar_kas WHERE month(tgl_bbs)='$bulan' AND year(tgl_bbs)='$tahun'");
        $tampilkas = mysqli_fetch_array($kaskeluar);
        ?>
        <div class="number count-to" data-from="0" data-to="<?php echo $tampilkas['kredit']?>" data-speed="15" data-fresh-interval="20"></div>
      </div>
    </div>
  </div>


<!-- CPU Usage -->
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>CPU USAGE (%)</h2>
          </div>
          <div class="col-xs-12 col-sm-6 align-right">
            <div class="switch panel-switch-btn">
              <span class="m-r-10 font-12">REAL TIME</span>
              <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
            </div>
          </div>
        </div>
      </div>
      <div class="body">
        <div id="real_time_chart" class="dashboard-flot-chart"></div>
      </div>
    </div>
  </div>
</div>
<!-- #END# CPU Usage -->
