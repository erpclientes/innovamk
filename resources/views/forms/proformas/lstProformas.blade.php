@extends('layouts2.app')
@section('titulo','proformas')

@section('main-content') 
<br>
<div class="row" style="margin: auto; width: 96%" >
	<div class="col s12 m12 l12" style="margin: auto; width: 96%">
					  <div class="card">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>LISTA DE PROFORMAS</h2>
						 </div>
						
						 <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
								 <div class="col s12 m12">
									<a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger"  
									href="{{ url('/proformas/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
									  <i class="material-icons" style="color: #03a9f4">add</i>
									</a>
									<a style="margin-left: 6px"></a>                          
																			  
								 </div>  
								 @include('forms.scripts.modalInformacion')  
						 </div>
												 
						<div class="row cuerpo">
							<?php  
							  $bandera = false;
 
							  if (count($proformas) > 0) {
								 # code...
								 $bandera = true;
								 $i = 0;
							  } 
							?>
 
							<br>
							<div class="row">
								<div class="col s12 m12 l12">
								
									<div class="card-content">
										Existen <?php echo ($bandera)? count($proformas) : 0; ?> registros. <br><br>
										<table id="data-table-simple" class="responsive-table display" cellspacing="0">
											<thead>
												<tr>
													<th>#</th> 
													<th>Nro.Documento</th>
													<th>Descripción</th> 
													<th>Cliente</th>
													<th>Fecha creación</th>
													<th>Fecha Vencimiento</th> 
													<th>Estado</th>
													<th>Acción</th>
												</tr>
											</thead>
											<?php
													if($bandera){                                                           
												?>
											<tfoot>
												<tr>
													<th>#</th> 
													<th>Nro.Documento</th>
													<th>Descripción</th> 
													<th>Cliente</th>
													<th>Fecha creación</th>
													<th>Fecha Vencimiento</th>

													<th>Estado</th>
													<th>Acción</th>
												</tr>
												</tfoot>
	
											<tbody>
												<tr>
												<?php 
														foreach ($proformas as $datos) {
														$i++;
														$e=0;
														
													?>
													<td>{{ $i }}</td>
														
													<td>{{ $datos->serie.' - '.$datos->numero  }}</td>
													<td><?php echo substr($datos->descripcion,0,30) ?></td> 
													<td>														
														@foreach ($clientes as $clie)
															@if($clie->idcliente == $datos->idcliente)
																{{$clie->nombres.' '.$clie->apaterno.' '.$clie->amaterno}}
															@endif
														@endforeach
													</td>
													<td>
														<?php 
															$originalDate = $datos->fecha_emision ;
															$newDate = date("d/m/Y", strtotime($originalDate)); 
														?>
														{{ $newDate }}	 
													</td> 
													<td> 
														<?php 
															$originalDateFin = $datos->fecha_vencimiento ;
															$newDateFin = date("d/m/Y", strtotime($originalDateFin)); 
														?>
														{{ $newDateFin }}	

													</td>
													<td>
														@if($datos->estado == 0)
														<div id="u_estado" class="chip center-align" style="width: 70%">
																<b>NO DISPONIBLE</b>
															<i class="material-icons"></i>
														</div>
														@else
														<div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
															<b>ACTIVO</b>
															<i class="material-icons"></i>
														</div>
														@endif
												  </td>
													<td class="center" style="width: 9rem"> 
														<a href="{{url('/proformas/mostrar')}}/{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Descargar PDF">
															<i class="material-icons grey-text text-darken-2">vertical_align_bottom</i></a>
														
														<a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
														<i class="material-icons" style="color: #dd2c00">remove</i>
														</a>


														{{--  @if($datos->estado == 1)                                      
														<a href="#h_confirmacion2{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
														<i class="material-icons" style="color: #757575 ">clear</i></a>
														@else
														<a href="#h_confirmacion3{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
														<i class="material-icons" style="color: #2e7d32 ">check</i></a>
														@endif  --}}

														
													</td>
												</tr> 
												@include('forms.proformas.alertaConfirmacion')
												<?php }} ?>
											</tbody>
										</table>
										</div>
								
							</div>
	
							</div>
					  	</div>  
						  




					</div>
 </div>


 
@endsection

@section('script')
	
	 
@endsection

 
