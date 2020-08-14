	<script>
		  //--------JMAZUELOS 05-08-2020------------------AGREGAR CONCEPTO DE FOMA MANUAL ---------------------------
		//var editor = CKEDITOR.replace('descripcionCkeditor');

		
		$('#addNewConMan').on('click',function(){
			//var value = editor.getData();/// resultado del ckeditor
			//$('#descripcionAddConceptoM').val(value) /// guardamos en la variable

			var data = $('#FormNewComceptoManual').serializeArray();
			console.log(data);
			$.ajax({
				url: "{{ url('/comprobante/grabarConceptoManual') }}",
				type:"POST",
					beforeSend: function (xhr) {
						var token = $('meta[name="csrf-token"]').attr('content');
						if (token) {
								return xhr.setRequestHeader('X-CSRF-TOKEN', token);
						}
					},
					type:'POST',
					url:"{{ url('/comprobante/grabarConceptoManual') }}",
					data:data, 
					success:function(data){

						if ( data[0] == "error") {
							( typeof data.descripcionManual != "undefined" )? $('#descripcionManual1').text(data.descripcionManual) : null;
							( typeof data.cantidadManual != "undefined" )? $('#cantidadManual2').text(data.cantidadManual) : null;
							( typeof data.precioManual != "undefined" )? $('#PrecioManual3').text(data.precioManual) : null;
							( typeof data.descuentoManual != "undefined" )? $('#descuentoManual4').text(data.descuentoManual) : null; 
						 } else {  
							//var obj = $.parseJSON(data);  
						//	window.location="{{ url('/clientes') }}";              
						 
							// setTimeout("location.href='{{url('/clientes')}}'", 0000);
							$("#detFac"+data.facturaId).append("<div class='input-field col s12 m6 l8'>"+
								"<i class='material-icons prefix'>mode_edit</i>"+                                             
								"<input type='text' disabled='' value='"+data.descripcion+"' style='margin-bottom: 0px'>"+
							 "</div>"+     
							 "<div class='input-field col s12 m6 l4'>"+
								"<i class='material-icons prefix'>attach_money</i>"+
								"<input type='text' disabled='' value='"+data.totalDetFactura+"' style='margin-bottom: 0px'>"+
							 "</div>");  
							
							 $('#subtotal2').val(data.subTotal); 
							 $('#descuento2').val('0');
							 $('.subtotal_neto2').val(data.subTotalNeto);
							 $('#impuesto').val('0');
							 $('.total2').val(data.subTotal);  
							 $(".total1"+data.facturaId).val(data.subTotal);    


								 

						 }


							 
						//M.toast({ html: '<span>Registro exitoso</span>'});
						//	window.location = "{{ url('/proformas') }} "; 
					},
		
					error:function(){ 
						alert("error!!!!");
					}
			}); 
		});
			
		
	</script>