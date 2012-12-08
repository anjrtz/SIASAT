<?php

//parameter
$tabel		= "kelas";

$kid 	 	= $_REQUEST['kid'];
$nama	 	= $_REQUEST['nama'];
$id_tingkat = $_REQUEST['id_tingkat'];
$id_guru	= $_REQUEST['id_guru'];
$kap		= $_REQUEST['kap'];

//koneksi
include '../include/koneksi.php';

//pilihan crud
$crud =$_GET[crud];

switch($crud){
	case "get":
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$result = array();

		$rs = mysql_query("select count(*) from $tabel");
		$row = mysql_fetch_row($rs);
		$result["total"] = $row[0];
		$rs = mysql_query("SELECT kid, kelas.nama as nama, tingkat.nama as id_tingkat, guru.nama as id_guru, kapasitas as kap
						   FROM kelas,tingkat,guru
						   WHERE kelas.id_tingkat = tingkat.id
						   AND kelas.id_guru = guru.gid limit $offset,$rows");

		$items = array();
		while($row = mysql_fetch_object($rs)){
			array_push($items, $row);
		}
		$result["rows"] = $items;

		echo json_encode($result);
	}
	break;
	
	case "save":
	{	
		$sql = "insert into $tabel (kid,nama,id_tingkat,id_guru,kapasitas) 
							values('$kid','$nama','$id_tingkat','$id_guru','$kapasitas')";
		$result = @mysql_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Terjadi Kesalahan.'));
		}
	}
	break;
	
	case "update":
	{	
		$sql = "UPDATE $tabel SET nama = '$nama' , id_tingkat = '$id_tingkat' WHERE kelas.kid = '$kid' ;";
		$result = @mysql_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data gagal di-update! Hubungi Admin'));
		}
	}
	break;
	
	case "remove":
	{
		$sql = "delete from $tabel where kid= '$kid' ";
		$result = @mysql_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Tidak bisa dihapus, karena data tsb aktif digunakan'));
		}
	}
	break;
	
	case "wali":
	{
		$wali = mysql_query("SELECT gid, nama as gnama FROM guru where level = 'wali'");

		#ubah ke json
		$items = array();
		while($row = mysql_fetch_object($wali)){
		array_push($items, $row);
		}
		$result = $items;
		echo json_encode($result);
	} break;
	
	case "tingkat":
	{
		$pilihtingkat = mysql_query("SELECT id as id_tingkat, nama as tnama FROM tingkat");

		#ubah ke json
		$items = array();
		while($row = mysql_fetch_object($pilihtingkat)){
		array_push($items, $row);
		}
		$result = $items;
		echo json_encode($result);
	} break;
	
	default;
	echo "Kosong";
	break;
}
?>
