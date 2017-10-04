	jQuery(function($){
		$.datepicker.regional['vi'] = {
			closeText: 'Tutup',
			prevText: 'Sebelum',
			nextText: 'Sesudah',
			currentText: 'Sekarang',
			monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
			'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
			monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
			'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
			dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&acute;at', 'Sabtu'],
			dayNamesShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sbt'],
			dayNamesMin: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb' ],
			dateFormat: 'yy-mm-dd',
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: false,
			changeMonth: true,
			changeYear: true,
			yearSuffix: ''};
		$.datepicker.setDefaults($.datepicker.regional['vi']);
	  	$(function(){
				$('#datePicker').datepicker({
					inline: true
				});
	    });
        $(function(){
				$('#datePicker2').datepicker({
					inline: true
				});
	    });
        $(function(){
				$('#datePicker3').datepicker({
					inline: true
				});
	    });
       });