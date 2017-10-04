<?php
include("mpdf.php");
$kodepelanggan=$_GET['kodepelanggan'];
$tgl=$_GET['tgl'];

$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 

$mpdf->SetDisplayMode(90);

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
$url = "http://localhost/pos/form/mpdf/invoicebayar.php?kodepelanggan=$kodepelanggan&tgl=$tgl";
 $html = file_get_contents($url);

 $mpdf->WriteHTML($html);
	    
$mpdf->Output();
?>
