<?php
$con = mysqli_connect('localhost','root','','sikati');
date_default_timezone_set('Asia/Jakarta');

function nomor() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_kas from list_kas_rutin order by id_kas desc limit 0,1") or die(mysql_error());
	list ($no_temp) = mysqli_fetch_row($query);

	if ($no_temp == '') {
		$no_urut = 'K001';

		} else {
		$jum = substr($no_temp,1,4);
		$jum++;
		if($jum <= 9) {
			$no_urut = 'K00' . $jum;
		}
    elseif ($jum <= 99) {
			$no_urut = 'K0' . $jum;
		}
    elseif ($jum <= 999) {
			$no_urut = 'K' . $jum;
		}
    else {
			die("Nomor urut melebih batas");
		}
	}
		return $no_urut;
}

//SIMPAN FUNGSI nomor() KE VARIABEL $nomor
$nomor = nomor();

/*if (isset($_POST['simpan'])) {
  $id_pengurus = $_POST['id_pengurus'];
  $tanggal = $_POST['tanggal'];
  $jumlah = $_POST['jumlah']
  $query = mysqli_query($con,"insert into list_kas_rutin values ('$nomor','$id_pengurus','$tanggal','$jumlah')") or die(mysql_error());
  echo "
  <script> alert ('Data Berhasil di Tambahkan');
  document.location='index.php?page=kas_rutin';
  </script>
  ";
}*/
?>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          Data Kas Rutin HMJ TI
        </h2>
      </div>

      <div class="body">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!--TOMBOL TAMBAH DATA KR-->
            <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#tambahKas">
              <i class="material-icons">add</i>
              <span>Tambah Data</span>
            </button>
          </div>
            
<!--===================================================================================================================-->
          <!--MODAL TAMBAH KR-->
          <div class="modal fade" id="tambahKas" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Form Tambah Data Kas Rutin</h4>
                </div>
                <div class="modal-body">
                  <form action="" method="POST" role="form">
                      
                      <!--PERIODE PENGURUSAN-->
                    <div class="col-md-12">
                    <b>Periode Pengurusan</b>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">work</i>
                      </span>
                      <select class="form-control show-tick" id="periode_pengurusan" name="periode_pengurusan" onchange="listpengurus()">
                        <option value="">Pilih Periode</option>
                        <?php
                            $query = mysqli_query($con, "SELECT * FROM th_pengurusan ORDER BY TAHUN");
                            while ($row = mysqli_fetch_array($query)) {
                                ?>
                          <option value="<?php echo $row['T_ID']; ?>">
                            <?php echo $row['TAHUN']; ?>
                          </option>
                          <?php
                            }
                        ?>
                      </select>
                    </div>
                  </div>
                      
                      <!--NAMA PENGURUS-->
                      <div class="col-md-12">
                    <b>Nama Pengurus</b>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">person</i>
                      </span>
                        <div id="result_pengurus">
                              <select class="form-control show-tick nama_pengurus" id="nama_pengurus" name="nama_pengurus">
                                <option value="">Pilih Pengurus</option>
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM list_pengurus INNER JOIN th_pengurusan ON list_pengurus.T_ID_fk = th_pengurusan.T_ID ORDER BY NAMA_PENGURUS");
                                  while ($row = mysqli_fetch_array($query)) {
                                      ?>
                                  <option value="<?php echo $row['ID_PENGURUS']; ?>">
                                  <?php echo $row['NAMA_PENGURUS']; ?>
                                  </option>
                                  <?php
                                  }
                                  ?>
                              </select>
                        </div>
                    </div>
                  </div>
                      
                <!--ID KAS-->
                  <div class="col-md-12">
                    <b>ID Kas</b>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">fingerprint</i>
                      </span>
                      <div class="form-line">
                        <input type="text" class="form-control" name="id_kas" value="<?php echo $nomor; ?>">
                      </div>
                    </div>
                  </div>
                      
                <!--TANGGAL BAYAR-->
                  <div class="col-md-12">
                    <b>Tanggal Bayar</b>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                      </span>
                      <div class="form-line">
                        <input type="text" class="form-control" name="tanggal" value="<?php echo isset($_GET['id_kas'])?$data[2]:date('d-m-Y'); ?>" disabled>
                      </div>
                    </div>
                  </div>
                      
                <!--JUMLAH BAYAR-->
                  <div class="col-md-12">
                    <b>Jumlah Bayar</b>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">attach_money</i>
                      </span>
                      <div class="form-line">
                        <input type="text" class="form-control" placeholder="Jumlah Bayar" name="jumlah">
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
          <!--END MODAL TAMBAH DATA PENGURUS-->

          <!--TABEL DATA KR-->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
              <thead>
                <tr>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Total Pembayaran</th>
                  <th class="text-center">Detail Pembayaran</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $qu = mysqli_query($con,"select * from list_kas_rutin");
                while ($has = mysqli_fetch_row($qu))
                {
                  ?>
                  <tr>
                    <td><?php echo $has[1]; ?></td>
                    <td>Rp <?php echo $has[3]; ?></td>
                    <td td style="text-align:center">
                      <!--TOMBOL DETAIL DATA-->
                      <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#detailKR<?php echo $has[1]; ?>">
                        <i class="material-icons">description</i>
                      </button>
                      <!--MODAL DETAIL DATA-->
                      <div class="modal fade" id="detailKR<?php echo $has[1]; ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog " role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Detail Pembayaran <?php echo $has[1]; ?></h4>
                            </div>
                            <div class="modal-body">
                              <!--form action="" method="POST" role="form"-->

                              <div class="col-md-6">                                
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                  </span>
                                  <div class="form-line">
                                    <input type="text" class="form-control" name="tanggal" value="<?php echo $has[2]; ?>">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="material-icons">attach_money</i>
                                  </span>
                                  <div class="form-line">
                                    <input type="text" class="form-control" name="bayar" value="Rp <?php echo $has[3]; ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                            <!--/form-->
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL EDIT DATA PENGURUS-->
                    </td>
                  </tr>
                  <?php
                  ;
                }
                ?>
              </tbody>
            </table>
              <script src="js/jquery.chained.min.js"></script>
              <script>//$("#list_pengurus").chained("#th_pengurusan");
              function listpengurus(){
                  $.ajax({
                      url: 'data/ajax.php?tahun='+document.getElementById('periode_pengurusan').value,
                      success: function(data) {
                          //$('.nama_pengurus').html(data);
                          $('#result_pengurus').html(data);
                      }
                });
                  
                  //alert('tes');
              }
              
              </script>
          </div>
        </div>
        <!--END TABEL DATA KR-->

      </div>

    </div>
  </div>
</div>
