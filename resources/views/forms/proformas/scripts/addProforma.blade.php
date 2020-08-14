<script type="text/javascript">
	var totales;
	var detalle = []; 
	var idConceptoManual=500; 
	var contadorConceptos=0; 
	var totales= []; 
	var total=0;
	
	var editor = CKEDITOR.replace('descripcionCkeditor'); //inicializacion de ckeditor 
	//var editor = CKEDITOR.editor.replace('descripcionCkeditor'); 

	$(document).ready(function(){
		
		$('#modalAddPlan').modal();
		$('#modalProforma').modal();
		$('#modalAddConcepto').modal();
		$('#modalAddEquipo').modal();
		$('#modalAddEquipo').modal(); 
		$('.modal').modal(); 

	});
	//---------------JMAZUELOS 23/07/2020- eliminar datos de la tabla --------- ----------------- 
	function eliminar_elemento(valor){ 
		ActualizarDescuento();
		fila='fila'+valor;//--id del tr a eliminar   
		//-buscar y eliminar el elemnto  de la tabla
		for (var i = 0; i < detalle.length; i++) { 
			//detalle[i][0]-id del array
			//detalle[i][1]-elemento html del array 
			if(detalle[i][0]==fila){
				detalle.splice(i,1); 
			}  
		}  
		//------------captar descuento ingresado en la vista y guardarlo en el array
		  
		limpiarTabla();//funcion para limpiar tabla  
		pintarTabla(detalle)////agregamos los nuevos elementos a la tabla 
		//-------pintar el descuento ingresado en el array y mostrarlo en la vista
		ActualizarDescuentoTabla();
		//console.log(detalle);  
	} 
	//---------------JMAZUELOS 23/07/2020-limpiar datos de la tabla -------------------------------------------------------- 
	function limpiarTabla(){
		//limpiar los elemetos de la tabla 
		var trs=$("#tableProformaDetalle tbody tr").length; //obtenermos el numero de tr en la tabla  
		//elimnamos los tr de la tabla 
		for (var i = 0; i < trs; i++) {
			$("#tableProformaDetalle tbody tr:last").remove();
			
		} 
	}
	//---------------JMAZUELOS 23/07/2020-pintar datos de la tabla -------------------------------------------------------- 

	function pintarTabla(detalle1){
		//agregamos los nuevos elementos a la tabla  
		for (var i = 0; i < detalle1.length; i++) {
			$("#tableProformaDetalle").append( detalle1[i][1]);
		} 
	} 
	//------------captar descuento ingresado en la vista y guardarlo en el array
	function ActualizarDescuento(){
		if(detalle.length >0) {//---------verificamos que existan elementos en el detalle
			detalleId=0;
			for (var i = 0; i < detalle.length; i++) { 
				//detalle[i][0]-id del array
				//detalle[i][1]-elemento html del array  
				detalleId=i+1; 
				detalle[i][8]=$("input[name=des"+detalleId+"]").val();  
			}  
		} 
	} 
	//-------pintar el descuento ingresado en el array y mostrarlo en la vista
	function ActualizarDescuentoTabla(){
		if(detalle.length >0) {//---------verificamos que existan elementos en el detalle
			detalleId=0;
			for (var i = 0; i < detalle.length; i++) {  
					detalleId=i+1; //id del input descuento 
				$('#des'+detalleId).val(detalle[i][8]);  
			}  
		}  
	}
	
	 

//---------------JMAZUELOS 23/07/2020- DATOS DEL PLAN------------------------------------------------------------------------	
	$('.btnSeleccionar').on('click',function () {
		var dataId = $(this).attr("data-id"); 
		var name = $(this).attr("data-name");
		var precio = $(this).attr("data-precio");
		var vsubida = $(this).attr("data-vsubida");
		var vbajada = $(this).attr("data-vbajada"); 
		var target = $(this).attr("data-target");  
		descuento =0;
		descripcion="Servicio de Internet Banda ancha:  Plan de Internet-"+name+"  velocidades-"+target;
		contadorConceptos +=1;   

		//------------captar descuento ingresado en la vista y guardarlo en el array
		ActualizarDescuento();  
		//------------agregar el nuevo tr al array 
		detalle.push( ['fila'+contadorConceptos,'<tr id="fila'+contadorConceptos+'" class="center">'  +
				'<td class="center">'+contadorConceptos+' </td>'+ 
				'<td class="center"> '+'SERVICIO DE  INTERNET'+' </td>'+
				'<td class="center"> '+name+'<br> '+target+' </td>'+
				'<td class="center"   id="precio'+contadorConceptos+'"  name="precio'+contadorConceptos+'" > '+precio+' </td> '+
				'<td class=" col s12 m5 l6 offset-l3"><input id="des'+contadorConceptos+'" name="des'+contadorConceptos+'" type="number" > </td> '+
				'<td class="center">'+ 
					'<a onclick="eliminar_elemento( '+contadorConceptos+');" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>' 
				+' </td> '+  
			'</tr>','PLAN',dataId,'SERVICIO DE  INTERNET',descripcion,precio,contadorConceptos,descuento ]  
		);

		limpiarTabla();//funcion para limpiar tabla  
		pintarTabla(detalle)////agregamos los nuevos elementos a la tabla  
		$('#modalAddPlan').modal('close');//cerramos el modal
		//-------pintar el descuento ingresado en el array y mostrarlo en la vista
		ActualizarDescuentoTabla();

		
		//console.log(detalle); 
	}); 
