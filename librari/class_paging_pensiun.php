<?php
class Paging
{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas)
{
if(empty($_GET[halaman])){
	$posisi=0;
	$_GET[halaman]=1;
}else{
	$posisi = ($_GET[halaman]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas)
{
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last
function navHalaman($halaman_aktif, $jmlhalaman)
{
$link_halaman = "";
//$find2=str_replace(' ','|',$_GET[find2]);
// Link First dan Previous
if ($halaman_aktif > 1)
{
$link_halaman .= " <a style='width: 5.8em !important;' class='page-number clickable'href=$_SERVER[PHP_SELF]?pensiun&keyword=".$_GET["keyword"]."&sort=".$_GET["sort"]."&halaman=1><< First</a> | ";
}

if (($halaman_aktif-1) > 0)
{
$previous = $halaman_aktif-1;
$link_halaman .= " <a style='width: 5.8em !important;' class='page-number clickable'href=$_SERVER[PHP_SELF]?pensiun&keyword=".$_GET["keyword"]."&sort=".$_GET["sort"]."&halaman=$previous>< Previous</a> | ";
}

// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++)
{
    if ((($i >= $halaman_aktif - 3) && ($i <= $halaman_aktif + 3)) || ($i == 1) || ($i == $jmlhalaman)) 
         {   
            if (($showPage == 1) && ($i != 2))  $link_halaman .= "..."; 
            if (($showPage != ($jmlhalaman - 1)) && ($i == $jmlhalaman))  $link_halaman .= "...";
            if ($i == $halaman_aktif) $link_halaman .= " <span class='page-number clickable active'><b>".$i."</b> </span>";
            else $link_halaman .= " <a class='page-number clickable' href='".$_SERVER['PHP_SELF']."?pensiun&keyword=".$_GET["keyword"]."&sort=".$_GET["sort"]."&halaman=".$i."'>".$i."</a> ";
            $showPage = $i;          
         }
/* if ($i == $halaman_aktif)
{
$link_halaman .= "<b>$i</b> | ";
}else{
$link_halaman .= "<a class='page-number clickable' href=$_SERVER[PHP_SELF]?SetoranManual&keyword=".$_GET["keyword"]."&halaman=$i>$i</a> | ";
} */
$link_halaman .= " ";
}

// Link Next dan Last
if ($halaman_aktif < $jmlhalaman)
{
$next=$halaman_aktif+1;
$link_halaman .= " <a style='width: 4.8em !important;' class='page-number clickable'href=$_SERVER[PHP_SELF]?pensiun&keyword=".$_GET["keyword"]."&sort=".$_GET["sort"]."&halaman=$next>Next ></a> ";
}

if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0))
{
$link_halaman .= " |<a style='width: 4.8em !important;' class='page-number clickable' href=$_SERVER[PHP_SELF]?pensiun&keyword=".$_GET["keyword"]."&sort=".$_GET["sort"]."&halaman=$jmlhalaman>Last >></a> ";
}
return $link_halaman;
}
}
?>
