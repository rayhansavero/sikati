<?php
$con = mysqli_connect('localhost','root','','sikati');
?>

<!--PILIH PERIODE KAS RUTIN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Menu Laporan Kas Rutin</h2>
      </div>
      <div class="body">
        <form action="" method="POST" role="form">
        <div class="row clearfix">
          <div class="col-md-3">
            <select class="form-control show-tick" name="bulan">
              <option value="">-- Pilih Bulan --</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-control show-tick" name="tahun">
              <option value="">-- Pilih Tahun --</option>
              <?php
              $tahun = mysqli_query($con, "SELECT * FROM tahun");
              while ($row = mysqli_fetch_array($tahun)) { ?>
              <option value="<?php echo $row['pilih_tahun']; ?>"><?php echo $row['pilih_tahun']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary waves-effect" name="tampil">
              <span>Tampilkan</span>
            </button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--TABEL DATA BAYAR KAS-->
<?php
if(isset($_POST['tampil'])) {
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
?>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Tabel Kas Rutin Bulan
          <?php
          $namabulan = array('01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April',
                              '05' => 'Mei','06' => 'Juni','07' => 'Juli','08' => 'Agustus',
                              '09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember');
          echo $namabulan[($bulan)];
          ?>
          Tahun
          <?php echo $tahun; ?>
        </h2>
      </div>
      <div class="body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover dataTable js-exportable">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Pengurus</th>
                <th class="text-center">Jumlah Bayar</th>
                <th class="text-center">Tanggal Bayar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($con, "SELECT * FROM bayar_kas WHERE month(tgl_bayar_kas)='$bulan' AND year(tgl_bayar_kas)='$tahun'");
              while ($has = mysqli_fetch_array($query)) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php $tampilpeng = mysqli_query($con, "SELECT * FROM pengurus WHERE id_pengurus='$has[id_pengurus]'");
                                $peng	= mysqli_fetch_array($tampilpeng);
                                        echo $peng['nama_pengurus']
                    ?>
                </td>
                <td>Rp <?php echo $has[4]; ?></td>
                <td><?php echo $has[3]; ?></td>
              </tr>
            <?php } ?>
            </tbody>
            <tfoot>
              <th colspan="2" class="text-right">Jumlah</th>
              <th>Rp
                  <?php
                  $jml = mysqli_query($con,"SELECT SUM(jumlah_bayar_kas) AS jmlkas FROM bayar_kas WHERE MONTH(tgl_bayar_kas)='$bulan' AND YEAR(tgl_bayar_kas)='$tahun'");
                  $tampil = mysqli_fetch_array($jml);
                  echo $tampil['jmlkas'];
                  ?>
              </th>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
