	<script>
		$('#ActualizarDireccion').click(function(e){
		//$('#ActualizarDireccion').on('click', function() { 
			//envia la latitud y longitud 
			 /*var lat =$('#latitude').val();
			 var log =$('#longitude').val();
			 var direccion =$('#direccionf').val(); */
		 
			 var data = $('#myModal').serializeArray();
			 //console.log(data);
		 
		 
			 $.ajax({
				 url: "{{ url('/recibir') }}",
				 type:"POST",
				 beforeSend: function (xhr) {
					  var token = $('meta[name="csrf-token"]').attr('content');
		 
					  if (token) {
							  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
					  }
				 },
				type:'POST',
				url:"{{ url('/recibir') }}",
				data:data,
				
				success:function(data){
					console.log(data);
					if ( data[0] == "error") {
					 console.log("error en grabar");
					} else {  
					 console.log("modal captura data  ");
							  //var obj = $.parseJSON(data);    
					  
					}
				},
				error:function(){ 
					alert("error!!!!");
					}
			 }); 
			 
		 
			 /*$.ajax({
				 type:'POST',
				 url:"{{ url('/recibir') }}",
				 data:{
					 lat:lat,
					 log:log,
					 direccion:direccion
				 }, 
				 success: function(respuesta){
				  
				 }
		  
			 });*/
			 //enviarLatLog( lat,log,direccion);
			  
			 //console.log(lat);
		 
		 });


		 /*$('#ActualizarDireccion').change(function(e){
			val = $('select[name=periodo]').val();
			idplan = $('select[name=idplan]').val();
			//console.log(val);
			$.ajax({
					url: "{{ url('/getPeriodo') }}",
					type:"POST",
					beforeSend: function (xhr) {
						 var token = $('meta[name="csrf-token"]').attr('content');
	
						 if (token) {
								 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
						 }
					},
				  type:'POST',
				  url:"{{ url('/getPeriodo') }}",
				  data:{
					  id:val,
					  idplan:idplan
				  },
	
				  success:function(data){
					console.log(data);
	
					$('#importe').empty();
					$('#precio').empty();
					$('#descuento').empty();
	
					alcance = (data.alcance > 0)? data.alcance+' usuarios' : 'Ilimitado';
					precio = data['periodo'][0]['valor'] * data.precio;
					descuento = precio * (data['periodo'][0]['descuento'])/100;
					importe = Number.parseFloat(precio - descuento).toFixed(2);
	
					$('#importe').append("$"+importe+" USD");
					$('#precio').append("$"+ precio  +" USD");
					$('#descuento').append("$"+ descuento  +" USD");
	
					$('#continuar').attr('href',"{{url('/carrito')}}/"+data.idplan+"/"+data.idperiodo);
	
				  },
				  error:function(){ 
					  alert("error!!!!");
			  }
	
			  });
		 });*/
	

		
	</script>