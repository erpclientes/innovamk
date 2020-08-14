 
<script>  
	function initMap() {  
		//------julinho script para mostar las zonas ,  clientes y equipos en el mapa 
		var map;
		var datamarker =  [];
		var input = document.getElementById("leyenda");
		 

		var markers1 = [];
	 
		@foreach ($zonas as $item)                 
			var color='{{ $item->color}}';
			var idZonas='{{ $item->id }}';  

				@foreach ( $equipos as $equi)   
					//var color = colorHEX();
					var idZonaEquipo='{{ $equi->idZona }}';
					@if ($equi->longitudE !== null)
						//console.log(color);
						var idequipo='{{ $equi->idequipo }}';
						//console.log(idequipo);
						if ( idZonas === idZonaEquipo)
							{
									datamarker.push(['{{$equi->modeloE}}','{{ $equi->latitudE }}','{{ $equi->longitudE }}', color,'E','40','37','{{ $item->nombre }}']); 
									@foreach ( $usuarios as $val)
											var idequipoUsu='{{ $val->idequipo }}';  
											//console.log(idZonaEquipo,idZonas);  
											if(idequipo===idequipoUsu){
											datamarker.push(['{{$val->nombres}}','{{ $val->latitud }}','{{ $val->longitud }}',color,'C','21','34','{{ $item->nombre }}']);
											} 	 
									@endforeach	 
							}  	
					@endif 
				@endforeach
			 
		@endforeach 
		///usuarios  
		//console.log(datamarker); 
		if(datamarker.length <1){
			datamarker.push(['SIN ZONA','-12.0463731','-77.042754', color,'E','40','37','SIN ZONA']);

		}
		
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
			mapTypeId: 'roadmap',
			streetViewControl: false,
			mapTypeControl: false, 
			//fullscreenControl:false,
		};
		// indicamos que cargue el mapa en la pagina 
		map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
		map.setTilt(50);
		map.controls[google.maps.ControlPosition.LEFT_TOP].push(input);
		  
		// llenamos los marcadores, latitude, y longitud
		var markers = datamarker;  
		//variable global para saber ubicacion de markers a limpiar 
		var markersLimpiar  = [];
		//variable global para limpiar markers 
		var marker ;
		var contentString = 'genio';
	
		pintar(markers);
		
		// agregamos los markadores 
		var infoWindow = new google.maps.InfoWindow(), marker, i;
		// buscamos e markador en el mapa el markador en el mapa  
		function pintar(markers){
			for( i = 0; i <= markers.length; i++ ) {
				//console.log(markers[i][1], markers[i][2]);
				//console.log(markers );

				var position = new google.maps.LatLng(markers[i][1], markers[i][2]); 

					bounds.extend(position);   
				
				//asigmamos color a la variable que cargara con el icno del marker 
				var pinColor = markers[i][3];
				//icono clientes 
	   		 var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld="+ markers[i][4]+"|"+pinColor );  
				 //variable que contendra la imagen a mostrar 
				 var image; 
				//asignamos una imagen de acuerdo al tipo de marker
				if ( markers[i][4]=="E"){ 
					//image=src="{{ asset('img/antena7.ico') }}";
					image=new google.maps.MarkerImage("{{ asset('img/antena7.ico') }}"); 
				}
				if ( markers[i][4]=="C"){ 
					image= pinImage; 
				}
				/*elseif( markers[i][4]=="C"){
					image= pinImage;
				}*/
				//pintamos los marker
				marker = new google.maps.Marker({
						position: position,
						map: map,
						title: markers[i][0],  
						icon: image	, 	
				});   
				//agregamos al marker un titulo 

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() { 
							infoWindow.open(map, marker);
							 
							if(markers[i][4]=="E"){
								infoWindow.setContent('EQUIPO: '+markers[i][0] +'/ ZONA: '+markers[i][7]); 

							}else{
								infoWindow.setContent('CLIENTE: '+markers[i][0] +'/ ZONA: '+markers[i][7]);
							} 	
						}
				})(marker, i)); 
				// centramos el mapa en medio de los marcadores
				markersLimpiar.push(marker);  
				map.fitBounds(bounds); 
			}

		} 
		//console.log(marker); 
		 // Establece el mapa en todos los marcadores de la matriz.para  
		 function setMapOnAll(map) {
			for (var i = 0; i < markersLimpiar.length; i++) {
			  markersLimpiar[i].setMap(map);
			}
		 } 
		$('#btnFiltro').on('click', function() {
			var input = $('#zona').val();
			//var map;
			var datamarkerBusqueda =  [];   
			//console.log(input); 
			setMapOnAll(null); 
			var color='';
			@foreach ($zonas as $item) 
			var idZonas= '{{ $item->id }}'; 
				 if(idZonas ==input){ 
					color='{{ $item->color}}';
						@foreach ( $equipos as $equi)   
							//var color = colorHEX();
							var idZonaEquipo='{{ $equi->idZona }}';
							@if ($equi->longitudE !== null)
								//console.log(color);
								var idequipo='{{ $equi->idequipo }}';
								//console.log(idequipo);
								if ( idZonas === idZonaEquipo)
									{
											datamarkerBusqueda.push(['{{$equi->modeloE}}','{{ $equi->latitudE }}','{{ $equi->longitudE }}', color,'E','40','37']); 
											@foreach ( $usuarios as $val)
													var idequipoUsu='{{ $val->idequipo }}';  
													//console.log(idZonaEquipo,idZonas);  
													if(idequipo===idequipoUsu){
													datamarkerBusqueda.push(['{{$val->nombres}}','{{ $val->latitud }}','{{ $val->longitud }}',color,'C','21','34']);
													} 	 
													//console.log(datamarkerBusqueda); 
											@endforeach	 
									}  	
							@endif 
						@endforeach 
				 }
			 
			@endforeach 
			
			var marker=datamarkerBusqueda;
			//console.log(marker5);
			pintar(marker); 
		   
		});
		  
		
	}
	
	//la funcion de inicializar
	google.maps.event.addDomListener(window, 'load', initMap);
	
</script>