<script>
            function callResize()
            {
                var height = document.body.scrollHeight;
                parent.resizeIframe(height);
				parent.window.top.location.reload;
            }
            window.onload =callResize;
        </script>
<?php
function kdauto($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);

 	$qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel);
 	$row	= mysql_fetch_array($qry);
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}

 	$angka++;
 	$angka	=strval($angka);
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
	}
 	return $inisial.$tmp.$angka;
}

// Konvesi dd-mm-yyyy -> yyyy-mm-dd
function tgl_ind_to_eng() {
	$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
	return $tgl_eng;
}

// Konvesi yyyy-mm-dd -> dd-mm-yyyy
function tgl_eng_to_ind($tgl) {
	$tgl_ind=substr($tgl,0,2).".".substr($tgl,3,2).".".substr($tgl,6,4);
	return $tgl_ind;
}

function tgl_eng_to_ind1($tgl) {
	$tgl_ind=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
	return $tgl_ind;
}

function tgl_eng_to_ind2($tgl) {
	$tgl_ind=substr($tgl,8,2).".".substr($tgl,5,2).".".substr($tgl,0,4);
	return $tgl_ind;
}

function waktu_eng_to_ind($wkt) {
	$wkt_ind=substr($wkt,11,2).":".substr($wkt,14,2);
	return $wkt_ind;
}

function waktu_eng_to_ind1($wkt) {
	$wkt_ind=substr($wkt,0,2).":".substr($wkt,3,2);
	return $wkt_ind;
}

function tgl_eng_to_ind_time($tgl) {
	$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4).":".substr($tgl,11,9) ;
	return $tgl_ind;
}

function format_angka($angka) {
	$hasil =  number_format($angka,0, ",",".");
	return $hasil;
}

function DateToIndo($date){
 $BulanIndo = array("Januari", "Februari", "Maret",
                           "April", "Mei", "Juni",
                           "Juli", "Agustus", "September",
                           "Oktober", "November", "Desember");
$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');




        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);
		$hari = date("N",mktime(0,0,0,$date));
        $result =$hari .", ". $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
        return($result);
}

?>
<?php

function Hari($tgl,$bln,$thn){
$hari = date("N",mktime(0,0,0,$bln,$tgl,$thn));
return($hari);
}

function NamaHari($id){
switch($id){
case 1: $hari = "Senin";break;
case 2: $hari = "Selasa";break;
case 3: $hari = "Rabu";break;
case 4: $hari = "Kamis";break;
case 5: $hari = "Jumat";break;
case 6: $hari = "Sabtu";break;
case 7: $hari = "Minggu";break;
}
return($hari);
}

function NamaBulan($id){
switch($id){
case 1: $bulan = "Januari";break;
case 2: $bulan = "Febuari";break;
case 3: $bulan = "Maret";break;
case 4: $bulan = "April";break;
case 5: $bulan = "Mei";break;
case 6: $bulan = "Juni";break;
case 7: $bulan = "Juli";break;
case 8: $bulan = "Agustus";break;
case 9: $bulan = "September";break;
case 10: $bulan = "Oktober";break;
case 11: $bulan = "November";break;
case 12: $bulan = "Desember";break;
}
return($bulan);
}

function tgl($tanggal) {
list($thn,$bln,$tgl) = explode("-",$tanggal);
$hari = NamaHari(Hari($tgl,$bln,$thn));
$bulan = NamaBulan($bln);

echo $hari.", ".$tgl." ".$bulan." ".$thn;
}


?>
