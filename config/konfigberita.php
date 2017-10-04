<?php ob_start(); ?>
<?php

ini_set('display_errors', 'On');

//error_reporting(E_ALL);

// mulai session
//session_start();

if(!isset($_SESSION)) {
	session_start();
}


// setting root server dan web server


// ukuran gambar untuk katalog dan produk  tidak lebih dari 75 pixels
define('MAX_CATEGORY_IMAGE_WIDTH', 500);
define('LIMIT_PRODUCT_WIDTH',     true);

// maksimum lebar gambar produk adalah 300
define('MAX_PRODUCT_IMAGE_WIDTH', 500);

// lebar untuk thumbnail gambar produk
define('THUMBNAIL_WIDTH', 150);

if (!get_magic_quotes_gpc()) {
        if (isset($_POST)) {
                foreach ($_POST as $key => $value) {
                        $_POST[$key] =  trim(addslashes($value));
                }
        }
        if (isset($_GET)) {
                foreach ($_GET as $key => $value) {
                        $_GET[$key] = trim(addslashes($value));
                }
        }
}



?>
<?php ob_flush();  ?>