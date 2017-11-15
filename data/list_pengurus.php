<?php
$con = mysqli_connect('localhost','root','','sikati');

//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA)
function nomor() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_pengurus from list_pengurus order by id_pengurus desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'P01';

		} else {
		$jum = substr($no_temp,1,3);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'P0' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'P' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}

//SIMPAN FUNGSI nomor() KE VARIABEL $nomor
$nomor = nomor();

//PROSES TAMBAH/EDIT DATA PENGURUS
if (isset($_POST['simpan'])) {
  $nama = $_POST['nama_pengurus'];
  $periode = $_POST['periode'];
  $query = mysqli_query($con,"insert into list_pengurus values ('$nomor','$nama','$periode')") or die(mysql_error());
  echo "
  <script> alert ('Data Berhasil di Tambahkan');
  document.location='index.php?page=pengurus';
  </script>
  ";
}
elseif (isset($_POST['update'])) {
  $id = $_POST['update'];
  $nama = $_POST['nama_pengurus'];
  $query = mysqli_query($con,"update list_pengurus set id_pengurus='$id',nama_pengurus='$nama' where id_pengurus='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Behasil di Update');
  document.location='index.php?page=pengurus';
  </script>
  ";
}
elseif (isset($_POST['hapus'])) {
  $id = $_POST['hapus'];
  $query = mysqli_query($con,"delete from list_pengurus where id_pengurus='$id' ") or die(mysql_error());
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
                <h2>Pilih Tahun Kepengurusan</h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-sm-3">
                  <select class="form-control show-tick">
                    <option value="">-- Please select --</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-primary waves-effect m-r-20">Tampil</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--END PILIH PERIODE KEPENGURUSAN-->

      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                Daftar Pengurus HMJ TI Periode
              </h2>
            </div>

            <!--TOMBOL TAMBAH DATA PENGURUS-->
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#tambahPengurus">
                    <i class="material-icons">add</i>
                    <span>Tambah Data</span>
                  </button>
                </div>
                <!--TOMBOL TAMBAH DATA PENGURUS-->
                <!--MODAL TAMBAH DATA PENGURUS-->
                <div class="modal fade" id="tambahPengurus" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Data Pengurus</h4>
                      </div>
                      <div class="modal-body">
                        <form action="" method="POST" role="form">
                        <div class="col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">fingerprint</i>
                            </span>
                            <div class="form-line">
                              <input type="text" class="form-control" name="id_pengurus" value="<?php echo $nomor; ?>" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                              <input type="text" class="form-control" placeholder="Nama Pengurus" name="nama_pengurus">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">date_range</i>
                            </span>
                            <select class="form-control show-tick" name="periode">
                              <option value="">Periode Kepengurusan</option>
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn btn-link waves-effect" name="simpan">SIMPAN</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!--END MODAL TAMBAH DATA PENGURUS-->

                <!--TABEL DATA PENGURUS-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Periode</th>
                        <th class="text-center">Opsi</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $qu = mysqli_query($con,"select * from list_pengurus");
                      while ($has = mysqli_fetch_row($qu))
                      {
                        ?>
                        <tr>
                          <td><?php echo $has[0]; ?></td>
                          <td><?php echo $has[1]; ?></td>
                          <td><?php echo $has[2]; ?></td>
                          <td td style="text-align:center">
                            <!--TOMBOL EDIT DATA-->
                            <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#editPengurus<?php echo $has[0]; ?>">
                              <i class="material-icons">edit</i>
                            </button>
                            <!--MODAL EDIT DATA PENGURUS-->
                            <div class="modal fade" id="editPengurus<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Form Edit Data Pengurus</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form action="" method="POST" role="form">

                                          <input type="hidden" class="form-control" name="id_pengurus" value="<?php echo $has[0]; ?>" disabled>

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
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--END MODAL EDIT DATA PENGURUS-->

                            <!--TOMBOL HAPUS DATA-->
                            <button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#hapusPengurus<?php echo $has[0]; ?>">
                              <i class="material-icons">delete</i>
                            </button>
                            <!--MODAL HAPUS DATA PENGURUS-->
                            <div class="modal fade" id="hapusPengurus<?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <form action="" method="POST" role="form">
                                      Apakah Anda Ingin Menghapus Data <?php echo $has[1]; ?>?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                                    <button type="submit" class="btn btn-link waves-effect" name="hapus" value="<?php  echo $has[0]; ?>">HAPUS</button>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--END MODAL HAPUS DATA PENGURUS-->
                          </td>
                        </tr>
                        <?php
                        ;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--END TABEL DATA PENGURUS-->

            </div>
          </div>
        </div>
      </div>
