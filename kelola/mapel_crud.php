<?php

//parameter
$tabel		= "mapel";

$mid 	 	= $_REQUEST['mid'];
$nama 	 	= $_REQUEST['nama'];
$singkatan	= $_REQUEST['singkatan'];
$kkm 	 	= $_REQUEST['kkm'];
$kategori  	= $_REQUEST['kategori'];

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
		$rs = mysql_query("select * from $tabel limit $offset,$rows");

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
		$sql = "insert into $tabel (mid,nama,singkatan,kkm,kategori) 
				values('$mid','$nama','$singkatan','$kkm','$kategori')";
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
		$sql = "update $tabel set nama='$nama', singkatan='$singkatan', kkm='$kkm', kategori='$kategori'
				where mid='$mid'";
		$result = @mysql_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data tidak boleh diperbaharui hari ini'));
		}
	}
	break;
	
	case "remove":
	{
		$sql = "delete from $tabel where mid= '$mid' ";
		$result = @mysql_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Tidak bisa dihapus, data masih tersangkut data lainnya'));
		}
	}
	break;
	
	default;
	echo "Kosong";
	break;
}
?>