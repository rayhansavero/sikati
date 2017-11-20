<?php
$con = mysqli_connect('localhost','root','','sikati');
$TAHUN=$_GET["TAHUN"];

if($TAHUN!=""){
    $res=mysqli_query("SELECT * FROM list_pengurus WHERE T_ID_fk=$TAHUN");
    echo "<select>";
        while ($row=mysqli_fetch_array($res))
        {
            echo "<option>"; echo $row["TAHUN"]; echo "</option>";
        }
    echo "</select>";
?>