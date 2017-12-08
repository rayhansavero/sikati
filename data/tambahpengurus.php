<?php
$con = mysqli_connect('localhost','root','','sikati');

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

$idpeng = idpeng();


if (isset($_POST['simpanpg'])) {
  $total = $_POST['total'];

  for($i=1; $i<=$total; $i++)
  {
    $idp = $_POST["idp$i"];
    $nama = $_POST["nama$i"];
    $idt = $_POST["idt$i"];
    $query = mysqli_query($con,"insert into pengurus values ('$idp','$nama','$idt')") or die(mysql_error());
  }
  echo "
  <script> alert ('$total pengurus baru berhasil ditambahkan');
  document.location='index.php?page=pengurus';
  </script>
  ";
}
?>

<?php
if(isset($_POST['tambahPengurus'])) {
$tahun = $_POST['tahun'];
?>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Tambah Data Pengurus Periode
            <?php
            $periode = mysqli_query($con,"select pilih_tahun from tahun where id_tahun='$tahun'");
            $per = mysqli_fetch_array($periode);
            echo $per['pilih_tahun'];
          ?>
        </h2>
      </div>

      <form action="" method="POST" role="form">
      <div class="body">
        <h2 class="card-inside-title">Masukkan Nama Pengurus</h2>
        <input type="hidden" name="total" value="<?php echo $_POST['jmlTambah']; ?>" >
        <?php
        for($i=1; $i<=$_POST['jmlTambah']; $i++) {
        ?>
        <div class="row clearfix">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="hidden" value="<?php echo $idpeng++; ?>" name="idp<?php echo $i; ?>" readonly>
                <input type="text" class="form-control" placeholder="Nama Pengurus" name="nama<?php echo $i; ?>" required>
                <input type="hidden" value="<?php echo $_POST['tahun']; ?>" name="idt<?php echo $i; ?>" readonly>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary waves-effect" name="simpanpg">
          <span>Simpan</span>
        </button>
      </div>
      </form>

    </div>
  </div>
</div>
<?php } ?>
