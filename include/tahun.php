<?php

include "koneksi.php";
$tahunaktif = mysql_query("SELECT * FROM tahun");
$kelas= @mysql_query("SELECT * FROM kelas");
$siswa= @mysql_query("SELECT * FROM siswa");
echo "Hasil query : ".$tahunaktif."<br>";
echo "Hasil query kelas : ".$kelas."<br>";
echo "Hasil query kelas : ".$siswa."<br>";
while ($ta = mysql_fetch_array($tahunaktif))
{
$tajar = $ta['tid'];
echo $tajar.", ";
}
?>