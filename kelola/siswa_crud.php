<?php
//belum selesai nih

//parameter
$tabel		= "siswa";

$nis 	 	= $_REQUEST['nis'];
$nama 	 	= $_REQUEST['nama'];
$jenis 	 	= $_REQUEST['jenis'];
$alamat	 	= $_REQUEST['alamat'];
$telepon 	= $_REQUEST['telepon'];
$tahun 	 	= $_REQUEST['tahun_masuk'];
$kelas 	 	= $_REQUEST['masuk_kelas'];


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
		$sql = "insert into $tabel (nis,nama,telepon,tahun_masuk,masuk_kelas) 
				values('$nis','$nama','$telepon','$tahun','$kelas')";
		$thn = $tahun." - ".$tahun+1;				
		$sql2 = "insert into siswa_kelas (id_kelas,nis,id_tahun) values ('$kelas','$nis','$thn')";
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
		$sql = "update $tabel set nama='$nama', telepon='$telepon', tahun_masuk='$tahun', masuk_kelas='$kelas' 
				where nis = '$nis'";
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
		$sql = "delete from $tabel where nis= '$nis' ";
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