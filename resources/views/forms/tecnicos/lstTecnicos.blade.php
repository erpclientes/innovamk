@extends('layouts2.app')
@section('titulo','Tecnicos')

@section('main-content') 

<div class="row">
	<div class="col s12 m12 l12" >
					  <div class="card"  style="margin: auto; width: 87%">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>LISTA DE TECNICOS</h2>
						 </div>
						
						 <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
								 <div class="col s12 m12">
									<a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('tecnicos/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
									  <i class="material-icons" style="color: #03a9f4">add</i>
									</a>
									<a style="margin-left: 6px"></a>                          
																			  
								 </div>  
								 @include('forms.scripts.modalInformacion')   
						 </div>
												 
						 <div class="row cuerpo">
							<?php 
 
							  $bandera = false;
 
							  if (count($Tecnicos) > 0) {
								 # code...
								 $bandera = true;
								 $i = 0;
							  }
 
							?>
 
						 <br>
						 <div class="row">
							<div class="col s12 m12 l12">
							  
								 <div class="card-content">
									Existen <?php echo ($bandera)? count($Tecnicos) : 0; ?> registros. <br><br>
									<table id="data-table-simple" class="responsive-table display" cellspacing="0">
										  <thead>
											  <tr>
												  <th>#</th> 
												  <th>Nombre</th>
												  <th>Apellidos</th>
													<th>Fecha nacimiento</th> 
												  <th>Sexo</th>
												  <th>Zona</th> 
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
												  <th>Nombre</th>
												  <th>Apellidos</th>
													<th>Fecha nacimiento</th> 
												  <th>Sexo</th>
												  <th>Zona</th> 
												  <th>Estado</th>
												  <th>Acción</th>
											  </tr>
											</tfoot>
 
										  <tbody>
											<tr>
											  <?php 
													foreach ($Tecnicos as $datos) {
													$i++;
													$e=0; 

													 
												?>
												  <td><?php echo $i; ?></td>
												   
												  <td><?php echo $datos->nombre ?></td>
												  <td>  {{ $datos->apaterno }} {{ $datos->amaterno }}</td>

												    
												  <td><?php echo $datos->fecha_nacimiento ?></td>
												   
												  <td><?php   
													 if($datos->sexo =='2'){
														$sex='MASCULINO'; 
													 }
													if($datos->sexo =='1'){
														$sex='FEMENINO'; 
													} 
													?> {{ $sex }}</td> 
												  <td> 
													  @foreach ($zonas as $zona)
														@if ($datos->idZona ==$zona->id )
														{{ $zona->nombre }} 	
														@endif 
													  @endforeach 
												</td> 

												  <td>
														@if($datos->estado == 2)
														<div id="u_estado" class="chip center-align" style="width: 70%">
																<b>NO DISPONIBLE</b>
															<i class="material-icons"></i>
														</div>
														@endif
														@if($datos->estado == 1)
														<div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
															<b>ACTIVO</b>
															<i class="material-icons"></i>
														</div>
														@endif
												  </td>
												  <td class="center" style="width: 9rem">
													 <a href="{{ url('/tecnicos/mostrar') }}/{{$datos->idtecnico}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
													  <i class="material-icons" style="color: #7986cb ">visibility</i>
													</a>                                       
													 <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
													  <i class="material-icons" style="color: #dd2c00">remove</i>
													</a>
													@if($datos->estado == 1)                                      
													 <a href="#h_confirmacion2{{$datos->idtecnico}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
													  <i class="material-icons" style="color: #757575 ">clear</i></a>
													 @else
													 <a href="#h_confirmacion3{{$datos->idtecnico}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
													  <i class="material-icons" style="color: #2e7d32 ">check</i></a>
													 @endif
												  </td>
											  </tr> 
											  @include('forms.tecnicos.scripts.confirmacion1')
											  @include('forms.tecnicos.scripts.confirmacion2')
											  @include('forms.tecnicos.scripts.confirmacion3')


											  

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

 
