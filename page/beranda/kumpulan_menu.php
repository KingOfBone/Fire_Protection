	<?php 	
		function menu_sa() {  
			$arg = func_get_args();
			$username = $arg[0];
	?>
      <ul>
        <li><a class="text-right closeclick" href="#">close &times;</a></li>
        <li>
            <div class="imgprofile text-center">
            <?php
				$sqluserImg = mysql_query("SELECT * FROM master.login WHERE kodelogin ='$_SESSION[kodelogin]'") or die (mysql_error());
				$rowImg = mysql_fetch_array($sqluserImg);
            ?>

                <img src="<?php echo $rowImg["images"] == "" ? "images/foto/no-images.png" : "images/foto/".$rowImg["images"] ?>" class="img-circle img-responsive center-block"  />
                <br /><strong><?php echo $rowImg["nama"];?></strong>
            </div>
        </li>
		<?php } function menu_beranda() { ?>
        <li>
            <a href="?dashboard"><i class="fa fa-dashboard fa-2x"></i> Beranda</a>
		</li>
		<?php } function menu_data_master() { ?>
		<li>
			<a href="#"><i class="fa fa-building fa-2x"></i> Data Master<span class="fa arrow"></span></a>
			<ul >
				<li><a href="#" class="back">Main Menu</a></li>
				<li class="nav-label"><strong>Input Data Monitoring</strong></li>
				<li>
					<a href="?datamaster_lihat=Merk"><i class="fa fa-building fa-2x"></i> Merk</a>
				</li>
				<li>
					<a href="?datamaster_lihat=Jenis_Api"><i class="fa fa-building fa-2x"></i> Jenis Api</a>
				</li>				
			</ul>
		</li>
		<?php } function menu_panel() { ?>
		<li>
			<a href="?panel_lihat"><i class="fa fa-refresh fa-2x"></i> Panel</a>
		</li>
		<?php } function menu_panel_unit() { ?>
		<li>
			<a href="?panel_unit_cari"><i class="fa fa-home fa-2x"></i> Panel Unit</a>
		</li>
		<?php } function menu_sensor() { ?>
		<li>
			<a href="?sensor_lihat"><i class="fa fa-clock fa-2x"></i> Sensor</a>
		</li>
		<?php } function menu_sensor_unit() { ?>
		<li>
			<a href="?sensor_unit_cari"><i class="fa fa-road fa-2x"></i> Sensor Unit</a>
		</li>
		<?php } function menu_kejadian() { ?>
		<li>
			<a href="?kejadian_lihat"><i class="fa fa-sign-out fa-2x"></i>Kejadian</a>
		</li>
		<?php } function menu_pemeliharaan() { ?>
		<li>
			<a href="?pemeliharaan_lihat"><i class="fa fa-money fa-2x"></i> Pemeliharaan</a>
		</li>
		<?php } function menu_laporan() { ?>
		<li>
			<a href="#"><i class="fa fa-file fa-2x"></i> Laporan</a>
			<ul >
				<li><a href="#" class="back">Main Menu</a></li>
				<li class="nav-label"><strong>Laporan</strong></li>
				<li>
					<a href="?laporan_lihat=kejadian"><i class="fa fa-file fa-2x"></i> Kejadian <?php echo strtoupper($_SESSION['jenisuser']); ?></a>
				</li>
				<li>
					<a href="?laporan_lihat=pemeliharaan"><i class="fa fa-file fa-2x"></i> Pemeliharaan <?php echo strtoupper($_SESSION['jenisuser']); ?></a>
				</li>
				
				<?php 
					if($_SESSION['jenisuser'] != 'gi') { 
						$label = $_SESSION['jenisuser'] == 'ki' ? 'APP' : 'GI';
						
						
				?>
				<li>
					<a href="?laporan_unit_lihat=kejadian"><i class="fa fa-file fa-2x"></i> Kejadian <?php echo $label; ?></a>
				</li>
				<li>
					<a href="?laporan_unit_lihat=pemeliharaan"><i class="fa fa-file fa-2x"></i> Pemeliharaan <?php echo $label; ?></a>
				</li>
				<?php } ?>
			</ul>
		</li>
		<?php } ?>
      </ul>
