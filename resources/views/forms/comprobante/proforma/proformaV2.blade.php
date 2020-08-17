<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		  <title>PROFORMA</title>
		   <style>
			ul {
				columns: 2;
				-webkit-columns: 2;
				-moz-columns: 2;
			 }
		  </style> 

    </head>
    <body>  
		@foreach($proformas as $fac) 
      <div class="container">
			<div class="row">
				<div class="col-xs-5">  
					<table> 
						<tbody>
							<tr> 
								<td><img src="{{asset('/images/Comprobante/infiniti.jpg')}}"  style="width:190px;height: 100px;"alt="infiniti"></td>
								<td><img src="{{asset('/images/Comprobante/NAVI TEL OFICIAL.jpg')}}"  style="width:200px;height: 180px;"alt="NAVI"></td> 
							</tr>                            
					  </tbody> 
					 </table> 
				</div>
				<div class="col-xs-1"></div>  
				<div class="col-xs-6">  
					<table> 
						<tbody>
							<tr> 
								<td style="text-align: right;" >
									@foreach($empresa as $emp)									
									 {{"PROFORMA"." : ".$fac->serie."-".$fac->numero}} <br>
									{{ $emp->nombre }} <br>
									Calle 28 de julio 301,Santo Tomas <br>
									ventas@infiniti.com.pe <br>
									Navitelecomunicaciones@gmail.com <br>
									Plaza de Armas Haquira  s/n <br>
									Cel.{{$emp->telefono   }}  
									@endforeach 
									
								</td>  
							</tr>                            
					  </tbody> 
					 </table> 
				</div>   
		  </div>
		<hr style="margin-top: 4px"> 
		@foreach($cliente as $clie) 
		<div class="row" style="text-align: center;"> 
			<div class="col-xs-5"  >
				<table  class="table table-hover table-striped " style="font-size:75%;"> 
					<tbody  >  
							<tr style=" border: 0ex;" >
								<td style="background-color: #FFCE87; border: 0ex;width:80px;"><b>Cliente: </b></td>
								<td style=" border: 0ex; ">{{ $clie->nombres }}  {{ $clie->apaterno }}  {{ $clie->amaterno }}</td> 
							</tr> 
							<tr style=" border: 0ex; border: 0ex;"> 
								<td style="background-color: #FFCE87 ;  border: 0ex;"><b>DNI/RUC:</b></td>
								<td style=" border: 0ex;"> {{ $clie->nro_documento }}</td> 
							 </tr>
							<tr style=" border: 0ex;" > 
							  <td style="background-color: #FFCE87 ;border: 0ex; "><b>Dirección:</b></td>
							  <td style=" border: 0ex;"> {{ $clie->direccion }}</td> 
							</tr>
							<tr style=" border: 0ex;" > 
							  <td style="background-color: #FFCE87 ;border: 0ex; "><b>Telefono:</b></td>
							  <td style=" border: 0ex;">{{ $clie->telefono1 }}</td> 
							</tr>
							<tr style=" border: 0ex;" > 
							  <td style="background-color: #FFCE87 ;border: 0ex; "><b>Forma de pago:</b></td>
							  <td style=" border: 0ex;">FISICO/EFECTIVO</td> 
							</tr> 
							
					</tbody>
			  </table> 
			 </div>   
			<div class="col-xs-5" >
				<table  class="table table-hover table-striped"  style="font-size:75%;"> 
					<tbody > 
							@foreach($usuario as $user) 
							<tr style=" border: 0ex;"> 
							<td style="background-color: #FFCE87 ; border: 0ex;width:60px;  "><b>Ejecutivo de ventas:</b></td>
							<td style=" border: 0ex;"> {{ $user->nombre }}  {{ $user->apellidos }} </td> 
							</tr>
							@endforeach 
								
							 <tr style=" border: 0ex; border: 0ex;">
								 <td style="background-color: #FFCE87;  border: 0ex;"><b>Sede: </b></td>
								 <td style=" border: 0ex;">HAQUIRA </td> 
							 </tr> 
							 

							 <tr style=" border: 0ex; border: 0ex;"> 
								<td style="background-color: #FFCE87 ; border: 0ex; "><b>F.Emisión:</b></td>
								<?php 
									$originalDate = $fac->fecha_emision ;
									$newDate = date("d/m/Y", strtotime($originalDate)); 
								?>

								<td style=" border: 0ex;"> {{  $newDate }}</td> 
								 
							 </tr>
							 <tr style=" border: 0ex; border: 0ex;"> 
								<td style="background-color: #FFCE87 ; border: 0ex; "><b>F.Vencimiento:</b></td>
									<?php 
										$originalDateFin = $fac->fecha_vencimiento ;
										$newDateFin = date("d/m/Y", strtotime($originalDateFin)); 
										//dd($newDateFin);
									?>  
								<td style=" border: 0ex;"> {{ $newDateFin }}	 </td> 
								
							 </tr>
							  


					</tbody>
			  </table> 
			</div> 
	  </div>  
		@endforeach 
	  <hr style="margin-top: 3px"> 
		<div class="row">                
			<div class="col-xs-12">
				<?php 
 
							  $bandera = false;
 
							  if (count($dproforma) > 0) {
								 # code...
								 $bandera = true;
								 $i = 0;
							  }
 
				?> 
				<table class="table table-hover table-striped" style="font-size:80%;">
					  <thead style="background-color: orange;text-align: center; "  >
							<tr>
								<th>#</th>
								 <th>CANT.</th>
								 <th>UNID.</th>
								 <th>CODIGO</th> 
								 <th>DESCRIPCIÓN</th>
								 <th>P.UNIT.</th> 
								 <th >IMPORTE</th>
							</tr>                            
					  </thead>
					  <tbody> 
						<?php 
							$total=null;
							foreach ($dproforma as $dprof) {
							$i++;
							$e=0;
							$codigoF=null;
							
							
						?>
							<tr>
								<td>{{ $i }}</td>
								<td style="text-align: center;">1</td>
								<td style="text-align: center;">UNID.</td> 
								<?php  
									$total=$total+$dprof->subtotal; 
								?>

									@if (!is_null($dprof->idplan))
									<td style="text-align: center;">{{ $dprof->idplan }}</td>
										@foreach ($planes as $plan)
											@if ( $dprof->idplan ==  $plan->idperfil )
												<td style="text-align: left;font-size:80%;padding-top: 0ex;"  >
													<b style="text-align: center;">Servicio de Internet Banda ancha :</b> <br>
													<b>Plan de Internet :</b> {{  $plan->name }} <br>
													<b>Descarga :</b> {{  $plan->vbajada }} <br>
													<b>Subida :</b> {{  $plan->vsubida }}
												</td> 
											@endif  
										@endforeach
									@endif 
									@if (!is_null($dprof->idequipo))
									<td style="text-align: center;">{{ $dprof->idequipo }}</td>
											@foreach ($equipos as $equipo)
												@if ( $dprof->idequipo ==  $equipo->idequipo )
													<td style="text-align: left;font-size:80%;padding-top: 0ex;"  > 
														<b style="text-align:center; ">Equipo de Internet :</b><br>
														<b>descripción :</b> {{  $equipo->descripcion }} <br>  
														<b>marca:</b> {{  $equipo->marca }} <br>
														<b>modelo :</b> {{  $equipo->modelo }}
													</td> 
												@endif  
											@endforeach
										
									@endif 
									@if (!is_null($dprof->idconcepto))
									<td style="text-align: center;">{{ $dprof->idconcepto }}</td>
									<td style="text-align: center;">{{ $dprof->descripcion }}</td>
										
									@endif 

								
								


								<td>{{ $dprof->precio }}</td> 
								<td >{{ $dprof->subtotal }}</td>
							</tr>
						<?php }       ?>  
							<tr>
								<td colspan="4" style="background-color:#FFFFFF;"></td>
								<td colspan="2" style="text-align: center;  background-color:#F7F6F6;"><b>TOTAL</b></td>
								<td style="text-align: center; background-color:#F7F6F6;"><b>S/{{ $total }} </b></td>
							 </tr>  
					  </tbody>
				 </table>
				
			</div>
	  </div>  
	  <hr style="margin-top: 3px"> 
	  <div class="row">                
		<div class="col-xs-11">	 
			<table  class="table-striped" style="font-size:80%;">
				  <thead  >
						<tr> 
							 <th colspan="2" ><b>CONDICIONES:</b></th> 
						</tr>                            
				  </thead>
				  <tbody>  
						<tr> <td style="width:10px;"></td>
							<td >- propuesta valida por 15 dias.</td> 
						</tr> 
						<tr> 
							<td></td>
							<td >- Equipos en calidad de comodato,cesion en uso,    arrendamiento o cualquier otra modalidad que no implique su transferencia. </td> 
						</tr> 
						<tr> 
							<td></td>
							<td >- Tiempo de permanencia minima 12 meses ,  si el contrato es menos de 12 meses el costo de instalacion es de  s/.399 por fibra.</td>
							
						</tr> 
						<tr> 
							<td></td>
							<td >- La penalidad por retiro anticipado es de s/ 599.00  Soles. </td> 
						</tr> 
						<tr>
							<td></td>
							<td >- Tiempo de permanencia de contrato acordado:12 meses</td>  
						</tr>
						<tr>
							<td></td>
							<td >- Internet con contencion 4:1, velocidad garantizada al 50% del plan contratado.No incluye antivirus licenciado,lp publica, configuracion de VPN,VLAN,U otros  de configuracion avanzada. </td>

						</tr>
						<tr>
							<td></td>
							<td >- Los pagos de la mensualidad son prepago.</td> 
						</tr>

						 
				  </tbody>
			 </table>
			
		</div>
  </div> 




		</div>
	@endforeach
    </body>
</html>