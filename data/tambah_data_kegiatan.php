<?php
$con = mysqli_connect('localhost','root','','sikati');

//FUNGSI UNTUK MEMBUAT ID MENJADI AUTONUMBER (HURUF+ANGKA) DATA PENGURUS
function idkg() {
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

$idg = idkg();



if(isset($_POST['simpankg'])) {
  $total = $_POST['total'];

  for($i=1; $i<=$total; $i++)
  {
    $idpr = $_POST["idpr$i"];
    $idkeg = $_POST["idkeg$i"];
    $tgl = $_POST["tgl$i"];
    $uraian = $_POST["uraian$i"];
    $debit = $_POST["debit$i"];
    $kredit = $_POST["kredit$i"];
    $saldo = $_POST["saldo$i"];
    $ket = $_POST["ket$i"];
    $query = mysqli_query($con,"insert into proses_kegiatan values ('$idpr','$idkeg','$tgl','$uraian','$debit','$kredit','$saldo','$ket')") or die(mysql_error());
  }
  echo "
  <script> alert ('$total data baru berhasil ditambahkan');
  document.location='index.php?page=pra_kegiatan';
  </script>
  ";
}
?>

<?php
if(isset($_POST['tambahPengurus'])) {
$kegiatan = $_POST['kegiatan'];
?>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Tambah Data Kegiatan
            <?php
            $periode = mysqli_query($con,"select nama_kegiatan from kegiatan where id_kegiatan='$kegiatan'");
            $per = mysqli_fetch_array($periode);
            echo $per['nama_kegiatan'];
          ?>
        </h2>
      </div>

      <form action="" method="POST" role="form">
      <div class="body">
        <h2 class="card-inside-title">Masukkan Data Kegiatan</h2>
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
                <input type="text" value="<?php echo $idg++; ?>" name="idpr<?php echo $i; ?>" readonly>
                <input type="text" value="<?php echo $_POST['kegiatan']; ?>" name="idkeg<?php echo $i; ?>" readonly>
                
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
          <!--uraian-->
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
              </span>
              <div class="form-line">
                <input type="text" class="form-control" placeholder="Uraian" name="uraian<?php echo $i; ?>">
              </div>
            </div>
          </div>
            <!--debit-->
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
              </span>
              <div class="form-line">
                <input type="number" class="form-control" placeholder="Debit" name="debit<?php echo $i; ?>">
              </div>
            </div>
          </div>
          <!--kredit-->
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
              </span>
              <div class="form-line">
                <input type="number" class="form-control" placeholder="kredit" name="kredit<?php echo $i; ?>">
              </div>
            </div>
          </div>
            <!--saldo-->
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
              </span>
              <div class="form-line">
                <input type="number" class="form-control" placeholder="saldo" name="saldo<?php echo $i; ?>">
              </div>
            </div>
          </div>
          <!--keterangan-->
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
              </span>
              <div class="form-line">
                <input type="text" class="form-control" placeholder="keterangan" name="ket<?php echo $i; ?>">
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <a class="btn bg-pink waves-effect" role="button" href="index.php?page=pra_kegiatan">
          <span>Batal</span>
        </a>
        <button type="submit" class="btn btn-primary waves-effect" name="simpankg">
          <span>Simpan</span>
        </button>
      </div>
      </form>

    </div>
  </div>
</div>
<?php } ?>
