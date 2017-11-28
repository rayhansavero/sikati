<?php
$con = mysqli_connect('localhost','root','','sikati');

//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA)
function nomor() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_kegiatan from kegiatan order by id_kegiatan desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'k01';

		} else {
		$jum = substr($no_temp,1,2);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'e0' . $jum;
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
  $nama = $_POST['nama_kegiatan'];
  $tanggal = $_POST['tgl_kegiatan'];
  $query = mysqli_query($con,"insert into kegiatan values ('$nomor','$nama','$tanggal')") or die(mysql_error());
  echo "
  <script> alert ('Data Berhasil di Tambahkan');
  document.location='index.php?page=pengurus';
  </script>
  ";
}
?>

<!--FORM DAFTAR KEGIATAN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h2>Keuangan Pra Kegiatan</h2>
      </div>
      <div class="body">
        <div class="row clearfix">
          <div class="col-md-6">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">event</i>
                  </span>
                  <select class="form-control show-tick">
                    <option value="">-- Pilih Kegiatan --</option>
                    <?php
                    $query = mysqli_query($con, "select * from kegiatan order by id_kegiatan");
                    while ($row = mysqli_fetch_array($query)) { ?>
                    <option value="<?php echo $row['id_kegiatan']; ?>"><?php echo $row['nama_kegiatan']; ?></option>
                    <?php } ?>
                  </select>
              </div>
          </div>
          <div class="col-md-3">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">date_range</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" placeholder="tanggal kegiatan" disabled>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#tambahKegiatan">
              <i class="material-icons">add</i>
              <span>Tambah Kegiatan</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--MODAL TAMBAH KEGIATAN-->
<div class="modal fade" id="tambahKegiatan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Tambah Kegiatan</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form">
        <div class="col-md-12">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">fingerprint</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control" name="id_kegiatan" value="<?php echo $nomor; ?>" disabled>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">event</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama_kegiatan">
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">date_range</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control date" placeholder="Tanggal" name="tgl_kegiatan">
            </div>
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
<!--END MODAL TAMBAH KEGIATAN-->

<!--TABEL KEGIATAN-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h2>Tabel Kegiatan</h2>
      </div>
      <div class="body">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
          <thead>
            <tr>
              <th class="text-center">Id</th>
              <th class="text-center">Uraian</th>
              <th class="text-center">Debet</th>
              <th class="text-center">Kredit</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">Keterangan</th>
              <th class="text-center">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $qu = mysqli_query($con,"select * from proses_kegiatan");
            while ($has = mysqli_fetch_row($qu))
            {
              ?>
              <tr>
                <td><?php echo $has[0]; ?></td>
                <td><?php echo $has[2]; ?></td>
                <td><?php echo $has[3]; ?></td>
                <td><?php echo $has[4]; ?></td>
                <td><?php echo $has[5]; ?></td>
                <td><?php echo $has[6]; ?></td>
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
              </tr>
              <?php
              ;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
