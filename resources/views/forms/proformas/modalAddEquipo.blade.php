<div id="modalAddEquipo" class="modal modal-fixed-footer">  
			<div class="card-header">                    
				<i class="fa fa-table fa-lg material-icons">receipt</i>
				<h2>LISTA DE EQUIPOS</h2>   
			</div> 
			<div class="row card-header sub-header"  >
				<div class="col s12 m12 herramienta">   
					<center><h5>Equipos</h5></center>  
				</div>  
				@include('forms.scripts.modalInformacion')  
			</div>
					<div class="row cuerpo">
						<?php 

						$bandera = false;

						if (count($equipos) > 0) {
							# code...
							$bandera = true;
							$i = 0;
						}

						?> 
						<br>
						<div class="row">  
								<div class="card-content">
									Existen <?php echo ($bandera)? count($equipos) : 0; ?> registros. <br><br>
									<table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display" cellspacing="0">
										<thead>
											<tr>
												<th>#</th>
												<th>Marca</th>
												<th>Modelo</th>
												<th>Descripción</th>
												<th>Acción</th>
											</tr>
										</thead>
										<?php
												if($bandera){                                                           
											?>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Marca</th>
												<th>Modelo</th>
												<th>Descripción</th>
												<th>Acción</th>
											</tr>
											</tfoot>

										<tbody>
											<tr>
											<?php 
													foreach ($equipos as $datos) {
													$i++;
												?>
												<td><?php echo $i; ?></td>
												<td>
													@foreach($marca as $val)
													@if($val->idmarca == $datos->idmarca)
														{{$val->descripcion}}
													@endif
													@endforeach
												</td>
												<td>
													@foreach($modelo as $val)
													@if($val->idmodelo == $datos->idmodelo)
														{{$val->descripcion}}
													@endif
													@endforeach
												</td>
												<td><?php echo $datos->descripcion ?></td>
												<td class="center" style="width: 9rem">
													<a  class="btnSeleccionarEquipo btn-floating waves-effect waves-light grey lighten-5 tooltipped  " data-tooltip="Seleccionar Equipo"
													
													data-id="{{$datos->idequipo}}" 
													data-descripcion="{{$datos->descripcion}}" 
													data-marca="{{$datos->marca}}"
													data-modelo="{{$datos->modelo}}" 
													data-precio="{{$datos->precio}}"  
													
													
													><i class="material-icons " style="color: #2E7D32">check</i></a>
												</td>
											</tr>
												@include('forms.equipos.scripts.alertaConfirmacion')
											<?php }} ?>
										</tbody>
									</table>
								</div>  
						</div>
					</div>
	   
 
</div>
  
