<?php

//parameter
$tabel		= "guru";

$gid   	 	= $_REQUEST['gid'];
$nama	   	= $_REQUEST['nama'];
$jenis	   	= $_REQUEST['jenis'];
$alamat	   	= $_REQUEST['alamat'];
$telepon   	= $_REQUEST['telepon'];
$username	= $_REQUEST['username'];
$password	= md5($_REQUEST['password']);
$level		= $_REQUEST['level'];

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

		$rs   = mysql_query("select count(*) from $tabel");
		$row  = mysql_fetch_row($rs);
		$result["total"] = $row[0];
		$rs   = mysql_query("select * from $tabel limit $offset,$rows");

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
		$sql = "insert into $tabel (nama,jenis,alamat,telepon,username,password,level) 
				values('$nama','$username','$alamat,'$telepon','$username','$password','$level')";
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
		$sql = "update $tabel set nama='$nama', jenis = '$jenis', alamat = '$alamat', telepon = '$telepon', username='$username', password='$password', level='$level' where gid='$gid'";
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
		$sql = "delete from $tabel where gid= '$gid' ";
		$result = @mysql_query($sql);
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Data tidak bisa dihapus karena sedang aktif digunakan'));
		}
	}
	break;
	default;
	echo "Kosong";
	break;

}
?>
