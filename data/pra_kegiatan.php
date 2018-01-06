<?php
$con = mysqli_connect('localhost','root','','sikati');

//===================FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) PADA KEGIATAN===================
function keg() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_kegiatan from kegiatan order by id_kegiatan desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'PR01';

		} else {
		$jum = substr($no_temp,2,4);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'PR0' . $jum;
		}
         elseif ($jum <= 99) {
			$no_urut = 'PR' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}
//===================FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) PADA PROSES KEGIATAN===================
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

//===================PROSES TAMBAH JUDUL KEGIATAN BARU===================
if (isset($_POST['simpankg'])) {
  $nama = $_POST['nama'];
  $tgl = $_POST['tgl'];
  $query = mysqli_query($con,"insert into kegiatan values ('$keg','$nama','$tgl')") or die(mysql_error());
  echo "
  <script> alert ('Kegiatan Baru Berhasil di Tambahkan');
  document.location='index.php?page=pra_kegiatan';
  </script>
  ";
}
//===================PROSES TAMBAH DATA DEBIT BARU===================
elseif (isset($_POST['simpandebit'])) {
  $kegiatan = $_POST['kegiatan'];
  $tgl = $_POST['tgl'];
  $uraian = $_POST['uraian'];
  $debit = $_POST['debit'];
  $kredit = 0;
  $saldo = $_POST['saldo'];
  $saldobaru = $saldo + $debit;
  $ket = $_POST['ket'];
  $query = mysqli_query($con,"insert into proses_kegiatan values ('$pros','$kegiatan','$tgl','$uraian','$debit','$kredit','$saldobaru','$ket')") or die(mysql_error());
  echo "
  <script> alert ('Data Kegiatan Baru Berhasil di Tambahkan');
  document.location='index.php?page=pra_kegiatan';
  </script>
  ";
}
//===================PROSES TAMBAH DATA KREDIT BARU===================
elseif (isset($_POST['simpankredit'])) {
  $kegiatan = $_POST['kegiatan'];
  $tgl = $_POST['tgl'];
  $uraian = $_POST['uraian'];
  $debit = 0;
  $kredit = $_POST['kredit'];
  $saldo = $_POST['saldo'];
  $saldobaru = $saldo - $kredit;
  $ket = $_POST['ket'];
  $query = mysqli_query($con,"insert into proses_kegiatan values ('$pros','$kegiatan','$tgl','$uraian','$debit','$kredit','$saldobaru','$ket')") or die(mysql_error());
  echo "
  <script> alert ('Data Kegiatan Baru Berhasil di Tambahkan');
  document.location='index.php?page=pra_kegiatan';
  </script>
  ";
}
//===================PROSES EDIT DATA KEGIATAN===================
elseif (isset($_POST['update'])) {
  $pros = $_POST['pros'];
  $tgl = $_POST['tgl'];
  $uraian = $_POST['uraian'];
  $ket = $_POST['ket'];
  $query = mysqli_query($con,"update proses_kegiatan set tgl_proses='$tgl',uraian_proses='$uraian',ket_proses='$ket' where id_proses='$pros' ") or die(mysql_error());
  echo "
  <script> alert ('Data Kegiatan Berhasil di Update');
  document.location='index.php?page=pra_kegiatan';
  </script>
  ";
}
//===================PROSES HAPUS DATA KEGIATAN===================
elseif (isset($_POST['hapus'])) {
  $id = $_POST['hapus'];
  $query = mysqli_query($con,"delete from proses_kegiatan where id_proses='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Kegiatan Berhasil di Hapus');
  document.location='index.php?page=pra_kegiatan';
  </script>
  ";
}
?>

<!--==================================PILIH JUDUL KEGIATAN==================================-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>List Keuangan Pra Kegiatan </h2>
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
                $tahun = mysqli_query($con, "select * from kegiatan where id_kegiatan like 'PR%'");
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
if (isset($_POST['tampil'])) {
$kegiatan = $_POST['kegiatan'];
?>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h2>Tabel Pra Kegiatan
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
                <h4 class="modal-title">Tambah Data Debit Kegiatan
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
                      $saldoakhir = mysqli_query($con,"SELECT saldo_proses FROM proses_kegiatan WHERE id_kegiatan='$kegiatan' ORDER BY id_proses DESC LIMIT 0,1");
                      $tampil = mysqli_fetch_array($saldoakhir);
                      ?>
                      <input type="hidden" class="form-control" name="saldo" value="<?php echo $tampil['saldo_proses']; ?>">
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
                <h4 class="modal-title">Tambah Data Kredit Kegiatan
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
                      $saldoakhir = mysqli_query($con,"SELECT saldo_proses FROM proses_kegiatan WHERE id_kegiatan='$kegiatan' ORDER BY id_proses DESC LIMIT 0,1");
                      $tampil = mysqli_fetch_array($saldoakhir);
                      ?>
                      <input type="hidden" class="form-control" name="saldo" value="<?php echo $tampil['saldo_proses']; ?>">
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
                <td td style="text-align:center">
                  <!--TOMBOL EDIT DATA-->
                  <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#editPraKeg<?php echo $has[0]; ?>">
                    <i class="material-icons">edit</i>
                  </button>
                  <!--TOMBOL HAPUS DATA-->
                  <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#hapusPraKeg<?php echo $has[0]; ?>">
                    <i class="material-icons">delete</i>
                  </button>
                </td>
                <!--==================================MODAL EDIT DATA kegiatan==================================-->
                <div class="modal fade" id="editPraKeg<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
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
                                <input type="hidden" name="pros" value="<?php echo $has[0]; ?>" readonly>
                                <input type="text" class="form-control" placeholder="uraian" name="uraian" value="<?php echo $has[3]; ?>" required>
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
                                <input type="inpu" class="form-control" name="debit" value="<?php echo $has[4]; ?>" readonly>
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
                                <input type="inpu" class="form-control" name="kredit" value="<?php echo $has[5]; ?>" readonly>
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
                                <input type="inpu" class="form-control" name="saldo" value="<?php echo $has[6]; ?>"readonly>
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
                                <input type="date" class="form-control" name="tgl" value="<?php echo $has[2]; ?>" required>
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
                <!--==================================END MODAL EDIT DATA kegiatan==================================-->

                <!--==================================MODAL HAPUS DATA PENGURUS==================================-->
                <div class="modal fade" id="hapusPraKeg<?php echo $has[0]; ?>" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                <div class="modal fade" id="hapusPraKeg<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <form action="" method="POST" role="form">
                        <div class="modal-body">
                          Apakah Anda Ingin Menghapus Data <?php echo $has[3]; ?>?
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
