<?php
$con = mysqli_connect('localhost','root','','sikati');
?>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>List Keuangan pasca Kegiatan </h2>
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
                <option value="">Pilih pasca Kegiatan</option>
                <?php
                $tahun = mysqli_query($con, "select * from kegiatan where id_kegiatan like 'PS%'");
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
          <h2>Tabel pasca Kegiatan
            <?php
            $nama = mysqli_query($con,"select nama_kegiatan from kegiatan where id_kegiatan='$kegiatan'");
            $tampil = mysqli_fetch_array($nama);
            echo $tampil['nama_kegiatan'];
            ?>
            Tanggal
            <?php
            $tgl = mysqli_query($con,"select tgl_kegiatan from kegiatan where id_kegiatan='$kegiatan'");
            $tampil = mysqli_fetch_array($tgl);
            echo $tampil['tgl_kegiatan'];
            ?>
          </h2>
      </div>
      <div class="body">
          <table class="table table-bordered table-striped table-hover dataTable js-exportable">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Uraian</th>
              <th class="text-center">Debit</th>
              <th class="text-center">Kredit</th>
              <th class="text-center">Saldo</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $qu = mysqli_query($con,"select * from proses_kegiatan where id_kegiatan='$kegiatan'");
            while ($has = mysqli_fetch_row($qu))
            {
            ?>
              <tr>
                <td width='5%'><?php echo $no++; ?></td>
                <td><?php echo $has[2]; ?></td>
                <td>Rp <?php echo $has[3]; ?></td>
                <td>Rp <?php echo $has[4]; ?></td>
                <td>Rp <?php echo $has[5]; ?></td>
                <td><?php echo $has[6]; ?></td>
                <td><?php echo $has[7]; ?></td>
              </tr>
              <?php } ?>
          </tbody>
          <!--tfoot>
            <th class="text-right">Jumlah</th>
            <th><?php
                $debit = mysqli_query($con,"select sum(debit_proses) from proses_kegiatan");
                $tampil = mysqli_fetch_array($debit);
                echo $tampil['sum(debit_proses)'];
                ?>
            </th>
            <th><?php
                $kredit = mysqli_query($con,"select sum(kredit_proses) from proses_kegiatan");
                $tampil = mysqli_fetch_array($kredit);
                echo $tampil['sum(kredit_proses)'];
                ?>
            </th>
            <th><?php
                $saldo = mysqli_query($con,"select sum(saldo_proses) from proses_kegiatan");
                $tampil = mysqli_fetch_array($saldo);
                echo $tampil['sum(saldo_proses)'];
                ?>
            </th>
          </tfoot-->
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
