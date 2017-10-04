$('.logoutK').click(function(){
		$.confirm({
			'title'		: 'Konfirmasi Logout',
			'message'	: 'Anda ingin keluar dari halaman aplikasi simpan pinjam ? <br /><h5 style="margin:0 20px; font-size:12px">klik yes untuk melanjutkan atau klik no untuk membatalkan<h5>',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){
                        window.location.href = "logout.php";
                        
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
		
	});