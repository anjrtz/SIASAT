<?php	#siswa_kelas.php -> menampilkan data siswa terdaftar di setiap kelas
	
	#koneksi
	include ("include/koneksi.php");
	#retrieve data siswa
	$kelas = $_GET['id_kelas'];
	$querysiswakelas = "SELECT siswa_kelas.nis as nis, siswa.nama as namasiswa
						FROM siswa_kelas, siswa
						WHERE siswa_kelas.nis = siswa.nis AND id_kelas = '$kelas'";
	$siswakelas = mysql_query($querysiswakelas);
	$total = mysql_num_rows($siswakelas);
	#retrieve keterangan kelas							
	$detailkelas = mysql_query("SELECT kelas.nama as nmkls, guru.nama as nmgr,kapasitas FROM kelas cross join guru 
								WHERE kelas.id_guru = guru.gid AND kid = '$kelas'");
	$dk = mysql_fetch_array($detailkelas);
	
	if($total ==0) {
		echo "<p style='font-weight:bold;color:red;'>Data Siswa kelas ini belum diinput / diimpor!</p>";
		include "siswa_impor_form.php";
	}
	else {
?>
<h2 style="text-align:center;text-shadow:0 1px 0 #ddd;">Data Kelas</h2>
<!-- keterangan kelas -->
<table>
<tr><td>Kelas</td><td>: <?php echo $dk[nmkls];?></td></tr>
<tr><td>Wali Kelas</td><td>: <?php echo $dk[nmgr];?></td></tr>
<tr><td>Jumlah.</td><td>: <?php echo $total." / ".$dk[kapasitas];?></td></tr>
</table>
<br />
<!-- data siswa per kelas -->
<table id="tt" class="easyui-datagrid" style="min-width:400px;height:auto;">
<thead>
<tr>
	<th field="no">No.</th>
	<th field="nis">NIS</th>
	<th field="nama">Nama Siswa</th>
</tr>
</thead>
<tbody>

<?php
$no=1;
while($sk = mysql_fetch_array($siswakelas)){
	echo "<tr><td>$no</td><td>".$sk['nis']."</td><td>".$sk['namasiswa']."</td></tr>";
$no++;
}
?>
</tbody>
</table>
<br />	
<?php } ?>