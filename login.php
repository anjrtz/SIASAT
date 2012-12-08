<?php

session_start();
include "include/koneksi.php";
$tabellogin= "guru";

#nilai dari form
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

#proteksi
$usernameku	= mysql_real_escape_string($username);
$levelku 	= mysql_real_escape_string($level);
$passwordku	= md5(mysql_real_escape_string($password));

#query login
$sql = "SELECT * FROM $tabellogin WHERE username='$usernameku' and password='$passwordku' and level = '$levelku' ";
$result = mysql_query($sql);
$count = mysql_num_rows($result);

if ($count == 1 && ($level == 'admin')) {
	/* if apache 
	session_register('usernameku');
	session_register('level');
	session_register('passwordku');*/
	$_SESSION['usernameku'] = $usernameku;
	$_SESSION['passwordku'] = $passwordku;
	$_SESSION['level'] = $level;
	header("location:home.php");
	}
	
else if ($count == 1 && ($level == 'guru')) {
	/*session_register('usernameku');
	session_register('level');
	session_register('passwordku');*/
	$_SESSION['usernameku'] = $usernameku;
	$_SESSION['passwordku'] = $passwordku;
	$_SESSION['level'] = $level;
	header("location:home.php");
	}
	
else
	include "index.php";
	echo "<script type='text/javascript'>onload =function(){alert('Maaf! User, Username atau Password Anda salah!! Ulangi kembali');} </script>";
		
?>