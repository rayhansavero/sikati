<?php
$con = mysqli_connect('localhost','root','','sikati');

function idt() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"SELECT id_tahun FROM tahun ORDER BY id_tahun DESC LIMIT 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'TH01';

		} else {
		$jum = substr($no_temp,2,4);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'TH0' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'TH' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}

$idt = idt();

//PROSES EDIT dan HAPUS DATA PENGURUS
if (isset($_POST['simpanper'])) {
  $tahun = $_POST['tahun'];
  $query = mysqli_query($con,"INSERT INTO tahun VALUES ('$idt','$tahun')") or die(mysql_error());
  echo "
  <script> alert ('Data Berhasil di Simpan');
  document.location='index.php?page=pengurus';
  </script>
  ";
}elseif (isset($_POST['update'])) {
  $id = $_POST['id_pengurus'];
  $nama = $_POST['nama_pengurus'];
  $query = mysqli_query($con,"UPDATE pengurus SET nama_pengurus='$nama' WHERE id_pengurus='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Berhasil di Update');
  document.location='index.php?page=pengurus';
  </script>
  ";
}
elseif (isset($_POST['hapus'])) {
  $id = $_POST['hapus'];
  $query = mysqli_query($con,"DELETE FROM pengurus WHERE id_pengurus='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Berhasil di Hapus');
  document.location='index.php?page=pengurus';
  </script>
  ";
}
?>
<!--END PROSES TAMBAH/EDIT DATA PENGURUS-->

<!--PILIH PERIODE KEPENGURUSAN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Menu Halaman Pengurus</h2>
      </div>
      <form action="" method="POST" role="form">
        <div class="body">
          <div class="row clearfix">
            <div class="col-md-3">
              <div class="input-group">
                <select class="form-control show-tick" name="tahun">
                  <option value="">Pilih Tahun</option>
                  <?php
                  $tahun = mysqli_query($con, "SELECT * FROM tahun");
                  while ($row = mysqli_fetch_array($tahun)) { ?>
                  <option value="<?php echo $row['id_tahun']; ?>"><?php echo $row['pilih_tahun']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary waves-effect" name="tampil">
              <span>Tampilkan</span>
            </button>
            <button type="button" class="btn bg-cyan waves-effect" data-toggle="modal" data-target="#tambahPeriode">
              <span>Tambah Periode</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--END PILIH PERIODE KEPENGURUSAN-->

<!--MODAL TAMBAH KEGIATAN-->
<div class="modal fade" id="tambahPeriode" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Tambah Periode</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form">
        <div class="col-md-12">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">event</i>
            </span>
            <div class="form-line">
              <input type="hidden" name="idper" value="<?php echo $idt; ?>" readonly>
              <input type="text" class="form-control" placeholder="Periode" name="tahun" required>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
        <button type="submit" class="btn btn-link waves-effect" name="simpanper">SIMPAN</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!--END MODAL TAMBAH KEGIATAN-->

<?php
if (isset($_POST['tampil'])) {
  $tahun = $_POST['tahun'];
?>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          Tabel Pengurus HMJ TI Periode
          <?php
          $periode = mysqli_query($con,"SELECT pilih_tahun FROM tahun WHERE id_tahun='$tahun'");
          $per = mysqli_fetch_array($periode);
          echo $per['pilih_tahun'];
          ?>
        </h2>
      </div>
      <div class="body">

        <div class="row clearfix">
        <form class="" action="index.php?page=tambah_pengurus" method="post">
          <div class="col-md-2">
            <div class="input-group">
              <div class="form-line">
                <input type="number" min="1" class="form-control" placeholder="Jumlah Data" name="jmlTambah" required>
                <input type="hidden" name="tahun" value="<?php echo $tahun; ?>" readonly>
              </div>
            </div>
          </div>
          <button type="submit" name="tambahPengurus" class="btn btn-primary waves-effect">
            <span>Tambah Pengurus</span>
          </button>
        </form>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($con,"SELECT * FROM pengurus WHERE id_tahun='$tahun'");
              while ($has = mysqli_fetch_row($query)) {
              ?>
              <tr>
                <td width='5%'><?php echo $no++; ?></td>
                <td><?php echo $has[1]; ?></td>
                <td td style="text-align:center">
                <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#editPengurus<?php echo $has[0]; ?>">
                  <i class="material-icons">edit</i>
                </button>
                <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#hapusPengurus<?php echo $has[0]; ?>">
                  <i class="material-icons">delete</i>
                </button>

                <!--MODAL EDIT DATA PENGURUS-->
                <div class="modal fade" id="editPengurus<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Edit Data Pengurus</h4>
                      </div>
                      <form action="" method="POST" role="form">
                        <div class="modal-body">
                                <input type="hidden" class="form-control" name="id_pengurus" value="<?php echo $has[0]; ?>">
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
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--END MODAL EDIT DATA PENGURUS-->

                <!--MODAL HAPUS DATA PENGURUS-->
                <div class="modal fade" id="hapusPengurus<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <form action="" method="POST" role="form">
                        <div class="modal-body">
                          Apakah Anda Ingin Menghapus Data <?php echo $has[1]; ?>?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                          <button type="submit" class="btn btn-link waves-effect" name="hapus" value="<?php  echo $has[0]; ?>">HAPUS</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--END MODAL HAPUS DATA PENGURUS-->

                </td>
              </tr>
            <?php
            }
            ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
<?php } ?>
