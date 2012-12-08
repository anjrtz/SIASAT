<?php
/* PROSES IMPORT DATA SISWA */

// menggunakan class phpExcelReader
include "include/excel_reader2.php";

// koneksi ke mysql
include "include/koneksi.php";

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{

// membaca data nim (kolom ke-1)
$nis = $data->val($i, 1);

// membaca data nama (kolom ke-2)
$nama = $data->val($i, 2);

// membaca data jenis kelamin (kolom ke-3)
$telepon = $data->val($i, 3);

// membaca data alamat (kolom ke-4)
$tahun_masuk = $data->val($i, 4);

// membaca data telepon (kolom ke-5)
$masuk_kelas = $data->val($i, 5);

// membaca data tahun ini sebagai tahun aktif
$tahunaktif = mysql_query("SELECT * FROM tahun WHERE tgl_awal < now() AND tgl_akhir > now()");
$ta = mysql_fetch_array($tahunaktif);
$tajar = $ta['tid'];

// setelah data dibaca, sisipkan ke dalam tabel mhs
$query = "INSERT INTO siswa VALUES ('$nis', '$nama', '$telepon', '$tahun_masuk', '$masuk_kelas')";
$hasil = mysql_query($query);
	// jika proses insert data sukses, maka counter $sukses bertambah
	// jika gagal, maka counter $gagal yang bertambah
	if ($hasil)	
	{ 
		$sukses++;
		$qkelas = "INSERT INTO siswa_kelas VALUES ('$masuk_kelas','$nis','$tajar') ";
		$hasilkelas = mysql_query($qkelas);
		}	
		else 
		{	$gagal++;}
}

// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
header( "refresh:3; url=home.php?p=siswa_kelas&id_kelas=$masuk_kelas" );
?>