<script>
	$(".datepicker").datepicker({
	  autoclose: true,
	  format: "yyyy/mm/dd"
	});
 
  //------JMAZUELOS TAUMA----------------AGREGAR-----------------------------------
  $("#addTecnicos").click(function(){ 
	console.log("entro");

	var data = $('#myForm').serializeArray(); 
	console.log(data);
	$.ajax({
		 url: "{{ url('/tecnicos/grabar') }}",
		 type:"POST",
		 beforeSend: function (xhr) {
			  var token = $('meta[name="csrf-token"]').attr('content');

			  if (token) {
					  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			  }
		 },
		type:'POST',
		url:"{{ url('/tecnicos/grabar') }}",
		data:data,

		success:function(data){ 
			if ( data[0] == "error") {  
			  $('#error1').text("");
			  $('#error2').text("");
			  $('#error3').text("");
			  $('#error4').text("");
			  $('#error5').text(""); 
			  ( typeof data.nombres != "undefined" )? $('#error1').text(data.nombres) : null;
			  ( typeof data.zonas != "undefined" )? $('#error2').text(data.zonas) : null;
			  ( typeof data.nro_documento != "undefined" )? $('#error3').text(data.nro_documento) : null; 
			  ( typeof data.idempresa != "undefined" )? $('#error4').text(data.idempresa) : null; 
			  ( typeof data.sexo != "undefined" )? $('#error5').text(data.sexo) : null;  
			} else {    
			  
				 // M.toast({ html: '<span>Registro Exitoso</span>'});

				 window.location="{{url('/tecnicos')}}";   
			  //alert(data.success); 
			} 
		}, 
		error:function(){ 
			alert("error!!!!");
	}
	}); 



});
</script>