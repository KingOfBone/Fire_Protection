<?php

function resize($src, $dist, $dis_width = 100 ){

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
