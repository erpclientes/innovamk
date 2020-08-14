<script type="text/javascript">
	//---JPaiva--12-07-2018---------------VARIOS DATATABLE--------------------
	  $(document).ready(function() {
	  $('table.display').DataTable();
	  //---jmazuelos--116-06-2020 -------------consumir ubicacion de modal iframe-----------------------------
	  var datos = []; 
	  var latitud , longitud,direccion ;
	  
 
	  function buscarDireccion() {
		  // value = $('#value').text();
		  var data = []; 
		  //ar data = bandera.push('B',); 
		  data.push(['carlos']); 	
		  $.ajax({
			url: " {{ url('/pasar') }} ",
			type:"POST",
			beforeSend: function (xhr) {
				var token = $('meta[name="csrf-token"]').attr('content');
				if (token) {
					 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
				}
			},
			type:'POST',
			url:" {{ url('/pasar') }} ",
			data:{
			  bandera:"bandera"
			},
			success:function(data){
			//  console.log(data);
			  if ( data[0] == "error") {
			  console.log("error");
			  
			  } else {  
				console.log("recupero data ");
				console.log(data); 
				if(data.longitud==null ){
				  console.log("esta nulo ")
					//setInterval(buscarDireccion, 3000);
				  //intervalo();
				}else{
				  latitud=data.latitud;
				  longitud=data.longitud;
				  direccion=data.direccion;
				 console.log(direccion);
				 $('#direccion').val(direccion ); 
				 $('#latitudF').val(latitud);
				 $('#longitudF').val(longitud );
				 $('#modalUpdate').modal('close'); 
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