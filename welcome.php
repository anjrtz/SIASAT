<?php
include "tanggal.php";
echo "<p><strong>Selamat Datang, ".ucwords(strtolower($_SESSION[usernameku]))." ( ".ucwords(strtolower($_SESSION[level]))." )</strong><p>";
echo "<p> $sekarang , $tajar <br>";
?>
Aplikasi Penilaian Online ini untuk mengelola data nilai dan rapor. 
Fitur sementara yang tersedia adalah :<br>
<ul><li>Database Guru dan Siswa/i Permanen</li>
	<li>Pengaturan Kelas dan Mata Pelajaran</li>
	<li>Penjadwalan KBM dan Wali Kelas</li>
	<li>Kelola Nilai, Absensi dan Hasil Belajar (Rapor)</li>
	<li>Statistik Data dan Nilai</li>
	</ul>
<br></p>