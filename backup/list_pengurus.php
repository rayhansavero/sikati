<?php
$con = mysqli_connect('localhost','root','','sikati');

//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA)
function nomor() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_pengurus from pengurus order by id_pengurus desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'e001';

		} else {
		$jum = substr($no_temp,1,4);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'e00' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'e0' . $jum;
		}
    elseif ($jum <= 999) {
			$no_urut = 'e' . $jum;
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
  $query = mysqli_query($con,"insert into pengurus values ('$nomor','$nama','$periode')") or die(mysql_error());
  echo "
  <script> alert ('Data Berhasil di Tambahkan');
  document.location='index.php?page=pengurus';
  </script>
  ";
}
elseif (isset($_POST['update'])) {
  //$id = $_POST['update'];
  $id = $_POST['id_pengurus'];
  $nama = $_POST['nama_pengurus'];
  $query = mysqli_query($con,"update pengurus set nama_pengurus='$nama' where id_pengurus='$id' ") or die(mysql_error());
  echo "
  <script> alert ('Data Behasil di Update');
  document.location='index.php?page=pengurus';
  </script>
  ";
}
elseif (isset($_POST['hapus'])) {
  $id = $_POST['hapus'];
  $query = mysqli_query($con,"delete from pengurus where id_pengurus='$id' ") or die(mysql_error());
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
        <h2>List Pengurus HMJ TI</h2>
      </div>
      <div class="body">
        <form action="" method="POST" role="form">
          <div class="row clearfix">
            <div class="col-md-3">
              <!--b>Pilih Tahun Kepengurusan</b-->
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">date_range</i>
                </span>
                <select class="form-control show-tick" name="tahun">
                  <option value="">-- Pilih tahun --</option>
                  <?php
                  $tahun = mysqli_query($con, "select * from tahun");
                  while ($row = mysqli_fetch_array($tahun)) { ?>
                  <option value="<?php echo $row['id_tahun']; ?>"><?php echo $row['pilih_tahun']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-primary waves-effect m-r-20">
                <span>Tampilkan</span>
              </button>
            </div>
          </div>
        </form>
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
          Tabel Pengurus HMJ TI Periode
        </h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-sm-12">
            <!--TOMBOL TAMBAH DATA PENGURUS-->
            <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#tambahPengurus">
              <i class="material-icons">add</i>
              <span>Tambah Data</span>
            </button>

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
                          <option value="">-- Pilih tahun --</option>
                          <?php
                              $query = mysqli_query($con, "select * from tahun");
                              while ($row = mysqli_fetch_array($query)) { ?>
                          <option value="<?php echo $row['id_tahun']; ?>"><?php echo $row['pilih_tahun']; ?></option>
                          <?php } ?>
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
          </div>
        </div>

        <!--TABEL DATA PENGURUS-->
        <div class="row clearfix">
          <div class="col-sm-12">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
              <thead>
                <tr>
                  <th class="text-center">Id</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $qu = mysqli_query($con,"select * from pengurus");
                while ($has = mysqli_fetch_row($qu)) { ?>
                <!--?php
                if(isset($_POST['id_tahun'])){
                $tampil = mysqli_query($con, "select * pengurus where id_tahun=".$_POST['id_tahun']."");
                while ($row = mysqli_fetch_array($tampil)) { ?-->
                <tr>
                  <td><?php echo $has[0]; ?></td>
                  <td><?php echo $has[1]; ?></td>
                  <td td style="text-align:center">

                  <!--TOMBOL EDIT DATA-->
                  <a href="#" class="editPengurus btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#editPengurus <?php echo $has[0]; ?>" >
                    <i class="material-icons">edit</i>
                  </a>
                  <!--MODAL EDIT DATA PENGURUS-->
                  <div class="modal fade" id="editPengurus <?php echo $has[0]; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Form Edit Data Pengurus</h4>
                        </div>
                        <div class="modal-body">
                          <form action="" method="POST" role="form">
                                  <input type="text" class="form-control" name="id_pengurus" value="" disabled>
                            <div class="col-md-12">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">person</i>
                              </span>
                              <div class="form-line">
                                <input type="text" class="form-control" placeholder="Nama Pengurus" name="nama_pengurus" valu>
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
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!--END TABEL DATA PENGURUS-->
    </div>
  </div>
</div>
</div>
</div>
