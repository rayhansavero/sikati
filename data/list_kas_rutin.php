<?php
$con = mysqli_connect('localhost','root','','sikati');
date_default_timezone_set('Asia/Jakarta');

function nomor() {
  $con = mysqli_connect('localhost','root','','sikati');
  $query = mysqli_query($con,"select id_kas from bayar_kas order by id_kas desc limit 0,1") or die(mysql_error());
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
              
                      <form action="#" method="">
                    <select name="id_tahun">
                        <option>PILIH TAHUN</option>
                        <?php
                            $cari = "select * from tahun";
                            $sql = mysqli_query($con, $cari);
                            while($data=mysqli_fetch_array($sql)){
                        ?>
                        <option value="<?php echo $data['id_tahun']?>"><?php echo $data['pilih_tahun']?></option>
                        <?php
                            }
                        ?>
                    <input type="text" name="id_tahun" >
                    </select>
                           <input type="submit" value="CARI" name="submit"/>
                   </form> 
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
                            $query = mysqli_query($con, "SELECT * FROM tahun ORDER BY pilih_tahun");
                            while ($row = mysqli_fetch_array($query)) {
                                ?>
                          <option value="<?php echo $row['id_tahun']; ?>">
                            <?php echo $row['pilih_tahun']; ?>
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
                                $query = mysqli_query($con, "SELECT * FROM pengurus INNER JOIN tahun ON pengurus.id_tahun = tahun.id_tahun ORDER BY nama_pengurus");
                                  while ($row = mysqli_fetch_array($query)) {
                                      ?>
                                  <option value="<?php echo $row['id_pengurus']; ?>">
                                  <?php echo $row['nama_pengurus']; ?>
                                  </option>
                                  <?php
                                  }
                                  ?>
                              </select>
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
                        <input type="text" class="form-control" name="tanggal" value="<?php echo isset($_GET['id_kas'])?$data[2]:date('Y-m-d'); ?>">
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
                    
                <div class="modal-footer">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                  <button type="submit" class="btn btn-link waves-effect" name="simpan">SIMPAN</button>
                </div>
                </form>
                    <?php
                    if(isset($_POST['simpan'])){
                        $id_kas = $_POST['id_kas'];
                        $periode_pengurusan = $_POST['periode_pengurusan'];
                        $nama_pengurus = $_POST['nama_pengurus'];
                        $tanggal = $_POST['tanggal'];
                        $tanggal = date('Y-m-d', strtotime($tanggal));
                        $jumlah = $_POST['jumlah'];
                        
                        include_once("koneksi.php");
                        
                        $sql = "select * from pengurus where id_pengurus='$nama_pengurus' ";
                        $sql1 = "select * from tahun where id_tahun='$periode_pengurusan' ";
                        $result = mysqli_query($con, "insert into bayar_kas(id_kas, id_pengurus, id_tahun, tgl_bayar_kas, jumlah_bayar_kas, saldo) values ('$id_kas', '$nama_pengurus', '$periode_pengurusan', '$tanggal', '$jumlah', '')");
                    }
                    ?>
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
                  </tr>
                <tr>
                  <th class="text-center">Nama</th>
                  <!--tr>th class="text-center">Total Pembayaran</th-->
                  <th class="text-center">Detail Pembayaran</th>
                </tr>
              </thead>
              <tbody>
                  
                      <!--?php
                  
                        if(isset($_GET['submit'])){
                            $thn = $_GET['id_tahun'];
                            $sql = "select * from pengurus inner join tahun on pengurus.id_tahun=tahun.id_tahun join bayar_kas on pengurus.id_pengurus=bayar_kas.id_pengurus where tahun.id_tahun = '$thn' ";
                            
                        } else {
                            $sql = "select * from pengurus left join tahun on pengurus.id_tahun=tahun.id_tahun left join bayar_kas on pengurus.id_pengurus=bayar_kas.id_pengurus";
                         
                        }
                           $q = mysqli_query($con, $sql) or die (mysqli_error());
                          while($data = mysqli_fetch_array($q)){
                      ?-->
                  
                  
                  <?php
                  $sql = mysqli_query($con, "select * from pengurus inner join tahun on pengurus.id_tahun=tahun.id_tahun");
                  while ($data=mysqli_fetch_array($sql)){
                  ?>
                  
                  
                  <tr>
                      <td><?php echo $data['nama_pengurus'];?></td>
                      
                      <?php } ?> 
                     
                      <?php
                  $sql = mysqli_query($con, "select * from bayar_kas inner join pengurus on bayar_kas.id_pengurus=pengurus.id_pengurus");
                  while ($data=mysqli_fetch_array($sql)){
                  ?>
                    <!--td>Rp <!--?php echo $data['jumlah_bayar_kas']; ?></td-->
                    <td td style="text-align:center">
                      <!--TOMBOL DETAIL DATA-->
                      <button type="button" class="btn btn-primary btn-xs waves-effect" data-toggle="modal" data-target="#detailKR<?php echo $data[1]; ?>">
                        <i class="material-icons">description</i>
                      </button>
                        
                        
                        
                        
                      <!--MODAL DETAIL DATA-->
                      <div class="modal fade" id="detailKR<?php echo $data[1]; ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog " role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Detail Pembayaran <?php echo $data['nama_pengurus']; ?></h4>
                            </div>
                            <div class="modal-body">
                              <form action="" method="POST" role="form"-->

                              <!--div class="col-md-6">                                
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                  </span>
                                  <div class="form-line">
                                    <input type="text" class="form-control" name="tanggal" value="<?php echo $data[2]; ?>">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="material-icons">attach_money</i>
                                  </span>
                                  <div class="form-line">
                                    <input type="text" class="form-control" name="bayar" value="Rp <?php echo $data[3]; ?>">
                                  </div>
                                </div>
                              </div-->
                                
                                <table>
                                <thead>
                                    <tr>
                                        <th>ID Kas</th>
                                    <th>Tanggal</th>
                                        <th>Jumlah</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $data['id_kas']; ?></td>
                                        <td><?php echo $data['tgl_bayar_kas']; ?></td>
                                        <td><?php echo $data['jumlah_bayar_kas']; ?></td>
                                    </tr>
                                </thead>
                                </table>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                            <!--/form-->
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL EDIT DATA PENGURUS-->
                        
                        
                   <?php } ?>     
                    </td>
                   
                  </tr>
                  <!--?php
                  
                  }
                ?-->
              </tbody>
            </table>
              <script src="js/jquery.chained.min.js"></script>
              <script>//$("#list_pengurus").chained("#th_pengurusan");
              function listpengurus(){
                  $.ajax({
                      url: 'data/ajax.php?tahun='+document.getElementById('p').value,
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