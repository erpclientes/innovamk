	<script>
		
		$("#color").focus(function(){ 
			$('#modalcolores').modal('open'); 


	}) ;
	$('#guardar').click( function(e) {
		$('#modalcolores').modal('close');
		
		var color1 = $('#color1').val();
		$('#color').val(color1); 
	} );
	$('#cancelar').click( function(e) {
		$('#modalcolores').modal('close');
		
	} );
	$(document).ready(function(){
		
		$('body').on('click', '.col div', function(){ 
		$div = this.innerHTML;
		var colores = this.innerHTML; 
		//console.log(colores.substr(1,7));  
		//$('#color').val(colores.substr(1,7));
		$('#color1').val(colores.substr(1,7)); 
		$('#color1').focus(); 
		



		})
		
	});
	

	</script>