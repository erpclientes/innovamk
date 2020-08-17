<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		  <title>COMPROBANTE DE PAGO</title>
		   <style>
			ul {
				columns: 2;
				-webkit-columns: 2;
				-moz-columns: 2;
			 }
		  </style> 

    </head>
    <body>  
		@foreach($factura as $fac) 
		@foreach($empresa as $emp)	
      <div class="container">
			<div class="row">
				<div class="col-xs-2">  
					<table> 
						<tbody>
							<tr> 
								<td><img src="{{asset('/images/Comprobante/infiniti.jpg')}}"  style="width:110px;height: 80px;"alt="infiniti"></td>
								<td></td> 
							</tr>                            
					  </tbody> 
					 </table> 
				</div>
				{{--  <div class="col-xs-1"></div>    --}}
				<div class="col-xs-5">  
					<table> 
						<tbody>
							<tr> 
								<td style="text-align: left;" > 								
									<b style="font-size: 70%;" >{{ $emp->nombre }}</b> <br>
									<p style="font-size: 65%;">
										Domicilio Fiscal: Calle San Jose 206, Cercado Arequipa Plaza de Armas Haquira s/n <br>
										AREQUIPA - AREQUIPA - AREQUIPA <br>
										Móvil: 956267980 - 997017574 <br>
										Email: ventas@infiniti.com.pe<br><br>
										Venta de accesiorios de camaras de seguridad y computo <br>
										Antenas - TV - WIFI - al por mayor y menor 
									</p>  
									
								</td>  
							</tr>                            
					  </tbody> 
					 </table> 
				</div> 
				<div class="col-xs-3" style="border-style: solid; width:210px;height:135px ;">  
					<table> 
						<tbody>
							<tr> 
								<td style="text-align: center;font-size: 110%;" >
									<br> 							
									<b>R.U.C. N°{{ $emp->RUC }}</b> <br> 
									<b>RECIBO DE VENTA </b><br> 
									<b>{{ $fac->serie."-".$fac->numero}}</b> <br>
									
								</td>  
							</tr>                            
					  </tbody> 
					 </table> 
				</div>  
		  </div> 
		  @endforeach   
		@foreach($cliente as $clie) 
		<div class="row" style="border-style: solid; width:710px;height:38px ;"> 
			<div class="col-xs-6"  >
				<table    style="font-size:50%;"> 
					<tbody  >  
							<tr>
								<td style="width:110px;" ><b>Nombres/Razón Social </b></td>
								<td>: {{ $clie->nombres }}  {{ $clie->apaterno }}  {{ $clie->amaterno }}</td> 
								<br><br><br>
							</tr>  
							<tr  > 
								<td><b>DNI/RUC</b></td>
								<td >: {{ $clie->nro_documento }}</td> <br><br>
							</tr> 
							<tr> 
							  <td><b>Dirección</b></td>
							  <td>: {{ $clie->direccion }}</td> <br><br>
							</tr>
							
					</tbody>
			  </table> 
			 </div>   
			<div class="col-xs-5"  >
				<table  style="font-size:50%;"> 
					<tbody >  
						<tr> 
							<td style="width:90px; "><b>Fecha emisión </b></td>
							<td>: {{$fac->fecha_emision}}</td> 
						 </tr>   
						@foreach($usuario as $user) 
						 <tr> 
							<td><b>Vendedor</b></td>
							<td>: {{ $user->nombre }}  {{ $user->apellidos }} </td> 
						 </tr>
						 @endforeach  
					</tbody>
			  </table> 
			</div> 
	  </div >  
		@endforeach  
		<div class="row"  style="  width:710px;height:50px;padding-top:2px">   
				<table  style="font-size: 57%;"> 
					  <thead style="background-color:#9D9D9D; "  >
							<tr  >
								 <th style="width:85px;border-style: solid;text-align: center;">Código</th> 
								 <th style="width:80px;border-style: solid;text-align: center;" >Cantidad</th>
								 <th style="width:85px;border-style: solid;text-align: center;" >Unidad</th>
								 <th style="width:280px;border-style: solid;text-align: center;">Descripción</th>
								 <th style="width:85px;border-style: solid;text-align: center;">Precio unitario</th> 
								 <th style="width:85px;border-style: solid;text-align: center;">Precio total
								</th>
							</tr>                            
					  </thead>
					  <tbody> 
								<?php 
									$total=null;
									foreach ($dfactura as $dfac) { 
									$e=0;
									$codigoF=null;
									
									
								?>
							<tr>
								@if (!is_null($dfac->idproducto)) 
									<td style="text-align: center;width:85px;border: solid;">{{ $dfac->idproducto }}</td> 
									<td style="text-align: center;width:80px;border: solid;">{{ $dfac->cantidad}}</td>
									<td style="text-align: center;width:85px;border: solid;">UNID.</td>

									@foreach ($equipos as $equipo)
												@if ( $dfac->idproducto ==  $equipo->idequipo )
													<td style="text-align: left;width:280px;border: solid;"  > 
														<b style="text-align:center; ">Equipo de Internet :</b><br>
														<b>descripción :</b> {{  $equipo->descripcion }} <br>  
														<b>marca:</b> {{  $equipo->marca }} <br>
														<b>modelo :</b> {{  $equipo->modelo }}
													</td> 
												@endif  
									@endforeach
										
								@endif
								@if (!is_null($dfac->idservicio))
									<td style="text-align: center;width:85px;border: solid;">{{ $dfac->idservicio }}</td>
									<td style="text-align: center;width:80px;border: solid;">{{ $dfac->cantidad}}</td>
									<td style="text-align: center;width:85px;border: solid;">UNID.</td>
									@foreach ($servicio as $serv )
										@if ($serv->idservicio==$dfac->idservicio)
												@foreach ($planes as $plan)
													@if ( $serv->perfil_internet ==  $plan->idperfil )
														<td style="width: 280px;border: solid;"  >
															<b style="text-align: center;">Servicio de Internet Banda ancha :</b> <br>
															<b>Plan de Internet :</b> {{  $plan->name }} <br>
															<b>Descarga :</b> {{  $plan->vbajada }} <br>
															<b>Subida :</b> {{  $plan->vsubida }}
														</td> 
													@endif  
												@endforeach
											
										@endif 
									@endforeach
									 
										
								@endif 
								@if (!is_null($dfac->idconcepto))
									<td style="text-align: center;width:85px;border: solid;">{{ $dfac->idconcepto }}</td>
									<td style="text-align: center;width:80px;border: solid;">{{ $dfac->cantidad}}</td>
									<td style="text-align: center;width:85px;border: solid;">UNID.</td>
									<td style="text-align: left;font-size:85%;border: solid;"  >
										    {{ $dfac->descripcion }}									 
									</td> 
									 
										
								@endif  
								<?php $total=$total+$dfac->total;?>   
								<td style="width:85px;border: solid; text-align: center;">{{ $dfac->precio }}</td> 
								<td style="width:85px;border: solid; text-align: center;">{{ $dfac->total }}</td>
							</tr>
									<?php }  ?> 
								<tr>
									<td colspan="6" style="background-color:#FFFFFF;border: solid;"><div style="width:100px;text-align: center;">SON: {{ $total }} SOLES</div></td>
									
								</tr> 
								<tr  >
									<td colspan="3" style="background-color:#FFFFFF;"></td>
									<td  style="text-align: center;  background-color:#F7F6F6;"><b>Importe Total </b></td>
									<td  style="text-align: center;  background-color:#F7F6F6;"><b>S/ </b></td>
									<td style="text-align: center; background-color:#F7F6F6;"><b>{{ $total }} </b></td>
								</tr>  
					  </tbody>
				 </table> 
				 <p style="font-size:55%;"><b>NUMERO DE CUENTA PARA REALIZAR PAGOS Y/O TRANSFERNCIA</b></p> 
				 <table  style="font-size: 57%;">  
					<thead style="background-color:#9D9D9D; ">
						 <tr>
							<th style="border-style: solid;text-align: center;width: 30px;">BANCO</th> 
							<th style="border-style: solid;text-align: center;width: 35px;" >MONEDA</th>
							<th style="border-style: solid;text-align: center;width: 70px;" >CUENTA</th>
							<th style="border-style: solid;text-align: center;width: 100px;" >Nº</th>
							<th style="border-style: solid;text-align: center;width: 105px;">CUENTA TITULAR</th> 
						 </tr>                            
					</thead>
					<tbody> 
							  
						 <tr>    
							 <td style="border: solid; text-align: center;width: 30px;">BCP</td> 
							 <td style="border: solid; text-align: center;width: 35px;">SOLES</td>
							 <td style="border: solid; text-align: center;width: 70px;">CORRIENTE</td> 
							 <td style="border: solid; text-align: center;width: 100px;">  </td>
							 <td style="border: solid; text-align: center;width: 105px;"> </td>  
						 </tr>
						 <tr>    
							<td style="border: solid; text-align: center;width: 30px;">BCP</td> 
							<td style="border: solid; text-align: center;width: 35px;">SOLES</td>
							<td style="border: solid; text-align: center;width: 70px;">CORRIENTE</td> 
							<td style="border: solid; text-align: center;width: 100px;">  </td>
							<td style="border: solid; text-align: center;width: 105px;"> </td>  
						</tr>  
					</tbody>
			  </table>
				
			 
	  </div> 
		</div>
	@endforeach
    </body>
</html>