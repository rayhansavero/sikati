<?php
// isi nama host, username mysql, dan password mysql anda
$host = mysql_connect("localhost","root","");

if($host){
	echo "koneksi host berhasil.<br/>";
}else{
	echo "koneksi gagal.<br/>";
}
// isikan dengan nama database yang akan di hubungkan
$db = mysql_select_db("kategori");

if($db){
	echo "koneksi database berhasil.";
}else{
	echo "koneksi database gagal.";
}
?>
<div id="smallRight">
  <h3 style="background-color:#A6D44D">Jadwal Dokter</h3>
  <table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
    <tr>
      <td colspan="5">
      <form method="post" action="">
        <select name="cid">
          <option value="" disabled="disabled">--informasi--</option>
          <?php
          $a="SELECT * FROM jadwal_cat";
          $sql=mysql_query($a);
          while($data=mysql_fetch_array($sql))
          {
          ?>
          <option value="<?php echo $data['cid']?>"><?php echo $data['kategori']?></option>
          <?php
          }
          ?>
        </select>
        <input type="submit" value="cari"/>
      </form>
      </td>
    </tr>
  </table>

  <table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
    <tr>
      <td style="border: none;padding: 4px;"><b>Hari</b></td>
      <td style="border: none;padding: 4px;"><b>Jam</b></td>
      <td style="border: none;padding: 4px;"><b>Dokter</b></td>
      <td style="border: none;padding: 4px;"><b>Keterangan</b></td>
    </tr>
    <?php
    if(isset($_POST['cid'])){
    $sql = "select * from jadwal WHERE cid = ".$_POST['cid']."";
    $q = mysql_query($sql);
    while($data = mysql_fetch_array($q)){
    ?>
    <tr>
      <td style="border: none;padding: 4px;"><?php echo $data['hari'];?></td>
      <td style="border: none;padding: 4px;"><?php echo $data['jam'];?></td>
      <td style="border: none;padding: 4px;"><?php echo $data['dokter'];?></td>
      <td style="border: none;padding: 4px;"><?php echo $data['keterangan'];?></td>
    </tr>
    <?php
    }
  }
  ?>
  </table>
</div>
