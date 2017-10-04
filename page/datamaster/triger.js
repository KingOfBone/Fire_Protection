
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

	function FormatCurrency(objNum)
	{
    	var num = objNum.value
		var ent, dec;

		if (num != '' && num != objNum.oldvalue)
			{
				num = MoneyToNumber(num);
				if (isNaN(num))
	        	{
				objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
	    	    }
				else
				{
					var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
					if (ev.keyCode == 190 || !isNaN(num.split('.')[1]))
						{
							alert(num.split('.')[1]);
            				objNum.value = AddCommas(num.split(',')[0])+'.'+num.split(',')[1];
        				}
					else
					{
						objNum.value = AddCommas(num.split('.')[0]);
					}
				objNum.oldvalue = objNum.value;
        		}
		}
	}

	function addCommas(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
	}

	function MoneyToNumber(num)
	{
		return (num.replace(/,/g, ''));
	}

	function AddCommas(num)
	{
   		numArr=new String(num).split('').reverse();
   		for (i=3;i<numArr.length;i+=3)
    	{
			numArr[i]+=',';
    	}
    return numArr.reverse().join('');
	}


	function addRowToTable(){
	  var tbl     = document.getElementById('tblSample');
	  var lastRow = tbl.rows.length;
	  // if there's no header row in the table, then iteration = lastRow + 1
	  var iteration = lastRow-1;
	  var row = tbl.insertRow(lastRow);

	  var td1 = row.insertCell(0);
 	  var td2 = row.insertCell(1);
 	  var td3 = row.insertCell(2);
 	  var td4 = row.insertCell(3);
 	  var td5 = row.insertCell(4);
 	  var td6 = row.insertCell(5);
 	  var td7 = row.insertCell(6);
	  var td8 = row.insertCell(7);
	  var td9 = row.insertCell(8);

 	  var number = document.getElementById('number');
 	  number.value = iteration;
 	  var x = number.value;

 	  td1.innerHTML = ""+iteration+"";
	  td2.innerHTML = "<input type='text' name='gi"+x+"' style=\"width: 90%;\" id='gi"+x+"' class='form-control pull-left' readonly=''/>&nbsp;<a HREF=\'#\'  onClick=\"findsubject=dhtmlwindow.open('fdsubject', 'iframe', 'page/gangguan/cari.php?flag="+x+"', 'Daftar Gangguan', 'width=700px,height=350px,top=130px,left=250px,resize=1,scrolling=1'); return false\"><i class='fa fa-search-plus fa-2x'></i></a>";
	  td3.innerHTML = "<select class='form-control' name='nomortrafo"+x+"' id='nomortrafo"+x+"' data-rule-required='true'><option value=''></option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select>";
	  td4.innerHTML = "<select class='form-control' name='pic"+x+"' id='pic"+x+"' data-rule-required='true'><option value=''></option><option value='TRF'>TRF</option><option value='TL/IBT'>TL/IBT</option><option value='INC'>INC</option><option value='DIS'>DIS</option><option value='P2B'>P2B</option></select>";
	  td5.innerHTML = "<select class='form-control' name='pemilikaset"+x+"' id='pemilikaset"+x+"' data-rule-required='true'><option value=''></option><option value='TRF'>TRF</option><option value='TL/IBT'>TL/IBT</option><option value='INC'>INC</option><option value='DIS'>DIS</option><option value='P2B'>P2B</option></select>";
	  td6.innerHTML = "<select class='form-control' name='picpemeliharaan"+x+"' id='picpemeliharaan"+x+"' data-rule-required='true'><option value=''></option><option value='internal'>Internal</option><option value='external'>External</option></select>";
	  td7.innerHTML = "<input type='text' name='mulai"+x+"' id='mulai"+x+"'/>";
	  td8.innerHTML = "<input type='text' name='normal"+x+"' id='normal"+x+"'/>";
	  td9.innerHTML = "<textarea name='keterangan"+x+"'></textarea>";

	  $('#mulai'+x+'').datetimepicker({
      dayOfWeekStart : 1,
      lang:'en',
      disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
      startDate:	'2017/01/05'
      });

	  $('#normal'+x+'').datetimepicker({
      dayOfWeekStart : 1,
      lang:'en',
      disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
      startDate:	'2017/01/05'
      });
	 }

	function removeRowFromTable(){

		  var tbl     = document.getElementById('tblSample');
		  var lastRow = tbl.rows.length;


	 	  var number = document.getElementById('number');
		  if(number.value > 1){
	      var sisa   = parseInt(number.value) - 1;
		  number.value = sisa;
		  }

		  if(lastRow > 3){
		  tbl.deleteRow(lastRow - 1);
		  }
	}

	function validasi(val){

	var number = document.getElementById('number').value;

	var a = "gi";
	var b = "nomortrafo";
	var c = "mulai";
	var d = "normal";
	//gabung dgn identifier
	var aa = a.concat(number);
	var bb = b.concat(number);
	var cc = c.concat(number);
	var dd = d.concat(number);

	// if(document.formgangguan.getElementById(aa).value=='')  {
	// 	alert('Gardu Induk harus diisi!');
	// 	return false;
	// }
	// else {
	// 	if(document.getElementById(bb).value=='')  {
	// 		alert("Nomor Trafo baris ke-"+number+" harus diisi!");
	// 		document.getElementById(bb).focus();
	// 		return false;
	// 	}
	// 	else {
	// 		if(document.getElementById(cc).value=='')  {
	// 			alert("Tanggal Mulai baris ke-"+number+" harus diisi!");
	// 			document.getElementById(cc).focus();
	// 			return false;
	// 		}
	// 		else {
	// 			if(document.getElementById(dd).value=='')  {
	// 				alert("Tanggal Normal baris ke-"+number+" harus diisi!");
	// 				document.getElementById(dd).focus();
	// 				return false;
	// 			}
	// 			else {
					if(val == "tambah"){
						addRowToTable();
					}
	// 			}
	// 		}
	// 	}
	// }
}

  function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
 function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
    //     if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }

function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("librari/autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#nm_akun1').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 100);
	}

	function fill2(thisValue) {
		$('#gi1').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 100);
	}
    function fill3(thisValue) {
		$('#saldo1').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 100);
	}
