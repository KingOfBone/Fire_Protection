var ajaxRequest;
	function getAjax() //fungsi untuk mengecek AJAX pada browser
	{
		try
		{
			ajaxRequest = new XMLHttpRequest();
		}
		catch (e)
		{
			try
			{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e) 
			{
				try
				{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e)
				{
					alert("Your browser broke!");
					return false;
				}
			}
		}
	}
	
		
	function autoComplete() //fungsi menangkap input search dan menampilkan hasil search
	{
		getAjax();
		
		var namaanggota = document.getElementById("nmAng").value;
		
		if (namaanggota == "") 
		{		
			document.getElementById("jenis").value = "";
			document.getElementById("alamat").value = "";
			document.getElementById("notelp").value = "";
			document.getElementById("email").value = "";
			document.getElementById("nip").value = "";
		}
		else
		{
			ajaxRequest.open("GET","page/cari.php?run=carianggota&namaanggota="+namaanggota);
			ajaxRequest.onreadystatechange = function()
			{	
					if ((ajaxRequest.readyState == 4) && (ajaxRequest.status == 200))
					{
						
						var ss = ajaxRequest.responseText.split("||");
						for(var i=0; i < ss.length; i++){
							var a1 = ss[0];
							var a2 = ss[1];
							var a3 = ss[2];
							var a4 = ss[3];
							var a5 = ss[4];
						
						}
						if(a1 != ""){
						document.getElementById("jenis").value = a1;
						document.getElementById("alamat").value = a2;
						document.getElementById("notelp").value = a3;
						document.getElementById("email").value = a4;
						document.getElementById("nip").value = a5;
						}
						
					} else
					{
					document.getElementById("jenis").innerHTML = "<img src='ajax-loader.gif'>";
					document.getElementById("notelp").innerHTML = "<img src='ajax-loader.gif'>";
					document.getElementById("email").innerHTML = "<img src='ajax-loader.gif'>";
					document.getElementById("nip").innerHTML = "<img src='ajax-loader.gif'>";
					}
				
			}
			ajaxRequest.send(null);
		}
				
	}