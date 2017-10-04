<?php

include "../config/koneksi.php";
if (isset($_GET['run'])) $linkchoice=$_GET['run'];
			else $linkchoice='';
			
			switch($linkchoice) {
			
			case 'carianggota';
				carianggota();
			break;
            
            case 'caripinjaman';
				caripinjaman();
			break;
			
			
}
function carianggota(){

if (isset($_GET['namaanggota']))
	{
		$namaanggota = $_GET["namaanggota"];
		$q_namaanggota= mysql_query("SELECT * FROM tabel_anggota  where CONCAT(nama_anggota,' (', nip,')') = '$namaanggota'");
		$h_namaanggota = mysql_fetch_array($q_namaanggota);
		$c_namaanggota = mysql_num_rows($q_namaanggota);
		
         $setor = mysql_query("SELECT sum(jumlah) as total from tabel_simpanan where no_anggota = '".$h_namaanggota[no_anggota]."' and jenis='setor'");
        $hsetor = mysql_fetch_array($setor);
        $tarik = mysql_query("SELECT sum(jumlah) as total from tabel_simpanan where no_anggota = '".$h_namaanggota[no_anggota]."' and jenis='tarik'");
        $htarik = mysql_fetch_array($tarik);
        
        $saldo = $hsetor[total] - $htarik[total];
        
		if($c_namaanggota > 0){
		echo $h_namaanggota["no_anggota"]."||".$h_namaanggota["email"]."||".$h_namaanggota["no_telp"]."||".$saldo;
		}else{
		echo "||||||||";
		}
		
			
	}
}

function caripinjaman(){

if (isset($_GET['namaanggota']))
	{
		$namaanggota = $_GET[namaanggota];
        
		$sql = "SELECT * FROM tabel_anggota a, tabel_pinjaman b where a.no_anggota=b.no_anggota  and CONCAT(a.nama_anggota,' (', a.nip,')') = '$namaanggota'";
        $q_namaanggota= mysql_query($sql);
		$h_namaanggota = mysql_fetch_array($q_namaanggota);
		$c_namaanggota = mysql_num_rows($q_namaanggota);
        $angs = mysql_query("select * from tabel_angsuran where no_pinjaman = '".$h_namaanggota['kode_pinjaman']."'");
        $cek_angs = mysql_num_rows($angs);
        if ($cek_angs > $h_namaanggota['jangka_waktu']){
            $angsuran = "LUNAS";
        } else {
            $angsuran = $cek_angs + 1;
        }
        
       
	//   echo $h_namaanggota[no_anggota];
		if($c_namaanggota > 0){
		echo $h_namaanggota[no_anggota]."||".$h_namaanggota[jumlah_angsuran]."||".$h_namaanggota[kode_pinjaman]."||".$h_namaanggota[email]."||".$h_namaanggota[no_telp]."||".$angsuran;
		}else{
		echo "||||||||||";
		}
		
			
	}
}

