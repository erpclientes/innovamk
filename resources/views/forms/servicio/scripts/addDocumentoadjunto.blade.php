<script>
	$('#addDocumentoAdjunto').click(function(e){
	  e.preventDefault();  
	  console.log("ingreso");



	  var $Input, $myForm;
        
       // $Input = $('#archivo');
        $myForm = $('#myFormDoc');

     
			console.log($('#docURL'));
		  var formData = new FormData(); 
		  formData.append('archivo', $('#archivo')[0].files[0]);

		  $.ajax({
				beforeSend: function (xhr) {
					 var token = $('meta[name="csrf-token"]').attr('content');

					 if (token) {
							 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
					 }
				},
				url: "{{ url('/guardarDoc') }}" + '?' + $myForm.serialize(),
				method: 'POST',               
				data: formData,
				processData: false,
				contentType: false,

				 success: function(data){
					console.log(data);

					if ( data[0] == "error") {
						 
						( typeof data.archivo != "undefined" )? $('#h_error1').text(data.archivo) && $('#archivo').focus() : null;
					 ( typeof data.iddocumento != "undefined" )? $('#h_error2').text(data.iddocumento) : null;
					 ( typeof data.descripcion != "undefined" )? $('#h_error3').text(data.descripcion) : null;  
					 }	 
					if(data=="TRUE"){
						console.log(data); 
						$('#vwDocumentos').modal('close'); 
					}else{
						$('#h_error1').text('');
						$('#h_error1').text('ingreso un fomato no valido');
					}
					 setTimeout(function() {
                  Materialize.toast('<span>DOCUEMNTO ADJUNTADO CORRECTAMENTE</span>', 2000);
                }, 200);  
			 },
				 error:function(){ 
					 //alert("no se cargo ningun archivo");
					 $('#h_error1').text(''); 
					 $('#h_error1').text('es obligatorio cargar el documento repstando las extenciones');
					// $('#error1').text('error de archivo) ;



			 }

		  })

	   

	

  
 
 
	}); 
  </script>