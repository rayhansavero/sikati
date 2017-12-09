<?php
$con = mysqli_connect('localhost','root','','sikati');

//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) DATA PENGURUS
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

if(isset($_POST['simpankas'])) {
  $total = $_POST['total'];

  for($i=1; $i<=$total; $i++)
  {
    $idk = $_POST["idk$i"];
    $idpeng = $_POST["idpeng$i"];
    $idt = $_POST["idt$i"];
    $tgl = $_POST["tgl$i"];
    $bayar = $_POST["bayar$i"];
    $query = mysqli_query($con,"insert into bayar_kas values ('$idk','$idpeng','$idt','$tgl','$bayar')") or die(mysql_error());
  }
  echo "
  <script> alert ('$total kas baru berhasil ditambahkan');
  document.location='index.php?page=kas_rutin';
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
        <h2>Tambah Kas Rutin Pengurus Periode
            <?php
            $periode = mysqli_query($con,"select pilih_tahun from tahun where id_tahun='$tahun'");
            $per = mysqli_fetch_array($periode);
            echo $per['pilih_tahun'];
          ?>
        </h2>
      </div>

      <form action="" method="POST" role="form">
      <div class="body">
        <h2 class="card-inside-title">Masukkan Kas Baru</h2>
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
                <input type="hidden" value="<?php echo $idkas++; ?>" name="idk<?php echo $i; ?>" readonly>
                <input type="hidden" value="<?php echo $_POST['tahun']; ?>" name="idt<?php echo $i; ?>" readonly>
                <select class="form-control show-tick" name="idpeng<?php echo $i; ?>">
                  <option value="">Pilih Pengurus</option>
                  <?php
                  $query = mysqli_query($con, "SELECT * FROM pengurus WHERE id_tahun='$tahun'");
                  while ($row = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?php echo $row['id_pengurus']; ?>"><?php echo $row['nama_pengurus']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">date_range</i>
              </span>
              <div class="form-line">
                <input type="date" class="form-control" name="tgl<?php echo $i; ?>">
              </div>
            </div>
          </div>
          <!--JUMLAH BAYAR-->
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
              </span>
              <div class="form-line">
                <input type="number" min="2000" class="form-control" placeholder="Jumlah Bayar" name="bayar<?php echo $i; ?>">
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <a class="btn bg-pink waves-effect" role="button" href="index.php?page=kas_rutin">
          <span>Batal</span>
        </a>
        <button type="submit" class="btn btn-primary waves-effect" name="simpankas">
          <span>Simpan</span>
        </button>
      </div>
      </form>

    </div>
  </div>
</div>
<?php } ?>
