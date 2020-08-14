<script>
	$(".datepicker").datepicker({
	  autoclose: true,
	  format: "yyyy/mm/dd"
	});
 
  //----------------------AGREGAR-----------------------------------
  $("#updTecnicos").click(function(){ 
	console.log("entro");

	var data = $('#myForm').serializeArray(); 
	console.log(data);
	$.ajax({
		 url: "{{ url('/tecnicos/actualizar') }}",
		 type:"POST",
		 beforeSend: function (xhr) {
			  var token = $('meta[name="csrf-token"]').attr('content');

			  if (token) {
					  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			  }
		 },
		type:'POST',
		url:"{{ url('/tecnicos/actualizar') }}",
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
			  
				  M.toast({ html: '<span>Registro Actualizado</span>'});

				 window.location="{{url('/tecnicos')}}";   
			 
			} 
		}, 
		error:function(){ 
			alert("error!!!!");
	}
	}); 



});
</script>