//--------JMAZUELOS 23/07/2020-DATOS DEL EQUIPO----------------------------------------------------------------
  $('.btnSeleccionarEquipo').on('click',function () {
	var dataId = $(this).attr("data-id");
	var descripcion = $(this).attr("data-descripcion");
	var marca = $(this).attr("data-marca");
	var modelo = $(this).attr("data-modelo");
	var precio = $(this).attr("data-precio"); 
	descuento =0;
	contadorConceptos +=1; 
	//------------captar descuento ingresado en la vista y guardarlo en el array
	ActualizarDescuento(); 

		detalle.push( ['fila'+contadorConceptos,'<tr id="fila'+contadorConceptos+'" class="center">'  +
				'<td class="center"> '+contadorConceptos+'</td>'+ 
				'<td class="center"> '+'NUEVO EQUIPO'+' </td>'+
				'<td class="center"> '+descripcion +' </td>'+
				'<td class="center"  id="precio'+contadorConceptos+'"  name="precio'+contadorConceptos+'"> '+precio+' </td> '+
				'<td class=" col s12 m5 l6 offset-l3"><input id="des'+contadorConceptos+'" name="des'+contadorConceptos+'" type="number"> </td> '+
				'<td class="center">'+

					'<a onclick="eliminar_elemento( '+contadorConceptos+');" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>' 
					
				+' </td> '+  
			'</tr>','EQUIPO',dataId,'NUEVO EQUIPO',descripcion,precio,contadorConceptos,descuento]
			
		);
		limpiarTabla();//funcion para limpiar tabla  
		pintarTabla(detalle)////agregamos los nuevos elementos a la tabla 
		
	//-------pintar el descuento ingresado en el array y mostrarlo en la vista
	ActualizarDescuentoTabla();
	$('#modalAddEquipo').modal('close');//cerramos el modal  
	}); 
///--------JMAZUELOS 23/07/2020- DATOS DEL CONCEPTO------------------------------------------------------------------------
	$('#addConceptoM').on('click',function () {
		var concepto= $('#conceptoC').val(); 
		var descripcion=$('#descripcionC').val(); 
		var precio=$('#precioC').val(); 
		descuento =0;
		dataId= idConceptoManual+1;
		contadorConceptos +=1; 
		//------------captar descuento ingresado en la vista y guardarlo en el array
		ActualizarDescuento();

		detalle.push( ['fila'+contadorConceptos,'<tr id="fila'+contadorConceptos+'" class="center">'  +
				'<td class="center">'+contadorConceptos+' </td>'+ 
				'<td class="center"> '+concepto+' </td>'+
				'<td class="center"> '+descripcion +' </td>'+
				'<td class="center"> '+precio+' </td> '+
				'<td class=" col s12 m5 l6 offset-l3"><input id="des'+contadorConceptos+'" name="des'+contadorConceptos+'"   type="number"> </td> '+
				'<td class="center">'+

					'<a onclick="eliminar_elemento( '+contadorConceptos+');" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>' 
					
				+' </td> '+  
			'</tr>','MANUAL',dataId,concepto,descripcion,precio,contadorConceptos ,descuento]
			
		);
		limpiarTabla();//funcion para limpiar tabla  
		pintarTabla(detalle)////agregamos los nuevos elementos a la tabla 
		
			//-------pintar el descuento ingresado en el array y mostrarlo en la vista
				ActualizarDescuentoTabla();  
		$('#modalAddConcepto').modal('close'); 
	});  
