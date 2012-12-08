<?php 
#sidebar: navigasi tampil sesuai level akses
#sidebar: level ada admin, kurikulum, wali, guru, (optional siswa) ?>
   
<ul class="easyui-tree" data-options="animate:true,dnd:true">
	<!-- menu master data-->
	<li data-options="state:'closed'"><span>Master Data (Kurikulum)</span> <!-- akses kurikulum -->
		<ul>
			<li><a href='?p=guru'>Guru</a></li>
			<li><a href='?p=kelas'>Kelas</a></li>
			<li><a href='?p=mapel'>Mata Pelajaran</a></li>
	 		<li><a href='?p=siswa'>Siswa</a></li>
		</ul>
	</li>
	<!-- menu data siswa perkelas -->
	<li data-options="state:'opened'"><span>Data Siswa Aktif</span>
		<?php
		#tingkat kelas yang aktif 
	  	#include "include/koneksi.php";
		echo "<ul>";
	 	$jenjang = mysql_query("select kelas.id_tingkat as tingkat from kelas group by kelas.id_tingkat");
	  	while($jj = mysql_fetch_array($jenjang)){
			#tampilkan tingkat;
		  	echo "<li data-options=\"state:'closed'\"><span>Tingkat ".$jj['tingkat']."</span>";
		    $aka = $jj['tingkat'];
		    $kelas = mysql_query("select kid, kelas.nama as namakelas from kelas where kelas.id_tingkat = '$aka' ");
		    echo "<ul>";
				#tampilkan kelas dlm tingkat;
			    while ($dkelas = mysql_fetch_array($kelas)) {
			    echo "<li><a href='?p=siswa_kelas&id_kelas=".$dkelas[kid]."'>Kelas ".$dkelas['namakelas']."</a></li>";
			    }
		    echo "</ul></li>";  
	  }
	  echo "</ul>";
	  ?>
	</li>
	<li><a href='?p=kbm'>Jadwal KBM</a></li>

	<li data-options="state:'closed'"><span>Kelola Nilai (Guru)</span>
		<ul>
			<li><a href='?p=nilai'>Kelola Nilai</a></li>
			<li><a href='?p=absensi'>Kelola Absensi</a></li>
			<li><a href='?p=laporan'>Cetak Laporan</a></li>
		</ul>
	</li>

	<li data-options="state:'closed'">
	<span>Halaman Kamu (Siswa)</span>
		<ul>
	<li><a href='?p=datamu'>Data Kamu</a></li>
	<li><a href='?p=hasilmu'>Hasil Belajar Kamu</a></li>
	<!--li><a href='?p=bse'>BSE Download</a></li-->
	</ul>
	</li>
	<li><a href='?p=stat'>Statistik (Chart)</a></li>
	<li><a href='logout.php'>Keluar</a></li>
</ul>