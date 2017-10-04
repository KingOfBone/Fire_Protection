<?php
if(isset($_POST["submit"])){
$file_name      = $_FILES["image"]["name"];
$fn = $_FILES['image']['tmp_name'];
$Path           = "images/foto/";
    
    move_uploaded_file($fn,$Path.$file_name);
    
$size = getimagesize($fn);
$ratio = $size[0]/$size[1]; // width/height
if( $ratio > 1) {
    $width = 500;
    $height = 500/$ratio;
}
else {
    $width = 500*$ratio;
    $height = 500;
}
$src = imagecreatefromstring(file_get_contents($fn));
$dst = imagecreatetruecolor($width,$height);
imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
imagedestroy($src);
imagepng($dst,$target_filename_here); // adjust format as needed
imagedestroy($dst);
header("Location : show.php?sukses");
}
if(isset($_GET["sukses"])){
    echo "sukses om";
    
}
?>
<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="image" /><button name="submit" type="submit">Simpan</button>
</form>