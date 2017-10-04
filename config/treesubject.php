<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Menu Vertikal</title>


<script language="javascript">
function cek(txtVal,txtVa2)
 {
	try
		{
			parent.window.document.uploadvideo.subject.value = txtVal;
			parent.window.document.uploadvideo.kodesubject.value = txtVa2;
			}
		catch(en){}
		parent.window.fdsubject.hide();

	}

	</script>
    
    
<script type="text/javascript" 
        src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" 
        src="js/jquery.treeview.js"></script> 
        <link rel="stylesheet" type="text/css" href="../assets/css/custom.css" />
        <!--    
        <link rel="stylesheet" href="../assets/css/bootstrap.css"/>                 

-->  
<script type="text/javascript">
   $(document).ready(function() {
      $("#menu-tree").treeview();
   });
</script>  
     
</head>
<body>
 
	<?php
	include "../config/koneksi.php";
	?>
	
	<?php
 
	function get_menu($data, $parent = 0) {
	 static $i = 1;
	 $tab = str_repeat(" ", $i);
	 if (isset($data[$parent])) {
	 $html = "$tab<ul id='menu-tree'>";
	 $i++;
	 foreach ($data[$parent] as $v) {
	 $child = get_menu($data, $v->kodesubject);
	 $html .= "$tab<li >";
	// $html .= '<input type="radio" name="txtRadio" onClick="cek(\''.$v->subject.'\','.$v->kodesubject.')" />'.$v->subject.'';
	// $html .= '<input type="radio" name="txtRadio" onclick="cek(\'4u44,333\')" />'.$v->subject.'';
	if ($v->linkaktif=="1") {
		 $html .= ' <a href="#" class="nav1" onClick="cek(\''.$v->subject.'\','.$v->kodesubject.')" >'.$v->subject.'</a>';
	
	} else {
	 $html .= '<font style="font-size:12px;"><b>'. $v->subject.'</b></font>';
		
	}
	
	
	 if ($child) {
	 $i--;
	 $html .= $child;
	 $html .= "$tab";
	 }
	 $html .= '</li>';
	 }
	 $html .= "$tab</ul>";
	 return $html;
	 }
	 else {
	 return false;
	 }
	 }
	 
	?>

	<?php 
	
	  $sql = "SELECT * FROM subject";
	 $qry = mysql_query($sql, $koneksimysql) or die (mysql_error());

	while ($row = mysql_fetch_object($qry)) {
			   $data[$row->kodeparent][] = $row;
		  }
		  $menu = get_menu($data);
		  echo "$menu"; 
	
	
	?>
 

</body>
</html>
