<?php
	include('information_schema_manual.php');
	
	$jenisuser = $_SESSION['jenisuser'];
	
	if(empty($_SESSION['nama_kantor'])) {
		if($jenisuser != 'ki') {
			$kodeuser = $_SESSION["kode$jenisuser"];
			
			$sql = "
				select master.$jenisuser.nama$jenisuser 'nama_kantor' from master.login 
				inner join master.$jenisuser
					on login.kode$jenisuser=master.$jenisuser.kode$jenisuser
				where master.$jenisuser.kode$jenisuser = $kodeuser
			";
			$sql = mysql_query($sql);
			$row = mysql_fetch_array($sql);
			$nama_kantor = $row['nama_kantor'];
		}
		else 
			$nama_kantor = "Kantor Induk";
			
		$_SESSION['nama_kantor'] = $nama_kantor;
	}
	
	
	
	$kodelogin = $_SESSION['kodelogin'];
	$kodeapp = !empty($_SESSION['kodeapp']) ? $_SESSION['kodeapp'] : 0;
	$kodegi = !empty($_SESSION['kodegi']) ? $_SESSION['kodegi'] : 0;
	
	$nama_kantor = $_SESSION['nama_kantor'];
	
	function tglindonesia ($thedate) {
		//untuk dapatkan hari yg di posisi 11 sbnyk 2 krktr
		$jam=substr($thedate,11,2);
		//untuk dapatkan hari yg di posisi 14 sbnyk 2 krktr
		$menit=substr($thedate,14,2);
		//untuk dapatkan hari yg di posisi 8 sbnyk 2 krktr
		$hari=substr($thedate,8,2);
		//untuk dapatkan hari yg di posisi 5 sbnyk 2 krktr
		$bulan=get_namabulan(substr($thedate,5,2));
		//untuk dapatkan hari yg di posisi 0 sbnyk 4 krktr
		$tahun=substr($thedate,0,4);
		//pengabungan variabel $hari $bulan $tahun
		$tanggal="$hari $bulan $tahun";
		//fungsi hasil output variabel $tanggal
		return $tanggal;
	}
    	function waktuindo ($thedate) {
		//untuk dapatkan hari yg di posisi 11 sbnyk 2 krktr
		$jam=substr($thedate,11,2);
		//untuk dapatkan hari yg di posisi 14 sbnyk 2 krktr
		$menit=substr($thedate,14,2);
		//untuk dapatkan hari yg di posisi 8 sbnyk 2 krktr
		$hari=substr($thedate,8,2);
		//untuk dapatkan hari yg di posisi 5 sbnyk 2 krktr
		$bulan=get_namabulan(substr($thedate,5,2));
		//untuk dapatkan hari yg di posisi 0 sbnyk 4 krktr
		$tahun=substr($thedate,0,4);
		//pengabungan variabel $hari $bulan $tahun
		$tanggal="$hari $bulan $tahun - $jam:$menit";
		//fungsi hasil output variabel $tanggal
		return $tanggal;
	}
	function ambilbulan ($thedate) {
		$bulan=get_namabulan(substr($thedate,5,2));
		$tanggal="$bulan";
		return $tanggal;
	}
	//konversi angka bulan jadi huruf
	function get_namabulan($bulan) {
		//cek bulan isinya apa?
		switch($bulan) {
		//jika isinya 1 berarti nama bulan januari
			case 1 :
				$namabulan="Januari";
				break;
			case 2 :
				$namabulan="Februari";
				break;
			case 3 :
				$namabulan="Maret";
				break;
			case 4 :
				$namabulan="April";
				break;
			case 5 :
				$namabulan="Mei";
				break;
			case 6 :
				$namabulan="Juni";
				break;
			case 7 :
				$namabulan="Juli";
				break;
			case 8 :
				$namabulan="Agustus";
				break;
			case 9 :
				$namabulan="September";
				break;
			case 10 :
				$namabulan="Oktober";
				break;
			case 11 :
				$namabulan="November";
				break;
			case 12 :
				$namabulan="Desember";
				break;
		}
		return $namabulan;
	}
 
	function get_tanggalsekarang($selection) {
		date_default_timezone_set('Asia/Jakarta'); // set standar waktu jakarta
		$thedate=getdate();
		$years=$thedate["year"];	
		$months=$thedate["mon"];
		$days=$thedate["mday"];
		$hours=$thedate["hours"];
		$minutes=$thedate["minutes"];
		$seconds=$thedate["seconds"];
		
		switch ($selection) {
			case "year" :
				return $years;
				break;
			case "month" :
				return $months;
				break;
			case "day" :
				return $days;
				break;
			case "hour" :
				return $hours;
				break;
			case "minute" :
				return $minutes;
				break;
			case "second" :
				return $seconds;
				break;	
		}
	}

	function format_tgl($tgl) {
		$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
		return $tgl_ind;
	}
	
	function tglformataction($tgl){
		$thn=substr($tgl,6,4);
		$bulan=substr($tgl,3,2);
		$hari=substr($tgl,0,2);
		$tanggal = "$thn-$bulan-$hari";
		return $tanggal;
	}
	
	function ubahtgl($tgl){
		$tgl = explode('/', $tgl);
		$tgl = "$tgl[2]/$tgl[1]/$tgl[0]";
		
		return $tgl;
	}

	function thumbnail($src, $dist, $dis_width = 100 ){
		$img = '';
		$extension = strtolower(strrchr($src, '.'));
		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				$img = @imagecreatefromjpeg($src);
				break;
			case '.gif':
				$img = @imagecreatefromgif($src);
				break;
			case '.png':
				$img = @imagecreatefrompng($src);
				break;
		}
		$width = imagesx($img);
		$height = imagesy($img);




		$dis_height = $dis_width * ($height / $width);

		$new_image = imagecreatetruecolor($dis_width, $dis_height);
		imagecopyresampled($new_image, $img, 0, 0, 0, 0, $dis_width, $dis_height, $width, $height);


		$imageQuality = 100;

		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				if (imagetypes() & IMG_JPG) {
					imagejpeg($new_image, $dist, $imageQuality);
				}
				break;

			case '.gif':
				if (imagetypes() & IMG_GIF) {
					imagegif($new_image, $dist);
				}
				break;

			case '.png':
				$scaleQuality = round(($imageQuality/100) * 9);
				$invertScaleQuality = 9 - $scaleQuality;

				if (imagetypes() & IMG_PNG) {
					imagepng($new_image, $dist, $invertScaleQuality);
				}
				break;
		}
		imagedestroy($new_image);
	}
	
	
	
	
	
	function multiple_query($sql) {
		$data = array();
		
		foreach($sql as $key=>$sql2) {
			$sql2 = mysql_query($sql2);
			while($row = mysql_fetch_array($sql2)) {
				$data[$key][] = $row;
			}
		}
		
		return $data;
	}
	
	
	function update() {
		$arg = func_get_args();
		
		$nama_table = $arg[0];
		$id = $arg[1];
		$pk = $arg[2];
		$header = $arg[3];
		$POST = $arg[4];
		$kolom_table = $arg[5];
		
		$kodeapp = $_SESSION['kodeapp'];
		$jenisuser = strtoupper($_SESSION['jenisuser']);
		
		$table_array = ['alat', 'lokasi', 'pengisian', 'pemeliharaan'];
		
		
		
		$data = array();
		foreach($POST as $key=>$p) {
			if($p != 'submit') {				
				foreach($kolom_table as $kota) {
					if(in_array($key, $kota)) {
						if($kota['Tipe'] == 'date') {
							$p = explode('/', $p);
							$p = "$p[2]/$p[1]/$p[0]";
						}
					}
				}
				
				if($key == 'tgl_update')
					$data[$key] = "now()";
				else
					$data[$key] = $p;
			}
		}
		
		
		
		if(in_array($nama_table, $table_array)) {
			$FILES = $arg[6];
			
			//var_dump($FILES);
			
			if(!empty($FILES)) {
				foreach($FILES as $key=>$f) {
					if(!empty($f['name']))
						$data[$key] = $f['name'];
					else
						$data[$key] = $data[$key."_cadangan"];
					
					
					//var_dump($data[$key]); die();
					
					unset($data[$key."_cadangan"]);
					
					if(ucwords($nama_table) == 'Pengisian') {
						if(!empty($POST['Kode_alat']) && empty($POST['kode_pengisian']))
							$sql = "select lantai, no_alat, penempatan, id_alat 'kode_alat' from alat where id_alat = $POST[Kode_alat]";
						else if(empty($POST['Kode_alat']) && !empty($POST['kode_pengisian']))
							$sql = "select lantai, no_alat, penempatan, kode_alat from pengisian inner join alat on pengisian.kode_alat=alat.id_alat where kode_pengisian = $POST[kode_pengisian]";
						
						//echo $sql;
						$sql = mysql_query($sql);
						$row_alat = mysql_fetch_array($sql);
						//var_dump($row_alat);
					}
					else if(ucwords($nama_table) == 'Pemeliharaan') {
						$sql = "select lantai, no_alat, penempatan, kode_alat, foto_tacometer from pengisian inner join alat on pengisian.kode_alat=alat.id_alat where kode_pengisian = $POST[kode_pengisian]";
						
						//echo $sql;
						$sql = mysql_query($sql);
						$row_alat = mysql_fetch_array($sql);
						//var_dump($row_alat);
					}
					
					
					$id_alat = !empty($row_alat) ? $row_alat['kode_alat'] : null;
					$id_alat = !empty($POST['Kode_alat']) ? $POST['Kode_alat'] : $id_alat;
					
					if(empty($id_alat)) {
						$sql = "select id_alat from alat order by id_alat desc";
						$hasil = mysql_query($sql);
						
						if(mysql_num_rows($hasil) > 0) {
							$id_alat = 1;
						}
						else {
							$row = mysql_fetch_array($hasil);
							$id_alat = $row['id_alat'];
						}
					}
					
					$id_alat = !empty($id_alat) ? "-$id_alat" : null;
					
					if(!empty($row_alat)) {
						
						$lantai_alat = $row_alat['lantai'];
						$no_alat_alat = $row_alat['no_alat'];
						$penempatan_alat_alat = $row_alat['penempatan'];
					}
					else if(!empty($POST['lantai'])) {
						// else if ini khusus buat menu alat
						
						$lantai_alat = $POST['lantai'];
						$no_alat_alat = $POST['no_alat'];
						$penempatan_alat_alat = $POST['penempatan'];
					}
					
					
					
					$lokasi = $key == 'gambar_alat' ? "alat" : "Lokasi_Alat";
					$lokasi = $key == 'foto_tacometer' ? "Tacometer" : $lokasi;
					$lokasi = $key == 'foto_stiker' ? "Stiker" : $lokasi;
					//$lokasi = $nama_table == 'alat' ? "alat" : "Lokasi_Alat";
					
					
					if(!empty($f['name'])) {
						$filename=$f['name'];
					}
					else {
						$filename=$data[$key];
					}

					$extension=end(explode(".", $filename));
					//$newfilename="$lokasi Lantai $lantai_alat - $no_alat_alat - $penempatan_alat_alat $id_alat".".".$extension;
					$newfilename = $lokasi."-$jenisuser-Lantai $lantai_alat-$no_alat_alat-$penempatan_alat_alat$id_alat".".".$extension;
				
					//$lokasi = "images/$lokasi/$f[name]";
					$lokasi = "images/$lokasi/$newfilename";
					
					
					$data[$key] = "$newfilename";
					//var_dump($f);
					
					move_uploaded_file($f['tmp_name'], "$lokasi");
				}
			}
			else {
				foreach($data as $key=>$p) {
					$cek_kolom = strpos($key, "_cadangan");
					//echo "$cek_kolom = strpos($key, \"_cadangan\") <br>";
					
					if($cek_kolom !== false) {
						unset($data[$key]);
					}
				}
			}
		}
		
		//var_dump($data);
		
		$data = count($data) > 0 ? implode(', ', array_map(
			function ($v, $k) {				
				if(is_array($v)){
					return $k.'[]='.implode('&'.$k.'[]=', $v);
				}else{
					if($v != 'now()')
						return $k."='".$v."'";
					else
						return $k."=".$v."";					
				}
			}, 
			$data, 
			array_keys($data)
		)) : false;
		
		
		
		
		if($nama_table != 'pemeliharaan')
			$sql = "update $nama_table set $data where $pk = $id";		
		else if($nama_table == 'pemeliharaan') {
			$sql = "update $nama_table set $data where kode_pemeliharaan = $id";		
		}
		
		//echo $sql;
		mysql_query($sql);
		
		header("location:$header&&pesan=berhasil");
		die();
	}
	
	
	function cari() {
		$arg = func_get_args();
		
		$POST = $arg[0];
		$menu = $arg[1];
		$header = $arg[2];
		$level = $_SESSION['jenisuser'];
		
		
		if($level == 'ki') {
			$sql = "select count(*) 'jumlah' from master.app inner join master.gi on master.app.kodeapp=master.gi.kodeapp where master.app.kodeapp = $POST[kodeapp] AND kodegi = $POST[kodegi]";
		}
		if($level == 'app') {
			$sql = "select count(*) 'jumlah' from master.gi where kodegi = $POST[kodegi]";
		}
		
		$query = mysql_query($sql);
		$jumlah = mysql_fetch_array($query);
		
		if($jumlah['jumlah'] <= 0) {
			$header = $menu."_lihat";
		}
		
		echo $header;
		
		
		
		die();
		header("location:$header&&pesan=berhasil");
	}
	
	
	function insert() {
		$arg = func_get_args();
		
		$nama_table = $arg[0];
		$header = $arg[1];
		$POST = $arg[2];
		$kolom_table = $arg[3];
		
		//var_dump($POST); die();
		
		$kodeapp = $_SESSION['kodeapp'];
		$jenisuser = $_SESSION['jenisuser'];
		
		if($jenisuser != 'ki') {
			$kodeuser = $_SESSION["kode$jenisuser"];
			
			$sql = "
				select master.$jenisuser.nama$jenisuser 'nama_kantor' from master.login 
				inner join master.$jenisuser
					on login.kode$jenisuser=master.$jenisuser.kode$jenisuser
				where master.$jenisuser.kode$jenisuser = $kodeuser
			";
			$sql = mysql_query($sql);
			$row = mysql_fetch_array($sql);
			$nama_kantor = $row['nama_kantor'];
		}
		else 
			$nama_kantor = "Kantor Induk";
		
		
		
		$jenisuser = strtoupper($jenisuser);
		
		
		$table_array = ['Alat', 'Lokasi', 'Pengisian', 'Pemeliharaan'];
		
		$data = array();
		foreach($POST as $key=>$p) {
			if($p != 'submit') {
				foreach($kolom_table as $kota) {
					if(in_array($key, $kota)) {
						if($kota['Tipe'] == 'date') {
							if(!empty($p)) {
								$p = explode('/', $p);
								$p = "$p[2]/$p[1]/$p[0]";
								//$p = date('Y/m/d', strtotime($p));
							}
							else {
								$p="0000-00-00";
							}
						}
					}
				}
				
				$data[$key] = "'$p'";
			}
		}
		
		
		
	
		
		if(in_array($nama_table, $table_array)) {
			$FILES = $arg[4];
			
			//var_dump($FILES);
			
			foreach($FILES as $key=>$f) {
				$id_alat = !empty($POST['No_alat']) ? $POST['no_alat'] : null;
				$id_alat = !empty($POST['kode_pengisian']) ? $POST['kode_pengisian'] : $id_alat;
				$id_alat = !empty($POST['Kode_alat']) ? $POST['Kode_alat'] : $id_alat;
				
				if(empty($id_alat)) {
					$sql = "select id_alat from alat order by id_alat desc";
					$hasil = mysql_query($sql);
					
					if(mysql_num_rows($hasil) > 0) {
						$id_alat = 1;
					}
					else {
						$row = mysql_fetch_array($hasil);
						$id_alat = $row['id_alat'];
					}
				}
				
				//var_dump($id_alat);
				
				if($nama_table == 'Pengisian') {
					$sql = "select * from alat where id_alat = $id_alat";
					$sql = mysql_query($sql);
					$row_alat = mysql_fetch_array($sql);
				}
				else if($nama_table == 'Pemeliharaan') {
					$sql = "
						select alat.*, pengisian.kode_pengisian from alat 
						inner join pengisian
							on pengisian.kode_alat=alat.id_alat
						where kode_pengisian = $id_alat
					";
					$sql = mysql_query($sql);
					$row_alat = mysql_fetch_array($sql);
					
					$sql2 = "select * from pemeliharaan order by kode_pemeliharaan desc";
					$sql2 = mysql_query($sql2);
					
					if(mysql_num_rows($sql2) < 1)
						$kode_pemeliharaan = 1;
					else {
						$row_alat2 = mysql_fetch_array($sql2);
						$kode_pemeliharaan = $row_alat2['kode_pemeliharaan'];
					}
					
					$id_alat = "$id_alat-Pengisian $row_alat[kode_pengisian]-Pemeliharaan $kode_pemeliharaan";
				}
				
				if(!empty($row_alat)) {
					$lantai_alat = $row_alat['lantai'];
					$no_alat_alat = $row_alat['no_alat'];
					$penempatan_alat_alat = $row_alat['penempatan'];
				}
				else if(!empty($POST['lantai'])) {
					// else if ini khusus buat menu alat
					
					$lantai_alat = $POST['lantai'];
					$no_alat_alat = $POST['no_alat'];
					$penempatan_alat_alat = $POST['penempatan'];
				}
				
				$id_alat = !empty($id_alat) ? "-$id_alat" : null;
				
				$lokasi = $key == 'gambar_alat' ? "alat" : "Lokasi_Alat";
				$lokasi = $key == 'foto_tacometer' ? "Tacometer" : $lokasi;
				$lokasi = $key == 'foto_stiker' ? "Stiker" : $lokasi;
				
				//$id_alat = !empty($POST['Kode_alat']) ? "- ".$POST['Kode_alat'] : null;
				
				$filename=$f["name"];
				$extension=end(explode(".", $filename));
				$newfilename = $lokasi."-$jenisuser-$nama_kantor-Lantai $lantai_alat-$no_alat_alat-$penempatan_alat_alat$id_alat".".".$extension;
				
				
				//$lokasi = "images/$lokasi/$f[name]";
				$lokasi = "images/$lokasi/$newfilename";
				
				$data[$key] = "'$newfilename'";
				
				move_uploaded_file($f['tmp_name'], "$lokasi");
			}
		}
		
		//var_dump($data);
		
		
		$_SESSION['data'] = $data;
		
		$kolomnyah = array_keys($data);
		
		$data = implode(', ', $data);
		
		$kolomnyah = implode(', ', $kolomnyah);
		
		
		$sql = "insert into $nama_table($kolomnyah) values($data)";
		mysql_query($sql);
		
		header("location:$header&&pesan=berhasil");
		die();
	}
	
	
	function delete() {
		$arg = func_get_args();
		
		$nama_table = $arg[0];
		$pk = $arg[1];
		$id = $arg[2];
		
		echo $sql = "delete from $nama_table where $pk = $id";
		die();
		mysql_query($sql);
	}
	
	
	function information_schema() {
		$arg = func_get_args();
		$nama_table = $arg[0];
		$klausa = '';
		
		//$table_schema = $nama_table == 'app' || $nama_table == 'gi' ? 'master' : 'alat';
		
		$q = "
			SELECT 
				Column_Name 'Kolom',
				Column_Type 'Nilai_Kolom',
				Data_Type 'Tipe',
				Column_Comment 'Komen'
			FROM INFORMATION_SCHEMA.COLUMNS 
			WHERE 
				TABLE_SCHEMA = 'FIRE_PROTECTION' AND 
				TABLE_NAME = '$nama_table'
		";
		
		$sql = mysql_query($q);
		
		$data = array();
		while($row = mysql_fetch_array($sql)) {
			$data[] = array(
				'Kolom'=>$row['Kolom'],
				'Nilai_Kolom'=>$row['Nilai_Kolom'],
				'Tipe'=>$row['Tipe'],
				'Komen'=>$row['Komen']
			);
		}
		
		return $data;
	}
	
	
	function ucwords_kolom_table() {
		$arg = func_get_args();
		$kolom = $arg[0];
		
		$kolom = explode('_', $kolom);
		
		
		if(is_array($kolom)) {
			$kolom = array_map('ucwords', $kolom);
			$return = implode(' ', $kolom);
		}
		else {
			$return = ucwords($kolom);
		}
		
		return $return;
	}
	
	
	function cari_ukuran($cari) {
	   $array = [
			'Kg'=>[
				'berat',
				'penimbangan'				
			],
			'mm'=>[
				'diameter',
				'tinggi'
			],
			'bar'=>[
				'tekanan_kerja',
				'tekanan_uji'
			],
			'detik'=>[
				'waktu_semprot'
			],
			'meter'=>[
				'jarak_semprot'
			],
			'&#8451;'=>[
				'temperatur'
			]
		];
	   
		foreach ($array as $key => $val) {
		   foreach ($val as $key2 => $val2) {
			   if ($val2 == $cari) {
				   return $key;
			   }
		   }
		}
	   
	   return false;
	}
	
	
	function tampil_kolom_table() {
		$arg = func_get_args();
		$kolom_table = $arg[0];
		
		foreach($kolom_table as $kol) {
			$cek_gambar = strpos($kol['Komen'], 'penting');
			$cek_primary = strpos($kol['Komen'], 'primary');
			
			if($cek_gambar !== false) {
				$kolom = $kol['Kolom'];
				
				$kolom = alias_kolom_fk($kolom, $cek_primary);
				
				$kolom = label_khusus($kolom);

				echo "<th style='text-align:center; vertical-align: middle;'>$kolom</th>";
			}
		}	
	}
	
	
	function label_khusus() {
		$arg = func_get_args();
		$kolom = $arg[0];
		//echo "kolomnyah $kolom";
		
		$key = cari_ukuran($kolom);
		$kolom = ucwords_kolom_table($kolom);
		
		if($key) {
			$kolom = "$kolom ($key)";
		}
		
		return $kolom;
	}
	
	
	function tampil_kolom_isitable() {
		$arg = func_get_args();
		$fungsi = $arg[0];
		$kol = $arg[1];
		$tipe = $arg[2];
		$nama_table = $arg[3];
		
		
		if($fungsi == 'tambah') {
			if($tipe != 'datetime') {
				if($kol == 'gambar')
					return "<input type='file' name='$kol.[]' />";
				else {
					return "<input type='text' name='$kol' />";				
				}
			}
			else {
				return "<input type='text' name='$kol' class='mulai' />";			
			}
		}
		else {
			$row = $arg[4];
			$cek_fk = $arg[5];
			
			//echo $kol.' - ';
			
			if($cek_fk === false) {			
				if($kol == 'gambar_alat' && $nama_table == 'alat')
					return "<img width='150px' height='150px' src='http://localhost/Mon_alat/images/alat/".$row[$kol]."' >";
				else if($kol == 'foto_lokasi' && $nama_table == 'alat')
					return "<img width='150px' height='150px' src='http://localhost/Mon_alat/images/Lokasi_Alat/".$row[$kol]."' >";
				else {
					if($tipe == 'date')
						return date('d-m-Y', strtotime($row[$kol]));
					else {
						return $row[$kol];
					}
				}
			}
			else {
				if($kol == 'kode_alat')
					return $row['as_nalat'];
				else
					return $kol;
			}
		}
	}
	
	
	function ambil_pk() {
		$arg = func_get_args();
		$nama_table = $arg[0];
		
		$sql = "SHOW keys FROM $nama_table WHERE Key_name = 'PRIMARY'";
		$sql = mysql_query($sql);
		$sql = mysql_fetch_array($sql);
		return $sql['Column_name'];
	}
	
	
	function alias_kolom_fk() {
		$arg = func_get_args();
		$fk = $arg[0];
		$cek_primary = $arg[1];
		
		//echo "fk=$fk, cek_primary=$cek_primary || ";
		
		$jenisuser = strtoupper($_SESSION['jenisuser']);
		
		$daftar = [
			"kode_kantor"=>"Nama $jenisuser",
			"id_alat"=>"alat",
			"kode_alat"=>"alat",
			"kode_gi"=>"Nama GI",
			"kode_pengisian"=>"Kode Pengisian",
			"id_hak_akses"=>"Hak Akses",
			"id_jenis_api"=>"Jenis Api",
			"id_lks"=>"Lokasi",
			"id_merk"=>"Merk",
			"id_pml"=>"Pemeliharaan",
			"id_pmk"=>"Pemakaian"			
		];
		
		/* if(isset($daftar[$fk]))
		echo "ini dia ".$daftar[$fk]; 
	
		if(isset($daftar[$fk]) && $cek_primary === false)
			echo "";*/
		
		if(isset($daftar[$fk]) && $cek_primary === false)
			return $daftar[$fk];
		else 
			return $fk;
	}
	
	
	function lihat_peta() {
		$arg = func_get_args();
		$nama_table = $arg[0];
		$row = $arg[1];
		$objek = $arg[2];
		
		//var_dump($row); 
		
		
		
		if(
			$nama_table == 'Alat' || 
			$nama_table == 'Pengisian' ||			
			$nama_table == 'Pemeliharaan' 
		) {
			if($objek == 'alat') {
				$gambar = $row["gambar_alat"] == "" ? "images/foto/no-images.png" : "images/alat/".$row["gambar_alat"];
				$nama_gambar = $row["gambar_alat"];				
			}
			else if($objek == 'lokasi') {
				$gambar = $row["foto_lokasi"] == "" ? "images/foto/no-images.png" : "images/Lokasi_Alat/".$row["foto_lokasi"];
				$nama_gambar = $row["foto_lokasi"];
			}
			else if($objek == 'tacometer') {
				$gambar = $row["foto_tacometer"] == "" ? "images/foto/no-images.png" : "images/Tacometer/".$row["foto_tacometer"];
				$nama_gambar = $row["foto_tacometer"];
			}
			else if($objek == 'stiker') {
				$gambar = $row["foto_stiker"] == "" ? "images/foto/no-images.png" : "images/Stiker/".$row["foto_stiker"];
				$nama_gambar = $row["foto_stiker"];
			}
			else {
				$gambar = "images/foto/no-images.png";
				$nama_gambar = "no-images.png";
			}
		}
		else {
			$gambar = "images/foto/no-images.png";
			$nama_gambar = "no-images.png";
		}
		
		
		$array = [$gambar, $nama_gambar];
		
		return $array;
	}
	
	function ambil_nama_table_dari_querystring() {
		$arg = func_get_args();
		
		$arg_value = $arg[1];
		$arg = $arg[0][0];
		
		$cek = strpos($arg, '_');
		
		if($cek !== false)
			$arg = explode('_', $arg);
		
		if(is_array($arg)) {
			$arg = array_map('strtolower', $arg);
			
			if(count($arg) == 3 && isset($arg[2])) {
				$querystring = "$arg[0]_$arg[1]";
				$aksinyah = $arg[(count($arg)-1)];
			}
			else if(count($arg) > 3 && isset($arg[2])) {
				$querystring = "$arg[0]_$arg[1]";
				
				$arg2 = $arg;
				unset($arg2[0]);
				unset($arg2[1]);
				$arg2 = implode('_', $arg2);
				
				$aksinyah = $arg2;
			}
			else {
				$querystring = $arg[0];
				$aksinyah = $arg[1];
			}
		}
		else {
			$querystring = $arg;
		}
		
		$return = null;
		
		
		if($querystring != 'dashboard')
			$return = $querystring;		
		else 			
			$return = $querystring;			
		
		
		$aksinyah = isset($aksinyah) ? $aksinyah : null;
		
		$ret = [
			'querystring'=>ucwords($return),
			'aksinyah'=>$aksinyah,
			'value'=>$arg_value
		];
		
		return $ret;
	}
	
	
	function multiple_query_form_update() {
		$arg = func_get_args();		
		$nama_table = $arg[0];
		
		$kodeapp = $_SESSION['kodeapp'];
		$jenisuser = $_SESSION['jenisuser'];
		
		$kode_kantor = $_SESSION["kode$jenisuser"];
		
		$klausa = '';
		
		$q = array();
		if($nama_table == 'alat') {
			
			/* if($jenisuser == 'gi')
				$q["kode_kantorx"] = "
					select master.$jenisuser.kodegi 'id', master.$jenisuser.namagi 'val' from master.$jenisuser
					where master.$jenisuser.kodeapp = $kodeapp
					order by val asc
				";
			 */
			
			$q = [
				"id_merk"=>"select id_merk 'id', merk 'val' from Merk",
				"kode_kantor"=>"
					select master.$jenisuser.kode$jenisuser 'id', master.$jenisuser.nama$jenisuser 'val' from master.$jenisuser
					where master.$jenisuser.kode_kantor = $kodeapp
					order by val asc
				",
				"id_jenis_api"=>"select id_jenis_api 'id', jenis_api 'val' from Jenis_Api"
			];
		}
		else if($nama_table == 'lokasi') {
			$q = [
				"kodegi"=>"select kodegi 'id', namagi 'val' from master.GI",
				"id_alat"=>"select id_alat 'id', concat(tipe, ' - ', model) 'val' from alat"
			];
		}
		else if($nama_table == 'pengisian') {
			$q = [
				"kode_alat"=>"
					select id_alat 'id', concat('Lantai ', lantai, ' / ', no_alat, ' / ', penempatan) 'val' from alat 
					where
						kantor = '$jenisuser' AND
						kode_kantor = $kode_kantor
				"
			];
		}
		else if($nama_table == 'pemeliharaan') {
			$q = [
				"kode_pengisian"=>"select kode_pengisian 'id', concat(kode_pengisian) 'val' from pengisian"
			];
		}
		else if($nama_table == 'pemakaian') {
			$q = [
				"kode_gi"=>"select kodegi 'id', namagi 'val' from master.GI",
				"id_merk"=>"select id_merk 'id', merk 'val' from Merk",
				"kode_alat"=>"
					select id_alat 'id', concat('Lantai ', lantai, ' / ', no_alat, ' / ', penempatan) 'val' from alat 
					where
						kantor = '$jenisuser' AND
						kode_kantor = $kode_kantor
				",
				"id_jenis_api"=>"select id_jenis_api 'id', jenis_api 'val' from Jenis_Api"			
			];
		}
		
		return $q;
	}
	
	
	function kumpulan_query_tampil_dibaris_awal() {
		$arg = func_get_args();		
		$pk = $arg[0];
		$nama_table = $arg[1];
		
		$kodeapp = $_SESSION['kodeapp'];
		$jenisuser = $_SESSION['jenisuser'];
		
		
		$kode_kantor = $_SESSION["kode$jenisuser"];
		
		$q = array();
		if($nama_table == 'Alat') {
			//$klausa = '';
			$innerjoin = '';
			$klausa = "where kantor = '$jenisuser' AND kode_kantor = $kode_kantor";
			
			if(!empty($arg[2]['tglawal'])) {
				$tgl = $arg[2];
				$klausa .= " AND pengisian_awal between '".ubahtgl($tgl['tglawal'])."' AND '".ubahtgl($tgl['tglakhir'])."'";
			}
			
			
			$q = "
				select 
					$nama_table.*, 
					$pk 'id', 
					concat(merk, '___', jenis_api) 'fk' from $nama_table 
				inner join merk 
					on $nama_table.id_merk=merk.id_merk 
				inner join jenis_api 
					on $nama_table.id_jenis_api=jenis_api.id_jenis_api
				$klausa 
				order by $pk desc 
			";
		}
		else if($nama_table == 'Pengisian') {
			$klausa = "where kantor = '$jenisuser' AND kode_kantor = $kode_kantor";
			if(!empty($arg[2]['tglawal'])) {
				$tgl = $arg[2];
				$klausa .= " AND tgl_pengisian_terakhir between '".ubahtgl($tgl['tglawal'])."' AND '".ubahtgl($tgl['tglakhir'])."'";
			}
			
			/* if(empty($arg[2]['tglawal'])) {
				//$kode_pengisian = $arg[2];
				//$klausa = "where pengisian.kode_pengisian = $kode_pengisian";
				$klausa = "";
			}
			else 
				$klausa = "where kantor = '$jenisuser' AND kode_kantor = $kode_kantor";
			else {
				$tgl = $arg[2];
				$klausa = "where tgl_pengisian_terakhir between '".ubahtgl($tgl['tglawal'])."' AND '".ubahtgl($tgl['tglakhir'])."'";
			} */
			
			//var_dump($arg);
			
			$q = "
				select 
					concat('Lantai', lantai, ' / ', no_alat, ' / ', penempatan) 'as_nalat', tgl_pengisian_terakhir, tgl_pengisian_kembali, catatan, alat.gambar_alat, $pk 'id', alat.id_alat 'fk' from $nama_table 
				inner join alat 
					on $nama_table.kode_alat=alat.id_alat 
				$klausa 
				order by $pk desc 
			";
			/* $q = "
				SELECT
				alat.pengisian.kode_pengisian,
				alat.alat.id_alat,
				alat.pengisian.tgl_pengisian_terakhir,
				alat.pengisian.tgl_pengisian_kembali,
				alat.pengisian.catatan,
				alat.pemeliharaan.indikator,
				alat.pemeliharaan.tgl_pemeliharaan,
				$pk 'id', alat.id_alat 'fk',
				`master`.gi.namagi,
				`master`.app.namaapp
				FROM
				alat.pemeliharaan
				INNER JOIN alat.pengisian ON alat.pengisian.kode_pengisian = alat.pemeliharaan.kode_pengisian
				INNER JOIN alat.alat ON alat.alat.id_alat = alat.pengisian.kode_alat
				INNER JOIN `master`.gi ON alat.alat.kode_gi = `master`.gi.kodegi
				INNER JOIN `master`.app ON `master`.app.kodeapp = `master`.gi.kodeapp
				$klausa
				order by $pk desc 
			"; */
		}
		else if($nama_table == 'Pemeliharaan') {
			/* if(empty($arg[2]['tglawal'])) {
				//$kode_pengisian = $arg[2];
				//$klausa = "where pengisian.kode_pengisian = $kode_pengisian";
				$klausa = "";
			}
			else {
				$tgl = $arg[2];
				$klausa = "where tgl_pemeliharaan between '".ubahtgl($tgl['tglawal'])."' AND '".ubahtgl($tgl['tglakhir'])."'";
			} */
			$klausa = "where kantor = '$jenisuser' AND kode_kantor = $kode_kantor";
			
			$q = "select $nama_table.*, alat.no_alat, alat.penempatan, Jenis_Api.jenis_api, Pengisian.tgl_pengisian_terakhir, $pk 'id', Pengisian.Kode_Pengisian 'fk' from $nama_table inner join Pengisian on $nama_table.Kode_Pengisian=Pengisian.Kode_Pengisian inner join alat on Pengisian.Kode_alat=alat.id_alat inner join Jenis_Api on alat.id_jenis_api=Jenis_Api.id_jenis_api $klausa order by $pk desc ";
		}
		else if($nama_table == 'Pemakaian') {
			$klausa = "where kantor = '$jenisuser' AND kode_kantor = $kode_kantor";
			$q = "select $nama_table.*, $pk 'id', alat.id_alat 'fk' from $nama_table inner join alat on $nama_table.kode_alat=alat.id_alat $klausa order by $pk desc ";			
		}
		else if($nama_table == 'Dashboard') {
			$q['3bulan'] = "
				select alat.no_alat, alat.penempatan, concat(namaapp, ' - ', namagi) 'unit', tgl_pengisian_terakhir from `master`.app 
				inner join `master`.gi
					on `master`.app.kodeapp=`master`.gi.kodeapp
				inner join alat.alat
					on alat.alat.kode_gi=`master`.gi.kodegi
				inner join alat.pengisian
					on alat.pengisian.kode_alat=`alat`.alat.id_alat
				where tgl_pengisian_terakhir <= now()-interval 3 month
			";
			$q['1bulan'] = "select alat.no_alat, alat.penempatan, tgl_pengisian_terakhir, $pk 'id', alat.id_alat 'fk' from alat inner join Pengisian on Pengisian.kode_alat=alat.id_alat where tgl_pengisian_terakhir <= now()-interval 1 month order by $pk desc ";			
			$q['1minggu'] = "select alat.no_alat, alat.penempatan, tgl_pengisian_terakhir, $pk 'id', alat.id_alat 'fk' from alat inner join Pengisian on Pengisian.kode_alat=alat.id_alat where tgl_pengisian_terakhir <= now()-interval 1 week order by $pk desc ";			
			$q['cari_kodeapp'] = "select `master`.app.kodeapp, `master`.app.namaapp from `master`.app";
		}
		
		
		return $q;
	}
	
	
	
?>