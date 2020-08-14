@extends('layouts2.app')
@section('titulo','Lista de Clientes')


@section('main-content') 
<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> 
<div id="modal1" class="modal">
	<iframe src="{{url('/mapa') }}" title=" " style="width: 110%; height:750px;">
	</iframe>
 </div> 
@endsection



