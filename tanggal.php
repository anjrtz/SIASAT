<?php
/*	TANGGAL HARI INI */
	$hari=date("d");
	$bulan=date("m");
	$tahun=date("Y");
	if($bulan==01){$bulan="Januari";
	}elseif($bulan==02){$bulan="Pebruari";
	}elseif($bulan==03){$bulan="Maret";
	}elseif($bulan==04){$bulan="April";
	}elseif($bulan==05){$bulan="Mei";
	}elseif($bulan==06){$bulan="Juni";
	}elseif($bulan==07){$bulan="Juli";
	}elseif($bulan==08){$bulan="Agustus";
	}elseif($bulan==09){$bulan="September";
	}elseif($bulan==10){$bulan="Oktober";
	}elseif($bulan==11){$bulan="Nopember";
	}else{$bulan="Desember";
	}
	$sekarang="Sekarang adalah $hari $bulan $tahun";
	
/* TAHUN AKTIF (SEKARANG) */
	include ("include/koneksi.php");
	$tahunini = mysql_query("SELECT * FROM tahun WHERE tgl_awal < now() AND tgl_akhir > now()");
	$t = mysql_fetch_array($tahunini);
	$tajar = "Tahun Ajaran ".$t['nama'];
	
?>