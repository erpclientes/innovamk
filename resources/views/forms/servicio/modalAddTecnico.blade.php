<div id="modalAddTecnico" class="modal modal-fixed-footer">  
	<div class="card-header">                    
		<i class="fa fa-table fa-lg material-icons">receipt</i>
		<h2>LISTA DE TECNICOS</h2>   
	</div> 
	<div class="row card-header sub-header"  >
		<div class="col s12 m12 herramienta">   
			<center><h5>TECNICOS</h5></center>  
		</div>  
		@include('forms.scripts.modalInformacion')  
	</div>
			<div class="row cuerpo">
				<?php 

				$bandera = false;

				if (count($tecnicos) > 0) {
					# code...
					$bandera = true;
					$i = 0;
				}

				?> 
				<br>
				<div class="row">  
						<div class="card-content">
							Existen <?php echo ($bandera)? count($tecnicos) : 0; ?> registros. <br><br>
							<table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display" cellspacing="0">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Sexo</th>
										<th>Dirección</th>
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
										<th>Sexo</th>
										<th>Dirección</th>
										<th>Acción</th>
									</tr>
									</tfoot>

								<tbody>
									<tr>
									<?php 
											foreach ($tecnicos as $datos) {
											$i++;
										?>
										<td><?php echo $i; ?></td>
										<td>
											 {{$datos->nombre}} {{$datos->apaterno}} {{$datos->amaterno}} 
										</td>
										<td> 
											 
											@if ($datos->sexo=='1')
												<p>FEMENINO</p>											 
											@else
												 <p>MASCULINO</p>
											@endif
										</td>
										<td><?php echo $datos->direccion ?></td>
										<td class="center" style="width: 9rem">
											<a  class="btnSeleccionarTecnico btn-floating  waves-light grey lighten-5 tooltipped modal-trigger" data-tooltip="Seleccionar Tecnico"
											data-id="{{$datos->idtecnico}}"
											data-nombre="{{$datos->nombre}} {{$datos->apaterno}} {{$datos->amaterno}}"
											data-nro_documento="{{$datos->nro_documento}}"
											><i class="material-icons " style="color: #2E7D32">check</i></a>
										</td>
									</tr> 
									<?php }} ?>
								</tbody>
							</table>
						</div>  
				</div>
			</div>


</div>

