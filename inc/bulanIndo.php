<?php
function BulanIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	// $tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	// $tgl   = substr($date, 8, 2);

	$result = $BulanIndo[(int)$bulan-1];
	return($result);
}
