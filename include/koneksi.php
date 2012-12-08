<?php
/*	KONEKSI DATABASE
	================================================== */
	ini_set('display_errors',FALSE);
	$host="localhost:3306";
	$user="root";
	$pass="1234";
	$db="penilaian2";
	
	$koneksi=mysql_connect($host,$user,$pass);
	mysql_select_db($db,$koneksi);
	//if ($koneksi) { echo "<p>Koneksi lancar</p>"; } 
		//else { echo "Gagal Koneksi Database MySQL!"; }
?>