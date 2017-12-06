<?php
$con = mysqli_connect('localhost','root','','sikati');

//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) TAHUN KEPENGURUSAN
function idth() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_tahun from tahun order by id_tahun desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'th01';

		} else {
		$jum = substr($no_temp,2,4);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'th0' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'th' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}

//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) DATA PENGURUS
function idpeng() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_pengurus from pengurus order by id_pengurus desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'E001';

		} else {
		$jum = substr($no_temp,1,4);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'E00' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'E0' . $jum;
		}
    elseif ($jum <= 999) {
			$no_urut = 'E' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}

$idth = idth();
$idpeng = idpeng();

if (isset($_POST['simpanth'])) {
  $periode = $_POST['periode'];
  $query = mysqli_query($con,"insert into tahun values ('$idth','$periode')") or die(mysql_error());
  echo "
  <script> alert ('Tahun Kepengurusan Baru Berhasil di Tambahkan');
  document.location='index.php?page=tambahpengurus';
  </script>
  ";
}
elseif (isset($_POST['simpanpg'])) {
  $tahun = $_POST['tahun'];
  $nama = $_POST['nama'];
  $jml = count($nama);

  for ($i=0; $i < $jml ; $i++) {
  $query = mysqli_query($con,"insert into pengurus values ('$idpeng','$nama[$i]','$tahun')") or die(mysql_error());
  }
  echo "
  <script> alert ('Data Pengurus Baru Berhasil di Tambahkan');
  document.location='index.php?page=tambahpengurus';
  </script>
  ";
}
?>
<!--FORM BUAT TAHUN KEPENGURUSAN BARU-->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Tambah Periode Kepengurusan</h2>
      </div>

      <form action="" method="POST" role="form">
      <div class="body">
        <h2 class="card-inside-title">Masukkan Periode Kepengurusan Baru</h2>
        <div class="row clearfix">
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <div class="form-line">
                <input type="text" name="periode" class="form-control date" placeholder="Periode Baru">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary waves-effect" name="simpanth">
            <span>Simpan</span>
          </button>
        </div>
      </div>
      </form>

    </div>
  </div>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Tambah Data Pengurus</h2>
      </div>

      <form action="" method="POST" role="form">
      <div class="body">
        <h2 class="card-inside-title">Pilih Periode Kepengurusan</h2>
        <div class="row clearfix">
          <div class="col-md-3">
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
        </div>
        <h2 class="card-inside-title">Masukkan Nama Pengurus</h2>
        <div class="row clearfix">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="text" name="nama[]" class="form-control" placeholder="Nama Pengurus" />
              </div>
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="text" name="nama[]" class="form-control" placeholder="Nama Pengurus" />
              </div>
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="text" name="nama[]" class="form-control" placeholder="Nama Pengurus" />
              </div>
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="text" name="nama[]" class="form-control" placeholder="Nama Pengurus" />
              </div>
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="text" name="nama[]" class="form-control" placeholder="Nama Pengurus" />
              </div>
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="text" name="nama[]" class="form-control" placeholder="Nama Pengurus" />
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary waves-effect" name="simpanpg">
          <span>Simpan</span>
        </button>
      </div>
      </form>

    </div>
  </div>
</div>
