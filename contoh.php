<?php

$tahun=date("Y");
$tahun2=$tahun+1;
$tahunajar = "$tahun - $tahun2";
echo $tahunajar;

include "include/koneksi.php";

$q = "SELECT * FROM tahun where nama like";



?>