
<?php 

 include "../config/koneksi.php";
    $sql  = "SELECT * FROM subject  WHERE kodesubject='40'";
	$qry  = mysql_query($sql, $koneksimysql) or die ("Gagal sql kategori");
	$data = mysql_fetch_array($qry);
 
 $like = explode(", ",$data[sme]);

 $i = 0;
while ($i < count($like)) {
   $a = $like[$i];
   $query[] = $a ;
  // echo $query[$i];
$to="andry@pln.co.id";
$from= "noreply_km@pln.co.id" ;
//$message = "Welcome to Website"; 
$subject = "Approve media baru "; 
$message = "Dear SME<br> ada media baru yang haru di approve silangkan klik disini.<a href='http://kmpln.pln.co.id/plnchanneling/admin/admin.php?detailvideo=13'>abcdefg</a>"; 
    
 require_once 'smtpwork.php'; 
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
	else
		echo "Cound not send the message to $to.\nError: ".$smtp->error."\n <br>";

   
   $i++;
}
//$query = implode(' ', $query);
//echo $query;
?>

