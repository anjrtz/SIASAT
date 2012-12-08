<?php 
//content of home
//nanti pake sesstion_start(); sesuai level

$p=$_GET[p];
switch($p)
{
	//crud untuk master data
	case "guru";	include "kelola/guru.php";	break;

	case "kelas";	include "kelola/kelas.php";	break;
	
	case "mapel";	include "kelola/mapel.php";	break;
	
	case "siswa":	include "kelola/siswa.php";	break;
	
	
	case "tingkat";	include "kelola/tingkat.php";
	break;
	
	case "semester";	include "kelola/semester.php";
	break;
	
	case "tahun":	include "kelola/tahun.php";
	break;
	//crud selesai
	
	//crud untuk proses
	case "siswa_kelas":
	include "kelola/siswa_kelas.php";
	break;
	
	default;	include "welcome.php";
	break;
}

?>