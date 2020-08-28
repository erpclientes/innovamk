<div class="col s12 m6 l6">       	
	<select class="browser-default" id="idrouter" name="idrouter"> 
		<option value="" disabled="" selected="">Elija un router</option>
		@foreach ($router as $valor)
		@if($valor->idrouter == $idrouter)
			<option value="{{ $valor->idrouter }}" selected="">{{ $valor->alias }}</option>
		@else
			<option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
		@endif
		@endforeach
	</select>        
</div>
<div class="col s12 m6 l6">       	
	<select class="browser-default" id="interface" name="interface" > 
		<option value="LAN" disabled="" selected="">Seleccionar interface</option>
	</select>        
</div>
<div class="card gradient-shadow col s12" style="margin-top: 10px">
	<div id="container" style="height: 400px; margin: 0 auto"></div>
</div>

	
	
    


