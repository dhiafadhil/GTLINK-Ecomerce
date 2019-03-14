
<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>

<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>

<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js"></script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js"></script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/tinymce/tinymce.min.js"></script>
<script src="vendor/tinymce/jquery.tinymce.min.js"></script>
<script src="vendor/DataTables-1.10.19/media/js/jquery.dataTables.min.js"></script>
<script src="vendor/assets/alertify.min.js"></script>

<!-- Main JS-->
<script src="js/main.js">

//Data Table

$(document).ready(function() {
$('table.table').DataTable({"scrollX": true});

} );

//Keterangan
tinymce.init({ selector: 'textarea#full-featured',
				height: 350,
				theme : 'silver',
				plugins : 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
				toolbar: 'formatselect | bold italic strikethroug	h forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
				});

function tandaPemisahTitik(b){

var _minus = false;

if (b<0) _minus = true;

b = b.toString();

b=b.replace(".","");

c = "";
panjang = b.length;

j = 0;

for (i = panjang; i > 0; i--){

	j = j + 1;

	if (((j % 3) == 1) && (j != 1)){

	c = b.substr(i-1,1) + "." + c;

	} else {
		
	c = b.substr(i-1,1) + c;

	}

}

if (_minus) c = "-" + c ;

return c;

}

function numbersonly(ini, e){

if (e.keyCode>=49){

	if(e.keyCode<=57){

	a = ini.value.toString().replace(".","");

	b = a.replace(/[^\d]/g,"");

	b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);

	ini.value = tandaPemisahTitik(b);

	return false;

	}

	else if(e.keyCode<=105){

		if(e.keyCode>=96){
			//e.keycode = e.keycode - 47;
			a = ini.value.toString().replace(".","");

			b = a.replace(/[^\d]/g,"");

			b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);

			ini.value = tandaPemisahTitik(b);
			//alert(e.keycode);
			return false;

			}

		else {return false;}

	}

	else {

		return false; }

}else if (e.keyCode==48){

	a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);

	b = a.replace(/[^\d]/g,"");

	if (parseFloat(b)!=0){

		ini.value = tandaPemisahTitik(b);

		return false;

	} else {

		return false;

	}

} else if (e.keyCode==95){

	a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);

	b = a.replace(/[^\d]/g,"");

	if (parseFloat(b)!=0){

		ini.value = tandaPemisahTitik(b);

		return false;

	} else {

		return false;

	}
} else if (e.keyCode==8 || e.keycode==46){

	a = ini.value.replace(".","");

	b = a.replace(/[^\d]/g,"");

	b = b.substr(0,b.length -1);

	if (tandaPemisahTitik(b)!=""){

		ini.value = tandaPemisahTitik(b);

	} else {

		ini.value = "";

	}
	
	return false;

} else if (e.keyCode==9){

	return true;

} else if (e.keyCode==17){

	return true;

} else {

	//alert (e.keyCode);
	return false;

}

}
</script>