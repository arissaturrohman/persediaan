<?php
function BulanRomawi($date)
{
	$BulanIndo = array("I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	// $tgl   = substr($date, 8, 2);

	$result = $BulanIndo[(int)$bulan - 1] . " / " . $tahun;
	return ($result);
}