//--------------crear la proforma -------------------
		$('#addProform').on('click',function () {
			//console.log(detalle);

		 
			var value = editor.getData();/// resultado del ckeditor
			$('#descripcionPro').val(value) /// guardamos en la variable
			var data = $('#myForm').serializeArray();
			if(detalle.length != 0 ){

				$.ajax({
					url: "{{ url('/proformas/grabar') }}",
					type:"POST",
					beforeSend: function (xhr) {
						 var token = $('meta[name="csrf-token"]').attr('content');
			
						 if (token) {
								 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
						 }
					},
				  type:'POST',
				  url:"{{ url('/proformas/grabar') }}",
				  data:data,
			
				  success:function(data){
					  
					  if ( data[0] == "error") { 

						( typeof data.iddocumentoPro != "undefined" )? $('#error1').text(data.iddocumentoPro) && $('#iddocumentoPro').focus() : null;
						 ( typeof data.nro_documentoPro != "undefined" )? $('#error2').text(data.nro_documentoPro) : null;
						 ( typeof data.apaternoPro != "undefined" )? $('#error3').text(data.apaternoPro) : null; 
						 ( typeof data.amaternoPro != "undefined" )? $('#error4').text(data.amaternoPro) : null;
						 ( typeof data.nombresPro != "undefined" )? $('#error5').text(data.nombresPro) : null;  
					  } else {   
						  var clienteId=data.clienteId;
						  var empresaId=data.empresaId;
						  var prodormaId =data.prodormaId ;

						//------------------------------registrar detalle------------------------------------------------------------
					
						for (var i = 0; i < detalle.length; i++) {   
								conceptoId=detalle[i][3];//obtenemos el id del plan guardado en el array
								Concepto=detalle[i][4];//obtenemos el concepto guardado en el array
								descripcion=detalle[i][5];//obtenemos la descripcion guardado en el array
								precio=detalle[i][6];  //obtenemos el precio guardado en el array
								descuento=$("input[name=des"+detalle[i][7]+"]").val();  //obtenner el descuento ingresado en la vista
								subtotal=precio-descuento;
								total +=parseInt(subtotal);  

								if(detalle[i][2]=='PLAN'){
									$.ajax({
										url: "{{ url('/proformas/StoreDetallePlan') }}",
										type:"POST",
											beforeSend: function (xhr) {
												var token = $('meta[name="csrf-token"]').attr('content');
							
												if (token) {
														return xhr.setRequestHeader('X-CSRF-TOKEN', token);
												}
											},
											type:'POST',
											url:"{{ url('/proformas/StoreDetallePlan') }}",
											data:{
												conceptoId		:conceptoId,
												Concepto		:Concepto,
												descripcion	:descripcion,
												precio		:precio,
												descuento	:descuento,
												subtotal		:subtotal,
												clienteId	: clienteId,
												empresaId	: empresaId,
												prodormaId	:prodormaId
											},
								
											success:function(data){
												//M.toast({ html: '<span>Registro exitoso</span>'});
												//	window.location = "{{ url('/proformas') }} ";

												
											},
								
											error:function(){ 
												alert("error!!!!");
											}
									}); 
								}
								if(detalle[i][2]=='EQUIPO'){
									$.ajax({
										url: "{{ url('/proformas/StoreDetalleEquipo') }}",
										type:"POST",
											beforeSend: function (xhr) {
												var token = $('meta[name="csrf-token"]').attr('content');
							
												if (token) {
														return xhr.setRequestHeader('X-CSRF-TOKEN', token);
												}
											},
											type:'POST',
											url:"{{ url('/proformas/StoreDetalleEquipo') }}",
											data:{
												conceptoId		:conceptoId,
												Concepto		:Concepto,
												descripcion	:descripcion,
												precio		:precio,
												descuento	:descuento,
												subtotal		:subtotal,
												clienteId	: clienteId,
												empresaId	: empresaId,
												prodormaId	:prodormaId
											},
								
											success:function(data){
												//M.toast({ html: '<span>Registro exitoso</span>'});
												//	window.location = "{{ url('/proformas') }} ";

												
											},
								
											error:function(){ 
												alert("error!!!!");
											}
									}); 
								}
								if(detalle[i][2]=='MANUAL'){
									$.ajax({
										url: "{{ url('/proformas/StoreDetalleConceptoManual') }}",
										type:"POST",
											beforeSend: function (xhr) {
												var token = $('meta[name="csrf-token"]').attr('content');
							
												if (token) {
														return xhr.setRequestHeader('X-CSRF-TOKEN', token);
												}
											},
											type:'POST',
											url:"{{ url('/proformas/StoreDetalleConceptoManual') }}",
											data:{
												conceptoId		:conceptoId,
												Concepto		:Concepto,
												descripcion	:descripcion,
												precio		:precio,
												descuento	:descuento,
												subtotal		:subtotal,
												clienteId	: clienteId,
												empresaId	: empresaId,
												prodormaId	:prodormaId
											},
								
											success:function(data){
												//M.toast({ html: '<span>Registro exitoso</span>'});
												//	window.location = "{{ url('/proformas') }} ";

												
											},
								
											error:function(){ 
												alert("error!!!!");
											}
									}); 
								}
						  
						}

						M.toast({ html: '<span>Registro exitoso</span>'});
						window.location = "{{ url('/proformas') }} ";
						


						//console.log(total );  
						//------------------------------registrar detalle------------------------------------------------------------ 

					  } 
				  }, 
				  error:function(){ 
					  alert("error!!!!");
			  }
			  });  
			}else{
				limpiarTabla();
				$("#tableProformaDetalle").append( 
					'<tr  >'+ 
						'<td colspan="6" style="text-align: center; text: red;" > <H5 style="color: red;">'+
							 'El campo detalle es obligatorio</H5> </td>' +
					'</tr> ' 
				); 
				console.log( "no data"); 

			} 
			//console.log( detalle); 
			});
		  
	  

</script>