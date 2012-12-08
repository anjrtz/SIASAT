<?php
/* APLIKASI PENILAIAN ONLINE v.1 */
	#Koneksi dan permisi
	session_start();
	include "include/koneksi.php";
	if(!session_is_registered(usernameku)){ header("location:index.php"); }
	#selesai
?>
 
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Aplikasi Penilaian Online</title>
	<link rel="shortcut icon" href="ui/favicon.png"><!-- icon tab -->
	<!-- easyUI-->
	<link rel="stylesheet" type="text/css" href="ui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="ui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="ui/demo/demo.css">
	<script type="text/javascript" src="ui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="ui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="ui/src/jquery.parser.js"></script>
	<script type="text/javascript" src="ui/locale/easyui-lang-id.js"></script>
	<script language="javascript"><!-- fungsi javascript -->
	function goBack() {	window.history.back() }	//fungsi kembali
	function print() //fungsi cetak
	{  var sOption="toolbar=yes,location=no,directories=yes,menubar=yes,scrollbars=yes,width=900,height=600,left=100,top=25";
	   var sWinHTML = document.getElementById('divPrint').innerHTML;
	   var winprint=window.open("","",sOption);
	   winprint.document.open();
	   winprint.document.write('<html><head><link rel="stylesheet" type="text/css" href="gs/css/print.css" media="print"/>');
	   winprint.document.write('</head><body onload="window.print();">');
	   winprint.document.write(sWinHTML);
	   winprint.document.write('</body></html>');
	   winprint.document.close();
	   winprint.focus();}
	//document.oncontextmenu = new Function("alert('Aplikasi Penilaian Online by @mosolihin');return false;"); //false menu
	</script>
</head>
<body class="easyui-layout">
	<!--blok atas-->
	<div data-options="region:'north',border:false" style="height:80px;background:#CAD8FD url(ui/head.png) no-repeat;padding:10px 10px;color:#15428B;text-align:right;">
		NAMA SEKOLAH ANDA JAKARTA
		<br>Jalan. Belajar Mengajar Nomor I Jakarta Raya
		<br>Telepon / Fax : 085741616781 website : www.egokreasi.web.id
		<!--br><i>Nantinya: profil sekolah, dll dimasukkan ke file config.ini atau tabel</i-->
	</div>
	<!--blok bawah-->
	<div data-options="region:'south',border:false" style="height:20px;background:#CAD8FD;padding:2px;text-align:right;color:#15428B;font-size:10px;">
		 Aplikasi Penilaian Online &copy; 2012 oleh @egokreasi &nbsp;
	</div>
	<!--blok kiri-->
	<div data-options="region:'west',split:true" title="Contoh Menu Utama" style="width:200px;overflow:hidden;padding:0 0 1px 0;">
		<div class="easyui-accordion" data-options="fit:true,border:false">
			
			<div title="Navigasi" data-options="selected:true" style="padding:10px;overflow:auto;background:#fff;">
				<!-- just include sidebar -->
				<?php include "sidebar.php"; ?>
			</div>
			
			<div title="Pilihan" style="padding:10px;overflow:auto;background:#fff;">
				Menu pilihan seusai konten yang lagi diakses tampil di sini.
				<br>Contoh: Pilih Siswa, dll
			</div>
			<div title="Lain-lain" data-options="selected:true" style="padding:7px;overflow:auto;background:#fff;">
				<div class="easyui-calendar" style="width:180px;height:180px;"></div>
			</div>
		</div>
	</div>
	
	<!--blok tengah-->
	<div data-options="region:'center'" title="Contoh Konten" style="padding:10px;">
		<?php include "content.php";?>
	</div>
</body>
</html>