$(document).ready(function(){
	
	$('.delete').click(function(){
		var elem = $(this).closest('.item');
		var id = $(this).attr('id');
		$.confirm({
			'title'		: 'Konfirmasi Hapus',
			'message'	: 'Anda ingin menghapus data ini ? <br /><h5 style="margin:5px 30px; font-size:12px">klik yes untuk melanjutkan atau klik no untuk membatalkan<h5>',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){
						
                        window.location.href = "page/dell.php?"+id;
                        
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
		
	});
	
});