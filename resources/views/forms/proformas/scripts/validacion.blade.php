	<script>
		  //---------JMazuelos--12-08-2020---------VALIDAR INPUTs-----------------------------------
		  function validateEmail($email) {
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			return emailReg.test( $email );
		 }

		 $('#correoPro').on('click',function (z) { 

			descuento=$("input[name=correoPro").val();
			if( !validateEmail(descuento)) { /* do stuff here */
				console.log("ok"); 
			}
			//console.log(descuento);
		});  
		  @foreach($parametros as $val)
		  if('{{$val->parametro}}' == 'NRO_DOC_ALFANUM'){
			 if('{{$val->valor}}' == 'SI'){
				$('#nro_documentoPro').mask('AAAAAAAAAAAAAAAAAAAA', {'translation': {
					 A: {pattern: /[A-Za-z0-9--]/}
				  }
				});
			 }else{
				$('#nro_documentoPro').mask('09999999999999999999)');
			 }
		  }
		@endforeach
		
		$('#apaternoPro').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
		  A: {pattern: /[A-Za-zñòóÑ\s]/}
		  }
		});
		$('#amaternoPro').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
			 A: {pattern: /[A-Za-zñòóÑ\s]/}
			  
		  }
		}); 
		$('#nombresPro').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
		  A: {pattern: /[A-Za-zñòóÑ\s]/}
		  }
		});
		$('#contactoPro').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
			A: {pattern: /[123456789+]/}
			}
		 });
 
		var focus = 0;

		//--- validar correo

		$("#correoPro").focusout(function() {
		  focus++;
		  console.log(focus);
	 
		  var data = $(this).val();
	 
				  $.ajax({
						url: "{{ url('/cliente/verificarCorreo') }}",
						type:"POST",
						beforeSend: function (xhr) {
							 var token = $('meta[name="csrf-token"]').attr('content');
	 
							 if (token) {
									 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
							 }
						},
					  type:'POST',
					  url:"{{ url('/cliente/verificarCorreo') }}",
					  data:{
						correo:data 
					  },
	 
					  success:function(data){              
						  if ( data[0] == "error") { 
							 $('#correoPro').val('');  
							 $('#error6').val(''); 
							 ( typeof data.correo != "undefined" )? $('#error6').text(data.correo) && $('#correoPro').focus() : null; 
						  }
						  if (data.errors == 'EXISTE') { 
							 $('#correoPro').val('');
							 $('#error6').val('');
							 $('#correoPro').focus(); 
							 setTimeout(function() {
								M.toast({ html: '<span>El correo ingresado ya existe. Ingrese uno distinto.</span>'});
							 }, 800); 
						  } 
						  if (data.conforme == 'conforme') {    
							var capa=document.getElementById("error6");
							capa.style.display="none";
							capa.style.visibility="hidden";
							capa.style.visibility="hidden";
						  }
					  },
	 
					  error:function(){ 
						  alert("error!!!!");
				  }
				  });
				
		});


		
	</script>