<?php
$con = mysqli_connect('localhost','root','','sikati');
?>

<!--PILIH PERIODE KEPENGURUSAN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Menu Halaman Kas Rutin</h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <form action="" method="POST" role="form">
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <select class="form-control show-tick" name="tahun">
                <option value="">Pilih Periode</option>
                <?php
                $tahun = mysqli_query($con, "SELECT * FROM tahun");
                while ($row = mysqli_fetch_array($tahun)) {
                ?>
                <option value="<?php echo $row['id_tahun']; ?>"><?php echo $row['pilih_tahun']; ?></option>
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
<!--END PILIH PERIODE KEPENGURUSAN-->

<?php
if (isset($_POST['tampil'])) {
  $tahun = $_POST['tahun'];
?>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          Data Kas Periode
          <?php
          $periode = mysqli_query($con,"select pilih_tahun from tahun where id_tahun='$tahun'");
          $per = mysqli_fetch_array($periode);
          echo $per['pilih_tahun'];
          ?>
        </h2>
      </div>
      <div class="body">

          <!--TOMBOL TAMBAH DATA KAS-->
          <div class="row clearfix">
          <form class="" action="index.php?page=tambah_kas" method="post">
            <div class="col-md-2">
              <div class="input-group">
                <div class="form-line">
                  <input type="number" min="1" class="form-control" placeholder="Jumlah Data" name="jmlTambah" required>
                  <input type="hidden" name="tahun" value="<?php echo $tahun; ?>" readonly>
                </div>
              </div>
            </div>
            <button type="submit" name="tambahPengurus" class="btn btn-primary waves-effect">
              <span>Tambah Kas</span>
            </button>
          </form>
          </div>
          <!--END TOMBOL TAMBAH DATA KAS-->

          <!--TABEL DATA KAS-->
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Total Bayar</th>
                <th class="text-center">Detail Pembayaran</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $qu = mysqli_query($con,"SELECT * FROM pengurus WHERE id_tahun='$tahun'");
              while ($has = mysqli_fetch_row($qu))
              {
              ?>
              <tr>
                <td width='5%'><?php echo $no++; ?></td>
                <td><?php echo $has[1]; ?></td>
                <td>Rp
                    <?php $total = mysqli_query($con,"SELECT SUM(jumlah_bayar_kas) FROM bayar_kas WHERE id_pengurus='$has[0]'");
                          $tampil = mysqli_fetch_array($total);
                          echo $tampil['SUM(jumlah_bayar_kas)'];
                    ?>
                </td>
                <td style="text-align:center">
                <!--TOMBOL DETAIL DATA-->
                <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#detailKas<?php echo $has[0]; ?>">
                  <i class="material-icons">description</i>
                </button>

                <!--MODAL DETAIL DATA-->
                  <div class="modal fade" id="detailKas<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Detail Pembayaran <?php echo $has[1]; ?></h4>
                        </div>
                        <div class="modal-body">
                          <?php
                          $detail = mysqli_query($con,"SELECT * FROM bayar_kas WHERE id_pengurus='$has[0]'");
                          while ($data = mysqli_fetch_row($detail))
                          {
                          ?>
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                              </span>
                              <div class="form-line">
                                <input type="text" class="form-control" value="<?php echo $data[3];?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">attach_money</i>
                              </span>
                              <div class="form-line">
                                <input type="text" class="form-control" value="Rp <?php echo $data[4];?>" readonly>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <!--END MODAL DETAIL KAS-->

            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!--END TABEL KAS-->

    </div>
  </div>
</div>
<?php } ?>
