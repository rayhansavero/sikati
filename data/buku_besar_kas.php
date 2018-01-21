<?php
$con = mysqli_connect('localhost','root','','sikati');

//===================FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) PADA BUKU BESAR KAS===================
function bbs() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"SELECT id_bbs FROM buku_besar_kas ORDER BY id_bbs DESC LIMIT 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'BB0001';

		} else {
		$jum = substr($no_temp,2,6);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'BB000' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'BB00' . $jum;
		}
    elseif ($jum <= 999) {
			$no_urut = 'BB0' . $jum;
		}
    elseif ($jum <= 9999) {
			$no_urut = 'BB' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}

$bbs = bbs();

//===================PROSES TAMBAH DATA BUKU BESAR KAS===================
if (isset($_POST['simpandebit'])) {
  $tgl = $_POST['tgl'];
  $uraian = $_POST['uraian'];
  $debit = $_POST['debit'];
  $kredit = 0;
  $saldo = $_POST['saldo'];
  $saldobaru = $saldo + $debit;
  $ket = $_POST['ket'];
  $query = mysqli_query($con,"INSERT INTO buku_besar_kas VALUES ('$bbs','$tgl','$uraian','$debit','$kredit','$saldobaru','$ket')") or die(mysql_error());
  echo "
  <script> alert ('Data Buku Besar Kas Baru Berhasil di Tambahkan');
  document.location='index.php?page=buku_besar_kas';
  </script>
  ";
}
//===================PROSES TAMBAH DATA KREDIT BARU===================
elseif (isset($_POST['simpankredit'])) {
  $tgl = $_POST['tgl'];
  $uraian = $_POST['uraian'];
  $debit = 0;
  $kredit = $_POST['kredit'];
  $saldo = $_POST['saldo'];
  $saldobaru = $saldo - $kredit;
  $ket = $_POST['ket'];
  $query = mysqli_query($con,"INSERT INTO buku_besar_kas VALUES ('$bbs','$tgl','$uraian','$debit','$kredit','$saldobaru','$ket')") or die(mysql_error());
  echo "
  <script> alert ('Data Saldo Buku Besar Baru Berhasil di Tambahkan');
  document.location='index.php?page=buku_besar_kas';
  </script>
  ";
}
//===================PROSES EDIT DATA BUKU BESAR KAS===================
elseif (isset($_POST['update'])) {
  $bbs = $_POST['bbs'];
  $tgl = $_POST['tgl'];
  $uraian = $_POST['uraian'];
  $ket = $_POST['ket'];
  $query = mysqli_query($con,"UPDATE buku_besar_kas SET tgl_bbs='$tgl',uraian_bbs='$uraian',ket_bbs='$ket' WHERE id_bbs='$bbs' ") or die(mysql_error());
  echo "
  <script> alert ('Data Buku Besar Kas Berhasil di Update');
  document.location='index.php?page=buku_besar_kas';
  </script>
  ";
}
//===================PROSES HAPUS DATA BUKU BESAR KAS===================
elseif (isset($_POST['hapus'])) {
  $id = $_POST['hapus'];
  $query = mysqli_query($con,"DELETE FROM buku_besar_kas WHERE id_bbs='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Buku Besar Kas Berhasil di Hapus');
  document.location='index.php?page=buku_besar_kas';
  </script>
  ";
}
?>

<!--==================================PILIH JUDUL KEGIATAN==================================-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Menu Halaman Buku Besar Kas</h2>
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
<!--==================================END PILIH JUDUL KEGIATAN==================================-->

<!--==================================MODAL TAMBAH KEGIATAN==================================-->
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
<!--==================================END MODAL TAMBAH KEGIATAN==================================-->


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

        <button type="button" class="btn bg-cyan waves-effect m-r-20" data-toggle="modal" data-target="#tambahdebit">
          <i class="material-icons">add</i>
          <span>Tambah Data Debit</span>
        </button>
        <button type="button" class="btn bg-pink waves-effect m-r-20" data-toggle="modal" data-target="#tambahkredit">
          <i class="material-icons">add</i>
          <span>Tambah Data Kredit</span>
        </button>

        <!--==================================MODAL TAMBAH DEBIT==================================-->
        <div class="modal fade" id="tambahdebit" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data Saldo Kas</h4>
              </div>
              <form action="" method="POST" role="form">
              <div class="modal-body">
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">assignment</i>
                    </span>
                    <div class="form-line">
                      <input type="hidden" value="<?php echo $bbs; ?>" name="idbbs" readonly>
                      <input type="input" class="form-control" placeholder="Uraian" name="uraian" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                    </span>
                    <div class="form-line">
                      <input type="number" min="0" class="form-control" placeholder="Debit" name="debit" required>
                      <?php
                      $saldoakhir = mysqli_query($con,"SELECT saldo_bbs FROM buku_besar_kas WHERE month(tgl_bbs)='$bulan' AND year(tgl_bbs)='$tahun' ORDER BY id_bbs DESC LIMIT 0,1");
                      $tampil = mysqli_fetch_array($saldoakhir);
                      ?>
                      <input type="hidden" class="form-control" name="saldo" value="<?php echo $tampil['saldo_bbs']; ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                      <input type="date" class="form-control" placeholder="Tanggal" name="tgl" required>
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
                <button type="submit" class="btn btn-link waves-effect" name="simpandebit">SIMPAN</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!--==================================END MODAL TAMBAH DEBIT==================================-->

        <!--==================================MODAL TAMBAH KREDIT==================================-->
        <div class="modal fade" id="tambahkredit" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data Kredit Kegiatan</h4>
              </div>
              <form action="" method="POST" role="form">
              <div class="modal-body">
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">assignment</i>
                    </span>
                    <div class="form-line">
                      <input type="hidden" value="<?php echo $bbs; ?>" name="idbbs" readonly>
                      <input type="input" class="form-control" placeholder="Uraian" name="uraian" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">attach_money</i>
                    </span>
                    <div class="form-line">
                      <input type="number" min="0" class="form-control" placeholder="Kredit" name="kredit" required>
                      <?php
                      $saldoakhir = mysqli_query($con,"SELECT saldo_bbs FROM buku_besar_kas WHERE month(tgl_bbs)='$bulan' AND year(tgl_bbs)='$tahun' ORDER BY id_bbs DESC LIMIT 0,1");
                      $tampil = mysqli_fetch_array($saldoakhir);
                      ?>
                      <input type="hidden" class="form-control" name="saldo" value="<?php echo $tampil['saldo_bbs']; ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                      <input type="date" class="form-control" placeholder="Tanggal" name="tgl" required>
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
                <button type="submit" class="btn btn-link waves-effect" name="simpankredit">SIMPAN</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!--==================================END MODAL TAMBAH KREDIT==================================-->
        <br><br>
        <!--==================================TABEL KEGIATAN==================================-->
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
          <thead>
            <tr>
              <th class="text">No</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Uraian</th>
              <th class="text-center">Debit</th>
              <th class="text-center">Kredit</th>
              <th class="text-center">Saldo</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $qu = mysqli_query($con,"SELECT * FROM buku_besar_kas WHERE month(tgl_bbs)='$bulan' AND year(tgl_bbs)='$tahun'");
            while ($has = mysqli_fetch_row($qu))
            {
            ?>
              <tr>
                <td width='5%'><?php echo $no++; ?></td>
                <td><?php echo $has[1]; ?></td>
                <td><?php echo $has[2]; ?></td>
                <td>Rp <?php echo $has[3]; ?></td>
                <td>Rp <?php echo $has[4]; ?></td>
                <td>Rp <?php echo $has[5]; ?></td>
                <td><?php echo $has[6]; ?></td>
                <td td style="text-align:center">
                  <!--TOMBOL EDIT DATA-->
                  <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#editBBS<?php echo $has[0]; ?>">
                    <i class="material-icons">edit</i>
                  </button>
                  <!--TOMBOL HAPUS DATA-->
                  <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#hapusBBS<?php echo $has[0]; ?>">
                    <i class="material-icons">delete</i>
                  </button>
                </td>
                <!--==================================MODAL EDIT DATA BUKU BESAR KAS==================================-->
                <div class="modal fade" id="editBBS<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Edit Data Kegiatan</h4>
                      </div>
                      <form action="" method="POST" role="form">
                        <div class="modal-body">
                          <div class="col-md-12">
                            <b>Uraian</b>
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                              </span>
                              <div class="form-line">
                                <input type="hidden" name="bbs" value="<?php echo $has[0]; ?>" readonly>
                                <input type="text" class="form-control" placeholder="uraian" name="uraian" value="<?php echo $has[2]; ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <b>Debit</b>
                            <div class="input-group">
                               <span class="input-group-addon">
                                <i class="material-icons">attach_money</i>
                              </span>
                              <div class="form-line">
                                <input type="inpu" class="form-control" name="debit" value="<?php echo $has[3]; ?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <b>Kredit</b>
                            <div class="input-group">
                               <span class="input-group-addon">
                                <i class="material-icons">attach_money</i>
                              </span>
                              <div class="form-line">
                                <input type="inpu" class="form-control" name="kredit" value="<?php echo $has[4]; ?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <b>Saldo</b>
                            <div class="input-group">
                               <span class="input-group-addon">
                                <i class="material-icons">attach_money</i>
                              </span>
                              <div class="form-line">
                                <input type="inpu" class="form-control" name="saldo" value="<?php echo $has[5]; ?>"readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <b>Tanggal</b>
                            <div class="input-group">
                               <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                              </span>
                              <div class="form-line">
                                <input type="date" class="form-control" name="tgl" value="<?php echo $has[1]; ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <b>Keterangan</b>
                            <div class="input-group">
                               <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                              </span>
                              <div class="form-line">
                                <input type="input" class="form-control" name="ket" placeholder="Keterangan" value="<?php echo $has[6]; ?>">
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
                <!--==================================END MODAL EDIT DATA kegiatan==================================-->

                <!--==================================MODAL HAPUS DATA PENGURUS==================================-->
                <div class="modal fade" id="hapusBBS<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
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
                <!--==================================END MODAL HAPUS DATA PENGURUS==================================-->
              </tr>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>
