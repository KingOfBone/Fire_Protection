<?php ob_start(); ?>
<?php

	session_start();

	//include "../../librari/inc.koneksi.php";
	//include "../librari/inc.session.php";
	include "../../librari/inc.librari1.php";
	include "../../config/koneksi.php";
	include "../../config/utility.php";

	$nama_table = ucwords($_GET['table']);

	if ($_GET['act']=='excel') {

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Cache-control: private");
		header("Content-Type: application/vnd.ms-excel; name='excel'");
		header("Content-disposition: attachment; filename=laporan_$nama_table.xls");

	}
	else
	{
	echo '
	<script>

		window.print();

	</script>';
	}

?>

<style type="text/css">
	.style4 {font-family: Arial !important; font-size:18px !important;}
	.style9 {font-family: Arial !important; font-size:12px !important; background-color:#99bbff !important; font-weight:bold !important; text-align:center !important; vertical-align: middle !important; width:auto !important; }
	.style1 {font-family: Arial !important; font-size:12px !important;}
	.style2 {font-family: Arial !important; font-size:12px !important; text-align: center !important; background-color: #ffd9b3 !important;}
	
	table {width:98%; border:2px black solid;}
	th, td {border:2px black solid; text-align:center}
	h1 {text-align:center}
</style>

<title>Laporan <?php echo strtoupper($nama_table); ?></title>
<body>
	<h1>Laporan <?php echo strtoupper($nama_table); ?></h1>
    <?php 
		include("laporan_".$nama_table.".php"); 
	?>
	
</body>
<?php ob_flush();  ?>
