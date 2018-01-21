<?php
$con = mysqli_connect('localhost','root','','sikati');
?>

<!--PILIH PERIODE KEPENGURUSAN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Menu Laporan Keuangan Pra Kegiatan </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <form action="" method="POST" role="form">
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <select class="form-control show-tick" name="kegiatan">
                <option value="">Pilih Pra Kegiatan</option>
                <?php
                $tahun = mysqli_query($con, "SELECT * FROM kegiatan WHERE id_kegiatan LIKE 'PR%'");
                while ($row = mysqli_fetch_array($tahun)) {
                ?>
                <option value="<?php echo $row['id_kegiatan']; ?>"><?php echo $row['nama_kegiatan']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
            <button type="submit" class="btn btn-primary waves-effect" name="tampil">
              <span>Tampilkan</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END PILIH KEGIATAN-->

<?php
if (isset($_POST['tampil'])) {
$kegiatan = $_POST['kegiatan'];
?>
<!--TABEL KEGIATAN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h2>Tabel Pra Kegiatan
            <?php
            $nama = mysqli_query($con,"SELECT nama_kegiatan FROM kegiatan WHERE id_kegiatan='$kegiatan'");
            $tampil = mysqli_fetch_array($nama);
            echo $tampil['nama_kegiatan'];
            ?>
            Tanggal
            <?php
            $tgl = mysqli_query($con,"SELECT tgl_kegiatan FROM kegiatan WHERE id_kegiatan='$kegiatan'");
            $tampil = mysqli_fetch_array($tgl);
            echo $tampil['tgl_kegiatan'];
            ?>
          </h2>
      </div>
      <div class="body">
        <!--===================TABEL LAPORAN PRA KEGIATAN===================-->
        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Uraian</th>
              <th class="text-center">Debit</th>
              <th class="text-center">Kredit</th>
              <th class="text-center">Saldo</th>
              <th class="text-center">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $qu = mysqli_query($con,"SELECT * FROM proses_kegiatan WHERE id_kegiatan='$kegiatan'");
            while ($has = mysqli_fetch_row($qu))
            {
            ?>
              <tr>
                <td width='5%'><?php echo $no++; ?></td>
                <td><?php echo $has[2]; ?></td>
                <td><?php echo $has[3]; ?></td>
                <td>Rp <?php echo $has[4]; ?></td>
                <td>Rp <?php echo $has[5]; ?></td>
                <td>Rp <?php echo $has[6]; ?></td>
                <td><?php echo $has[7]; ?></td>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot>
            <th colspan="3" class="text-right">Jumlah</th>
            <th>Rp
                <?php
                $debit = mysqli_query($con,"SELECT SUM(debit_proses) AS tdebit FROM proses_kegiatan WHERE id_kegiatan='$kegiatan'");
                $tampil = mysqli_fetch_array($debit);
                echo $tampil['tdebit'];
                ?>
            </th>
            <th>Rp
                <?php
                $kredit = mysqli_query($con,"SELECT SUM(kredit_proses) AS tkredit FROM proses_kegiatan WHERE id_kegiatan='$kegiatan'");
                $tampil = mysqli_fetch_array($kredit);
                echo $tampil['tkredit'];
                ?>
            </th>
            <th>Rp
                <?php
                $saldo = mysqli_query($con,"SELECT SUM(saldo_proses) AS tsaldo FROM proses_kegiatan WHERE id_kegiatan='$kegiatan'");
                $tampil = mysqli_fetch_array($saldo);
                echo $tampil['tsaldo'];
                ?>
            </th>
          </tfoot>
        </table>
        <!--===================TABEL LAPORAN PRA KEGIATAN===================-->
      </div>
    </div>
  </div>
</div>
<?php } ?>
