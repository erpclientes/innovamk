@extends('layoutsMapa.app')
 
@section('titulo','Mapa de Usuarios') 

 

@section('main-content')

 
<div style="width: 100%;height: 90%; padding-left: 0px;	padding-right: 0px;" id="mapCanvas"></div> 
<div class="row " id="leyenda" style="width: 25vw;padding-left: 0px;	padding-right: 0px;">
	<div class="col s13 m10 l6" style="padding-right: 2px;">
	  <div class="card-panel darken-1" style="background-color: #E6F4FF{{-- AADAFF --}};">
		  <center style="background-color: white; padding-left: 0px;	padding-right: 0px;"><span>LEYENDA</span></center>
		<ul class="collapsible">
			<li>
				@foreach ($zonas as $item) 
				<div class="collapsible-header">
					<span><a style="background-color: #{{ $item->color }}; width:15px;height:15px;" class="btn-floating btn-Tiny waves-effect waves-light  "> </a> 
							 {{ $item->nombre }}</span>
				</div>  
				@endforeach  
				
			</li>
		  
		 </ul> 		 
	  </div>
	</div>

	<div class="col s13 m20 l6" style="padding-left: 4px;">
		<div class="card-panel darken-1" style="background-color: #E6F4FF{{-- AADAFF --}};">
			<center style="background-color: white; padding-left: 0px;	padding-right: 0px;"><span>FILTRO</span></center> 
		  <ul>
			 <li>
				 <select style="background-color: white;" class="browser-default" id="zona" name="zona" required> 
					 <option value="" disabled>Seleccione</option>
					 @foreach($zonas as $fp)
					 <option style="background-color:{{$fp->color}};" value="{{$fp->id }}"  >{{$fp->nombre}}</option>
					 @endforeach
				  </select>   
			 </li> 
		 </ul>
		 <ul>
			 <center>
				<li>
					<a  id="btnFiltro" {{--  style="width:8vw;"  --}} class=" col m15 l12 waves-effect waves-light btn">FILTRO</a>
				 </li>
			 </center>
				 
		</ul>
		<br>	
		<ul></ul> 
		</div>
	 </div> 
 </div>  
@endsection 

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCau_UwFedPo-8s5LgR5O62tbJFSTQwT3A"></script>
@section('script') 
@include('forms.clientes.scripts.lstClientesMapa') 
@endsection



	 
	 
 
	
 