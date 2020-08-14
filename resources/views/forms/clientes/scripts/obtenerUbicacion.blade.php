	<script>

		 
		  //---Jmazuelos 17-06-2020 ---------------VARIOS DATATABLE--------------------
		  $("#modalClienteDir").click(function(g){
			$('table.display').DataTable();
			var datos = []; 
			var latitud , longitud,direccion ;
			
	  
			function buscarDireccion() {
				// value = $('#value').text();
				var data = []; 
				//ar data = bandera.push('B',); 
				data.push(['carlos']); 	
				$.ajax({
				 url: " {{ url('/pasarCreate') }} ",
				 type:"POST",
				 beforeSend: function (xhr) {
					 var token = $('meta[name="csrf-token"]').attr('content');
					 if (token) {
						  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
					 }
				 },
				 type:'POST',
				 url:" {{ url('/pasarCreate') }} ",
				 data:{
					bandera:"bandera"
				 },
				 success:function(data){
				 //  console.log(data);
					if ( data[0] == "error") {
					console.log("error");
					
					} else {  
					  
					 if(data.longitud==null ||data.longitud=='true'){
						console.log("esta nulo ")
						 //setInterval(buscarDireccion, 3000);
						//intervalo();
					 }else{
						latitud=data.latitud;
						longitud=data.longitud;
						direccion=data.direccion; 
					  $('#direccion').val(direccion ); 
					  $('#latitudC').val(latitud);
					  $('#longitudC').val(longitud );
					  //modalCreate.close();
					  $('#modalCreate1').modal('close');
					  console.log("se actualiza registro ");
					 }
					 //datos=data;
					 //clearInterval(intervalo);
	  
					}
				 },
				 error:function(){ 
					alert("error!!!!");
					}
			  });
			}
	  
			
			setInterval(buscarDireccion, 3000);
					
			  
			 
	  
	  
	  
	  
			 
		 } );
		
	  
	  


		
	</script>