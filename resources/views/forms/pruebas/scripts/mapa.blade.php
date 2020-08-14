<script>
	$(document).ready(function() {
	load_map(); 
	});
 
var map;   
var infoWindow = null; 
var myLatlng ;
var marker;
var autocomplete;
	
 
function load_map() {
			myLatlng = new google.maps.LatLng(-5.8974587,-76.1113498);
			infoWindow = new google.maps.InfoWindow();
			var myOptions = {
				zoom: 14,
				center: myLatlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				streetViewControl: false,
			}; 
			//creamos el mapa 
			map = new google.maps.Map($("#map_canvas").get(0), myOptions);
			marker = new google.maps.Marker({
				position: myLatlng,
				draggable: true,
				map: map, 
			}); 
			openInfoWindow(marker);
			map.addListener('center_changed', function() {
				// despues de 9 segundos centra el mapa al markador
				// marker.
				openInfoWindow(marker);
				$('#latitude').val(marker.getPosition().lat());
				$('#longitude').val(marker.getPosition().lng());
				

				window.setTimeout(function() {
				  map.panTo(marker.getPosition());
				}, 9000);
			 });
 
			 input = document.getElementById("address");
			 autocomplete = new google.maps.places.Autocomplete(input);
			 

			//var instances = M.Autocomplete.init(elems, autocomplete	);

			
			  
			 			 
}
 
function openInfoWindow(marker) {
		  //muestra la informacion del markador
		var markerLatLng = marker.getPosition();
		infoWindow.setContent([ 
			markerLatLng.lat(),
			',',
			markerLatLng.lng(),
		].join(''));
		infoWindow.open(map, marker);
	}
$('#search').on('click', function() {
			$("#ActualizarDireccion").css("display", "block");
			// Obtenemos la dirección y la asignamos a una variable
			var address = $('#address').val();
			// Creamos el Objeto Geocoder
			var geocoder = new google.maps.Geocoder();
			// Hacemos la petición indicando la dirección e invocamos la función
			// geocodeResult enviando todo el resultado obtenido
			geocoder.geocode({ 'address': address}, geocodeResult);			
});
$('#searchCor').on('click', function() {
	$("#ActualizarDireccion").css("display", "block");
	var geocoder = new google.maps.Geocoder();
	//var marker = new google.maps.Marker( draggable: true);
	var input = $('#latlng').val();
	var inputLog = $('#latlog').val();
	var lat = parseFloat(input);
	var lng = parseFloat(inputLog );
	var latlng = new google.maps.LatLng(lat, lng);
	marker.addListener('click', function() {
		openInfoWindow(marker);
	 });
	geocoder.geocode({'latLng': latlng},geocodeResult ); 
}); 

$("#group1").click(function(evento){
	// radio group buscar por direccion  
	$("#texto").css("display", "none");
	$("#coordenadas").css("display", "none");
	  $("#direcciones").css("display", "block"); 
	 // $("#ActualizarDireccion").css("display", "block");

});
$("#group2").click(function(evento){
	//radio group buscar por coordenadas 
  $("#coordenadas").css("display", "block");	
  $("#direcciones").css("display", "none"); 
  $("#texto").css("display", "none");
 // $("#ActualizarDireccion").css("display", "block");
});
 

function geocodeResult(results, status) {
	// Verificamos el estatus
	if (status == 'OK') {
		 // Si hay resultados encontrados, centramos y repintamos el mapa
		 // esto para eliminar cualquier pin antes puesto
		 // fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
		 map.fitBounds(results[0].geometry.viewport);
		 // Dibujamos un marcador con la ubicación del primer resultado obtenido
		 marker.setPosition(results[0].geometry.location); 
		 marker.setMap(map);
		$('#latitude').val(marker.getPosition().lat());
		$('#longitude').val(marker.getPosition().lng());
		$('#direccionf').val(results[0].formatted_address);
		openInfoWindow(marker);
	} else {
		 // En caso de no haber resultados o que haya ocurrido un error
		 // lanzamos un mensaje con el error
		 alert("Geocoding no tuvo éxito debido a: " + status);
	}
}
</script>