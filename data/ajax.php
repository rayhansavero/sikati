<?php
$con = mysqli_connect('localhost','root','','sikati');

echo "<select class=\"form-control show-tick nama_pengurus\" id=\"nama_pengurus\" name=\"nama_pengurus\">";
if(isset($_REQUEST["tahun"])) {
    $res=mysqli_query($con, "SELECT * FROM pengurus WHERE id_tahun='$_REQUEST[tahun]'");
    while ($row=mysqli_fetch_array($res))
        {
            echo "<option value=\"$row[ID_PENGURUS]\">".$row["NAMA_PENGURUS"]."</option>";
        }
}
echo "</select>";
?>
