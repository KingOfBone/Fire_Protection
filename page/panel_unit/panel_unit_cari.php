
<?php
	if(isset($_POST["submit"])) {
		//cari($_POST, $nama_table, "?".$nama_table_kecil."_cari_hasil");		
	}
?>



<link rel="stylesheet" href="script/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="script/dhtmlwindow_fol.js"></script>
<link rel="stylesheet" href="librari/stylesuggest.css" type="text/css" />

<!-- Pick Day -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<script type="text/javascript" src="page/gangguan/triger.js"></script>

<div id="wrapper">
    <!-- /. NAV SIDE  -->
   <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
				<?php
					$jenisuser = $_SESSION['jenisuser'];
				
					$label = '';
					if($jenisuser == 'app')
						$label = 'GI';
					else if($jenisuser == 'ki')
						$label = 'APP';
				?>
                    <h2>Panel <?php echo $label; ?> </h2>
                </div>
            </div>
			<!-- /. ROW  -->
			<hr />
			
			
			<?php if(!empty($_GET["pesan"]) && $_GET["pesan"] == 'berhasil'){?>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-success">Data berhasil ditambah
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
						</div>
					</div>
				</div>
            <?php } ?>
			
			
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							PANEL <?php echo $label; ?>
						</div>
						<div class="panel-body">
							<div class="row">
								<form id="validate-me-plz" name="form1" role="form" action="?panel_unit_cari_hasil" method="post">
									<div class='col-lg-6'>
										
										<?php function select_app() { ?>
										<div class="form-group">
											<div class="row">
												<div class="col-md-2"><label>APP</label></div>
												<div class="col-md-5">
													<select name='kodeapp' onChange='cari_gi(this.value)' class="form-control">
														<?php
															$sql = "select * from master.app order by master.app.namaapp asc";
															$sql = mysql_query($sql);
															while($datatemp = mysql_fetch_array($sql)) {
																echo "<option value='$datatemp[kodeapp]'>$datatemp[namaapp]</option>";
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<?php } ?>
										
										
										<?php function select_gi() { ?>
											<div class="form-group">
												<div class="row">
													<div class="col-md-2"><label>GI</label></div>
													<div class="col-md-5">
														<?php
															/* echo $sql = "
																select * from master.gi 
																inner join master.app
																	on master.app.kodeapp=master.gi.kodeapp
																where 
																	master.app.kodeapp = $_SESSION[kodeapp]
																order by namagi asc
															"; */
															
															$klausa = '';
															if($_SESSION['jenisuser'] == 'app') {
																$klausa = "master.app.kodeapp = $_SESSION[kodeapp]";
															}
															else if($_SESSION['jenisuser'] == 'ki') {
																$klausa = "master.app.kodeapp = (select kodeapp from master.app order by master.app.namaapp asc limit 1)";
															}
															
															$sql = "
																select * from master.gi 
																inner join master.app
																	on master.app.kodeapp=master.gi.kodeapp
																where 
																	$klausa
																order by namagi asc
															";
														?>
														<select name='kodegi' id='gi_unit' class="form-control">
															<option value='semua'>Semua</option>
															<?php
																$sql = mysql_query($sql);
																while($datatemp = mysql_fetch_array($sql)) {
																	echo "<option value='$datatemp[kodegi]'>$datatemp[namagi]</option>";
																}
																//}
															?>
														</select>
													</div>
													
													
													<div class="col-md-2">
														<button type="submit" name="submit" id="submit" value="submit" class="btn btn-large btn-success">Cari</button>
													</div>
												</div>
											</div>
										<?php } ?>
										
										<?php 
											if($_SESSION['jenisuser'] == 'ki') {
												select_app();
												select_gi();
											}
											else if($_SESSION['jenisuser'] == 'app') {
												select_gi();
											}
										?>
											
										
											
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php if($_SESSION['jenisuser'] == 'ki') { ?>
	<script>
		function cari_gi(kodeapp) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {		
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("gi_unit").innerHTML = this.responseText;
				}
			};
			
			xhttp.open("POST", "page/panel_unit/panel_unit_cari_gi.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("kodeapp="+kodeapp);
		}
	</script>
<?php } ?>


<!--
<script>
	function showUser(str) {
	  if (str=="") {
		document.getElementById("select_value").innerHTML="";
		return;
	  } 
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
		  document.getElementById("select_value").innerHTML=this.responseText;
		}
	  }
	  xmlhttp.open("post","getuser.php?q="+str,true);
	  xmlhttp.send();
	}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#app_unit").click(function(){
        $.post("demo_test_post.asp",
        {
          name: "Donald Duck",
          city: "Duckburg"
        },
        function(data,status){
            document.getElementById("select_value").innerHTML=data;
        });
    });
});
</script>
-->



