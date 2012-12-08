<?php
   session_start();
   include "include/koneksi.php";
   if(session_is_registered(usernameku)){ header("location:home.php?page=default");}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Easy Aplikasi Penilaian Online</title>
	<link rel="shortcut icon" href="ui/favicon.png"><!-- icon tab -->
	<link rel="stylesheet" type="text/css" href="ui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="ui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="ui/demo/demo.css">
	<script type="text/javascript" src="ui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="ui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="ui/src/jquery.parser.js"></script>
	<style>
		input,select{
			padding:5px;
			/*border:1px solid #ddd;*/
		}
	
	</style>
	<script language="javascript"><!-- fungsi javascript -->
	document.oncontextmenu = new Function("alert('Aplikasi Penilaian Online by @mosolihin');return false;"); //false menu
	</script>
</head>
<body class="easyui-layout">
	<!--blok bawah-->
	<div data-options="region:'south',border:false" style="height:25px;background:#CAD8FD;padding:5px;text-align:right;color:#15428B;">&copy; 2012 oleh @mosolihin &nbsp;</div>
	<!--blok tengah-->
	<div data-options="region:'center'" title="Aplikasi Penilaian Online" style="padding:20px 50px;background:url(ui/index.jpg); background-size:cover;">		
	<form name="login" action="login.php" method="POST">
	<p style="color:#fff;text-shadow:0 1px 0 #333;">Selamat Datang ..</p>
		<input type="text" 	   name="username" placeholder=" Nama Pengguna" size="25" required /><br>
		<input type="password" name="password" placeholder=" Kata Sandi"    size="25" required /><br>
		<select name="level">
			<option value="admin">Administrator</option>
			<option value="guru">Guru</option>
			<option value="wali">Wali Kelas</option>
		</select>
		<br/>
		<input type="submit" name="submit" value="Masuk"/>
	</form>
	</div>
</body>
</html>
			