<?php
$con = mysqli_connect('localhost','root','','sikati');

//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) PADA KEGIATAN
function keg() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_kegiatan from kegiatan order by id_kegiatan desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'PS01';

		} else {
		$jum = substr($no_temp,2,4);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'PS0' . $jum;
		}
         elseif ($jum <= 99) {
			$no_urut = 'PS' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}
//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) PADA PROSES KEGIATAN
function pros() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_proses from proses_kegiatan order by id_proses desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'PK0001';

		} else {
		$jum = substr($no_temp,2,6);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'PK000' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'PK00' . $jum;
		}
    elseif ($jum <= 999) {
			$no_urut = 'PK0' . $jum;
		}
    elseif ($jum <= 9999) {
			$no_urut = 'PK' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}

$keg = keg();
$pros = pros();

//PROSES TAMBAH/EDIT DATA PENGURUS
if (isset($_POST['simpankg'])) {
  $nama = $_POST['nama'];
  $tgl = $_POST['tgl'];
  $query = mysqli_query($con,"insert into kegiatan values ('$keg','$nama','$tanggal')") or die(mysql_error());
  echo "
  <script> alert ('Kegiatan Baru Berhasil di Tambahkan');
  document.location='index.php?page=pasca_kegiatan';
  </script>
  ";
}
elseif (isset($_POST['simpanps'])) {
  $kegiatan = $_POST['kegiatan'];
  $uraian = $_POST['uraian'];
  $debit = $_POST['debit'];
  $kredit = $_POST['kredit'];
  $saldo = $_POST['saldo'];
  $tgl = $_POST['tgl'];
  $ket = $_POST['ket'];
  $query = mysqli_query($con,"insert into proses_kegiatan values ('$pros','$kegiatan','$uraian','$debit','$kredit','$saldo','$tgl','$ket')") or die(mysql_error());
  echo "
  <script> alert ('Data Kegiatan Baru Berhasil di Tambahkan');
  document.location='index.php?page=pasca_kegiatan';
  </script>
  ";
}
elseif (isset($_POST['update'])) {
  $pros = $_POST['pros'];
  $uraian = $_POST['uraian'];
  $debit = $_POST['debit'];
  $kredit = $_POST['kredit'];
  $saldo = $_POST['saldo'];
  $tgl = $_POST['tgl'];
  $ket = $_POST['ket'];
  $query = mysqli_query($con,"update proses_kegiatan set uraian_proses='$uraian',debit_proses='$debit',kredit_proses='$kredit',saldo_proses='$saldo',tgl_proses='$tgl',ket_proses='$ket' where id_proses='$pros' ") or die(mysql_error());
  echo "
  <script> alert ('Data Kegiatan Berhasil di Update');
  document.location='index.php?page=pasca_kegiatan';
  </script>
  ";
}
elseif (isset($_POST['hapus'])) {
  $id = $_POST['hapus'];
  $query = mysqli_query($con,"delete from proses_kegiatan where id_proses='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Kegiatan Berhasil di Hapus');
  document.location='index.php?page=pasca_kegiatan';
  </script>
  ";
}
?>

<!--PILIH PERIODE KEPENGURUSAN-->
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
            <button type="button" class="btn bg-cyan waves-effect" data-toggle="modal" data-target="#tambahKegiatan">
              <span>Tambah Kegiatan</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END PILIH PERIODE KEPENGURUSAN-->

<!--MODAL TAMBAH KEGIATAN-->
<div class="modal fade" id="tambahKegiatan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Tambah Kegiatan</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form">
              <input type="hidden" name="id_kegiatan" value="<?php echo $keg; ?>" readonly>
        <div class="col-md-12">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">event</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama">
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="date" class="form-control date" placeholder="Tanggal" name="tgl">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
        <button type="submit" class="btn btn-link waves-effect" name="simpankg">SIMPAN</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!--END MODAL TAMBAH KEGIATAN-->


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
        <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#tambahdata">
          <i class="material-icons">add</i>
          <span>Tambah Data</span>
        </button>
        <br>
        <br>

        <!--MODAL tambah DATA proses kegiatan-->
        <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data Kegiatan
                  <?php
                  $nama = mysqli_query($con,"select nama_kegiatan from kegiatan where id_kegiatan='$kegiatan'");
                  $tampil = mysqli_fetch_array($nama);
                  echo $tampil['nama_kegiatan'];
                  ?>
                </h4>
              </div>
              <form action="" method="POST" role="form">
              <div class="modal-body">
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">assignment</i>
                    </span>
                    <div class="form-line">
                      <input type="hidden" value="<?php echo $pros; ?>" name="idpros" readonly>
                      <input type="hidden" value="<?php echo $kegiatan; ?>" name="kegiatan" readonly>
                      <input type="input" class="form-control" placeholder="Uraian" name="uraian">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                    </span>
                    <div class="form-line">
                      <input type="number" min="0"  class="form-control" placeholder="Debit" name="debit">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                    </span>
                    <div class="form-line">
                      <input type="number" min="0"  class="form-control" placeholder="Kredit" name="kredit">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                    </span>
                    <div class="form-line">
                      <input type="number" min="0" class="form-control" placeholder="Saldo" name="saldo">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                      <input type="date" class="form-control" placeholder="Tanggal" name="tgl">
                      <!--input type="input" class="form-control" value="<?php $tgl=date('d-m-Y'); echo $tgl; ?>" name="tgl" readonly-->
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">assignment</i>
                    </span>
                    <div class="form-line">
                      <input type="text" class="form-control" placeholder="Keterangan" name="ket">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn btn-link waves-effect" name="simpanps">SIMPAN</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!--END MODAL tambah data proses kegiatan-->

        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
          <thead>
            <tr>
              <th class="hidden">ID</th>
              <th class="text-center">Uraian</th>
              <th class="text-center">Debit</th>
              <th class="text-center">Kredit</th>
              <th class="text-center">Saldo</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $qu = mysqli_query($con,"select * from proses_kegiatan where id_kegiatan='$kegiatan'");
            while ($has = mysqli_fetch_row($qu))
            {
            ?>
              <tr>
                <td class="hidden"><?php echo $has[0]; ?></td>
                <td><?php echo $has[2]; ?></td>
                <td><?php echo $has[3]; ?></td>
                <td><?php echo $has[4]; ?></td>
                <td><?php echo $has[5]; ?></td>
                <td><?php echo $has[6]; ?></td>
                <td><?php echo $has[7]; ?></td>
                <td td style="text-align:center">
                  <!--TOMBOL EDIT DATA-->
                  <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#editpascaKeg<?php echo $has[0]; ?>">
                    <i class="material-icons">edit</i>
                  </button>
                  <!--TOMBOL HAPUS DATA-->
                  <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#hapuspascaKeg<?php echo $has[0]; ?>">
                    <i class="material-icons">delete</i>
                  </button>

                  <!--MODAL EDIT DATA kegiatan-->
                  <div class="modal fade" id="editpascaKeg<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Form Edit Data Kegiatan</h4>
                        </div>
                        <form action="" method="POST" role="form">
                          <div class="modal-body">
                            <div class="col-md-12">
                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="material-icons">assignment</i>
                                </span>
                                <div class="form-line">
                                  <input type="hidden" name="pros" value="<?php echo $has[0]; ?>" readonly>
                                  <input type="text" class="form-control" placeholder="uraian" name="uraian" value="<?php echo $has[2]; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="material-icons">attach_money</i>
                                </span>
                                <div class="form-line">
                                  <input type="number" min="0" class="form-control" placeholder="debit" name="debit" value="<?php echo $has[3]; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="material-icons">attach_money</i>
                                </span>
                                <div class="form-line">
                                  <input type="number" min="0" class="form-control" placeholder="kredit" name="kredit" value="<?php echo $has[4]; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="material-icons">attach_money</i>
                                </span>
                                <div class="form-line">
                                  <input type="number" min="0" class="form-control" placeholder="saldo" name="saldo" value="<?php echo $has[5]; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="material-icons">date_range</i>
                                </span>
                                <div class="form-line">
                                  <input type="date" class="form-control" name="tgl" value="<?php echo $has[6]; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="material-icons">assignment</i>
                                </span>
                                <div class="form-line">
                                  <input type="input" class="form-control" name="ket" placeholder="Keterangan" value="<?php echo $has[7]; ?>">
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
                  <!--END MODAL EDIT DATA kegiatan-->

                     <!--MODAL HAPUS DATA PENGURUS-->
                  <div class="modal fade" id="hapuspascaKeg<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <form action="" method="POST" role="form">
                          <div class="modal-body">
                            Apakah Anda Ingin Menghapus Data <?php echo $has[2]; ?>?
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
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
