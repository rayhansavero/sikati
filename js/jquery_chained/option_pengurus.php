<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil data ID Provinsi yang dikirim via ajax post
$T_ID_fk = $_POST['list_pengurus'];
// Buat query untuk menampilkan data kota dengan provinsi tertentu (sesuai yang dipilih user pada form)
$sql = $pdo->prepare("SELECT * FROM list_pengurus WHERE T_ID_fk='".$T_ID_fk."' ORDER BY NAMA_PENGURUS");
$sql->execute(); // Eksekusi querynya
// Buat variabel untuk menampung tag-tag option nya
// Set defaultnya dengan tag option Pilih
$html = "<option value=''>Pilih</option>";
while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
  $html .= "<option value='".$data['T_ID']."'>".$data['TAHUN']."</option>"; // Tambahkan tag option ke variabel $html
}
$callback = array('data_list_pengurus'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>