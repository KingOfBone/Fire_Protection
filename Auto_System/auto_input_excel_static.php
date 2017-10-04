<?php
	include '../config/koneksi.php';
	include '../assets/PHPExcel/Classes/PHPExcel/IOFactory.php';
	
	
	//$inputFileName = "". $_FILES["data_kesehatan"]["tmp_name"] ."";
	//$inputFileName = "../Dokumen dari PLN Buah Batu/APAR APP/Bogor 1 sheet.xlsx";
	$inputFileName = "../Dokumen dari PLN Buah Batu/APAR APP/Bogor.xlsx";
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);		
	
	//$worksheet = $objPHPExcel->getAllSheets();
	//$worksheet = $objPHPExcel->getActiveSheet();
	
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheetNbr => $worksheet) {
		//echo 'Worksheet number - ', $worksheetNbr, PHP_EOL;
		$highestRow = $worksheet->getHighestRow();
		$highestColumn = $worksheet->getHighestColumn();
		$highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumn);
		
		$lokasi = '';
		$cek_kolom_lokasi = false;
		
		for($i_highestRow=0; $i_highestRow<=$highestRow; $i_highestRow++) {
			for($i_highestColumn=0; $i_highestColumn<$highestColumn; $i_highestColumn++) {
				$cek_kolom_lokasi = strpos($worksheet->getCellByColumnAndRow($i_highestColumn, $i_highestRow)->getValue(), "LOKASI :");
					
				if($cek_kolom_lokasi !== false) {
					$lokasi = $worksheet->getCellByColumnAndRow($i_highestColumn, $i_highestRow)->getValue();
					$lokasi = explode('LOKASI :', $lokasi);
					$lokasi = trim($lokasi[1]);
					
					break;
				}
			}
			
			if($cek_kolom_lokasi !== false)
				break;
		}
		
		
		for($i_highestRow; $i_highestRow<=$highestRow; $i_highestRow++) {
			$kolom = $worksheet->getCellByColumnAndRow(1, $i_highestRow)->getValue();
			
			if($kolom == 'NO APAR') {
				$i_highestRow += 1;
				
				for($i_highestRow; $i_highestRow<=$highestRow; $i_highestRow++) {
					for($i_highestColumn=0; $i_highestColumn<$highestColumn; $i_highestColumn++) {
						$kolom = $worksheet->getCellByColumnAndRow($i_highestColumn, $i_highestRow)->getValue();				
						
						//echo "kolom=$kolom <br>";
						if($kolom != '' && $i_highestColumn < $highestColumn) {
							echo "if($kolom != '' && $i_highestColumn < $highestColumn) { <br>";
							//echo "kolom=$kolom <br>";
							
						}
							//echo "kolom=$kolom i_highestColumn=$i_highestColumn i_highestRow=$i_highestRow<br>";
					}
				}
			}
			
			/* if($kolom != '')
				echo "kolom=$kolom i_highestColumn=$i_highestColumn i_highestRow=$i_highestRow<br>";
			 */
			
		}
		die();
		
		echo "lokasi = $lokasi <br>";
	
		$division = $worksheet->getCell('A7');
	}
	
	//var_dump($worksheet);
	die();
?>

Berhasil !