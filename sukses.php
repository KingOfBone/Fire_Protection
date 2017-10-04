<?php 
//if(isset($_GET["proses"])){
    
    $to     = $_POST["email"];
    $from   = "admin@kp3.com" ; 
    $subject= "Upload KP3"; 
    $message= "Yth Bapak/Ibu,<br> <br> 
        Password anda terbaru saat ini adalah: <br>
        
        Salam, <br><br>
        Admin KP3"; 
            
         require_once 'config/notifikasi/smtpwork.php'; 
        	if($smtp->SendMessage(
        		$from, $subject,$to,
        		array(
        			$to
        		),
        		array(
        			"From: $from",
        			"To: $to",
        			"Subject: $subject",
        			"Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z")
        		),
        		"$message"))
        		{
        			echo "Message sent to $to OK.\n <br>"; 
        		}
        	else {
        		echo "Cound not send the message to $to.\nError: ".$smtp->error."\n <br>";
           } 
           
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
            <!-- Bootstrap Core CSS -->
    <title>Aplikasi Simpan Pinjam KP3 PLN Pusat</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <style>
    .mks{padding: 20% 0;}
    h1{font-size: 2em;}
    h2{font-size: 1.4em;}
    </style>
    		<script src="assets/js/jquery-2.1.0.js"></script>
            
    		<script>
    			$(document).ready(function(){
    				window.setInterval(function () {
    					var sisawaktu = $("#waktu").html();
    					sisawaktu = eval(sisawaktu);
    					if (sisawaktu == 0) {
    						location.href = "index.php";
    					} else {
    						$("#waktu").html(sisawaktu - 1);
    					}
    				}, 1000);
    			});
    		</script>
    	
    	</head>
    	<body>
            <div class="container">
    		  <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8" >
                    <div class="mks">
                        <img class="img-responsive center-block" src="images/no-images.png" />
                        <h1 class="text-center">Password terbaru anda sudah terkirim ke email.</h1>
                        <h2 class="text-center">Halaman otomatis pindah dalam <span id="waktu" style="color: red;">10</span> detik <br />jika halaman tidak bekerja <a href="index.php">klik disini</a></h2>
                    </div>
                  </div>
                  <div class="col-md-2"></div>
              </div>
            </div>
    	</body>
    </html>
<?php //} ?>