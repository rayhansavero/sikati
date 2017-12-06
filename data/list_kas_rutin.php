<?php
$con = mysqli_connect('localhost','root','','sikati');
date_default_timezone_set('Asia/Jakarta');

function idkas() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_kas from bayar_kas order by id_kas desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'K00001';

		} else {
		$jum = substr($no_temp,1,6);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'K0000' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'K000' . $jum;
		}
    elseif ($jum <= 999) {
			$no_urut = 'K00' . $jum;
		}
    elseif ($jum <= 9999) {
			$no_urut = 'K0' . $jum;
		}
    elseif ($jum <= 99999) {
			$no_urut = 'K' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}

//SIMPAN FUNGSI nomor() KE VARIABEL $nomor
$idkas = idkas();

if (isset($_POST['simpankas'])) {
  $idkas = $_POST['idkas'];
  $idpengurus = $_POST['idpengurus'];
  $idtahun = $_POST['idtahun'];
  $tgl = $_POST['tgl'];
  $bayar = $_POST['bayar'];
  $query = mysqli_query($con,"insert into bayar_kas values ('$idkas','$idpengurus','$idtahun','$tgl','$bayar')") or die(mysql_error());
  echo "
  <script> alert ('Data Kegiatan Berhasil di Tambahkan');
  document.location='index.php?page=kas_rutin';
  </script>
  ";
}
?>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Menu Halaman Kas Rutin</h2>
      </div>
      <form action="" method="POST" role="form">
      <div class="body">
        <div class="row clearfix">
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <select class="form-control show-tick" name="tahun">
                <option value="">Pilih Periode</option>
                <?php
                $tahun = mysqli_query($con, "select * from tahun");
                while ($row = mysqli_fetch_array($tahun)) { ?>
                <option value="<?php echo $row['id_tahun']; ?>"><?php echo $row['pilih_tahun']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary waves-effect" name="tampil">
            <span>Tampilkan</span>
          </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

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

          <!--TOMBOL TAMBAH DATA KR-->
          <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#tambahKas">
            <i class="material-icons">add</i>
            <span>Tambah Data</span>
          </button>
          <br><br>

          <!--MODAL TAMBAH KR-->
          <div class="modal fade" id="tambahKas" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Form Tambah Data Kas Rutin</h4>
                </div>

                <form action="" method="POST" role="form">
                <div class="modal-body">
                  <!--ID KAS-->
                  <input type="hidden" name="idkas" value="<?php echo $idkas; ?>" readonly>
                  <!--ID PENGURUS-->
                  <div class="col-md-12">
                    <b>Nama Pengurus</b>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">person</i>
                      </span>
                      <div id="result_pengurus">
                        <select class="form-control show-tick" name="idpengurus">
                          <option value="">Pilih Pengurus</option>
                          <?php
                          $query = mysqli_query($con, "SELECT nama_pengurus FROM pengurus WHERE id_tahun='$tahun'");
                          while ($row = mysqli_fetch_array($query)) {
                          ?>
                          <option value="<?php echo $row['id_pengurus']; ?>"><?php echo $row['nama_pengurus']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!--ID TAHUN-->
                  <input type="hidden" name="idtahun" value="<?php echo $tahun; ?>" readonly>
                  <!--TANGGAL BAYAR-->
                  <div class="col-md-12">
                    <b>Tanggal Bayar</b>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                      </span>
                      <div class="form-line">
                        <input type="date" class="form-control" name="tgl">
                      </div>
                    </div>
                  </div>
                  <!--JUMLAH BAYAR-->
                  <div class="col-md-12">
                    <b>Jumlah Bayar</b>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">attach_money</i>
                      </span>
                      <div class="form-line">
                        <input type="number" min="0" class="form-control" placeholder="Jumlah Bayar" name="bayar">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                  <button type="submit" class="btn btn-link waves-effect" name="simpankas">SIMPAN</button>
                </div>
                </form>

              </div>
            </div>
          </div>
          <!--END MODAL TAMBAH DATA PENGURUS-->

          <!--TABEL DATA KR-->
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
              <tr>
                <th class="text-center">Nama</th>
                <!--th class="text-center">Total Pembayaran</th-->
                <th class="text-center">Detail Pembayaran</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $qu = mysqli_query($con,"SELECT * FROM pengurus WHERE id_tahun='$tahun'");
              while ($has = mysqli_fetch_row($qu))
              {
              ?>
              <tr>
                <td><?php echo $has[1]; ?>
                </td>
                <td td style="text-align:center">
                <!--TOMBOL DETAIL DATA-->
                <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#detailKR<?php echo $has[1]; ?>">
                  <i class="material-icons">description</i>
                </button>

                <!--MODAL DETAIL DATA-->
                  <div class="modal fade" id="detailKR<?php echo $has[1]; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog " role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Detail Pembayaran <?php echo $has[1]; ?></h4>
                        </div>
                        <div class="modal-body">
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                              </span>
                              <div class="form-line">
                                <input type="text" class="form-control" value="" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">attach_money</i>
                              </span>
                              <div class="form-line">
                                <input type="text" class="form-control" value="Rp" readonly>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <!--END MODAL EDIT DATA PENGURUS-->
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php } ?>
