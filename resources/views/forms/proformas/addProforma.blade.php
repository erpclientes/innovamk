@extends('layouts2.app')
@section('titulo','proformas')


@section('main-content') 
	

<div class="row" style="margin: auto; width: 94%">
	
	<div class="col s12 m12 l12" style="margin: auto; width: 94%">
					  <div class="card">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>REGISTRAR PROFORMAS  </h2>
						 </div>
						 <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
							 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
							<div class="row card-header sub-header">
									<div class="col s12 m12 herramienta">                         
										<a id="addProform" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
										<i class="material-icons blue-text text-darken-2">check</i></a>
										<a style="margin-left: 6px"></a>   
										
										<a href="{{url('/proformas')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
										<i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
									</div>  
	
									@include('forms.scripts.modalInformacion')              
									
							</div> 
							<div class="row" style="margin-bottom: 2px ;margin: auto; width: 96%">                                        
								<div class="card white">
									<div class="card-content" style="padding-bottom: 5px; padding-top: 10px">
										<span class="card-title">Datos Generales</span>
						
										<div class="col s12 m6 l6">                                                                
											<label for="iddocumentoPro">Documento</label>
											@foreach($parametros as $datos)
											@if($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'SI')
												<select class="browser-default" id="iddocumentoPro" name="iddocumentoPro" required disabled> 
												<option value="COD" disabled selected="">Código interno</option>                                  
												</select>
											@elseif($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'NO')
												<select class="browser-default" id="iddocumentoPro" name="iddocumentoPro" required> 
												<option value="" disabled selected="">Seleccione</option>
												@foreach($tipo_documento as $documento)
												<option value="{{$documento->iddocumento}}">{{$documento->dsc_corta}} - {{$documento->descripcion}}</option> 
												@endforeach                                                                                  
												</select>
											@endif
											@endforeach
											<div id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
										</div>                    
										<div class="input-field col s12 m6 l6">
											<i class="material-icons prefix active">label_outline</i>
											@foreach($parametros as $datos)
											@if($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'SI')
											<input id="nro_documentoPro" name="nro_documentoPro" type="text" data-error=".errorTxt2" maxlength="20" disabled onkeyup="mayus(this);">
											@elseif($datos->parametro == 'ADD_COD_INTERNO' and $datos->valor == 'NO')
											<input id="nro_documentoPro" name="nro_documentoPro" type="text" data-error=".errorTxt2" maxlength="20" onkeyup="mayus(this);">
											@endif
											@endforeach
											<label for="nro_documentoPro">Nro. Documento</label>
											<div id="error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
										</div>        
										<div class="input-field col s12 m6 l6">
											<i class="material-icons prefix">perm_identity</i>
											<input id="apaternoPro" name="apaternoPro" type="text" data-error=".errorTxt3">
											<label for="apaternoPro">Apellido Paterno</label>
											<div id="error3" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
										</div>
										<div class="input-field col s12 m6 l6">
											<i class="material-icons prefix">perm_identity</i>
											<input id="amaternoPro" name="amaternoPro" type="text" data-error=".errorTxt4">
											<label for="amaternoPro">Apellido Materno</label>
											<div id="error4" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
										</div>   
										<div class="input-field col s12 m6 l6">
											<i class="material-icons prefix">person</i>
											<input id="nombresPro" name="nombresPro" type="text" data-error=".errorTxt5">
											<label for="nombresPro">Nombres</label>
											<div id="error5" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
										</div> 
										<div class="input-field col s12 m6 l6">
											<i class="material-icons prefix">email</i>
											<input id="correoPro" name="correoPro" type="email">
											<label for="correoPro">Email</label>
										</div>  
										<div class="input-field col s12 m6 l6">
											<i class="material-icons prefix">local_phone</i>
											<input id="contactoPro" name="contactoPro" type="text">
											<label for="contactoPro">Teléfono</label>
										</div>
										@foreach($parametros as $val)
												@if($val->parametro == 'ADD_MAPA_GPS' and $val->valor == 'SI') 
												<div class="input-field col s12 m6 l6"  >
													<i class="material-icons prefix">room</i>
													<input id="direccionPro" name="direccionPro" type="text" readonly="readonly">
													<label for="direccionPro">Dirección</label>
													<div id="error6" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
												 </div> 
												<div class="input-field col s12 m6 l6" readonly="readonly">
													<i class="material-icons prefix">maps_local</i>
													<textarea id="latituPro" name="latituPro" class="materialize-textarea" readonly="readonly"></textarea>
													<label for="latituPro" class="">Latitud</label>
												</div> 
												<div class="input-field col s12 m6 l6" readonly="readonly">
													<i class="material-icons prefix">maps_local</i>
													<textarea id="longituPro" name="longituPro" class="materialize-textarea" readonly="readonly" ></textarea>
													<label for="longituPro" class="">Longitud</label>
												</div>   
												<div class="col s12"> 
													<a type="button" id="addDireccion" class="waves-effect waves-light btn modal-trigger gradient-45deg-indigo-blue col s12" href="#modalCreate1"   style="height: 44px; letter-spacing: .5px; padding-top: 0.3rem;"   >AGREGAR  Dirección</a>
													@include('forms.clientes.mapa.mapsClienteCreate')
												</div>  
												@elseif($val->parametro == 'ADD_MAPA_GPS' and $val->valor == 'NO')
												<div class="input-field col s12 m6 l6"  >
													<i class="material-icons prefix">room</i>
													<input id="direccionPro" name="direccionPro" type="text"  >
													<label for="direccionPro">Dirección</label>
													<div id="error6" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
												</div> 
												@endif
										@endforeach  
										<div class="input-field col s12 m12 l12"  >  
											<i class="material-icons prefix">assignment</i> 
											<label for="descripcionPro">Descripción</label>
											<br> <br> 
												<input type="hidden" id="descripcionPro"  name="descripcionPro" value="COMPROBANTE_CLIENTE">
												<textarea id="descripcionCkeditor" name="descripcionCkeditor" class="materialize-textarea"></textarea>

											 
											
										</div>
										{{--  <div class="input-field col s12">
											 <input type="hidden" name="_token" value="{{ csrf_token() }}">         
											<input type="hidden" name="idplantilla" value="COMPROBANTE_CLIENTE">   
											<textarea id="descripcionCkeditor" name="descripcionCkeditor" class="materialize-textarea"></textarea>
										 
										 </div>  --}}
																
									</div>
								</div>  
								<div class="card white">
									<div class="card-content" style="padding-bottom: 5px; padding-top: 10px">                                              
										<span class="card-title">Conceptos</span> 
										<div class="row">  
											<div class="col s12 m12 herramienta">                         
												<center>
													<a class=" btn-floating waves-effect waves-light grey btn  lighten-5  modal-trigger tooltipped" href="#modalAddPlan"  data-position="top" data-tooltip="AGREGAR PLAN DE INTERNET" >
														<i class="material-icons " style="color: #03a9f4">add</i>
													</a>   
													<a class=" btn-floating waves-effect waves-light grey btn  lighten-5  modal-trigger tooltipped" href="#modalAddEquipo"  data-position="top" data-tooltip="AGREGAR EQUIPO" >
														<i class="material-icons " style="color: #03a9f4">add</i>
													</a>  
													<a class=" btn-floating waves-effect waves-light grey btn  lighten-5  modal-trigger tooltipped" href="#modalAddConcepto"  data-position="top" data-tooltip="AGREGAR CONCEPTO MANUALMENTE" >
														<i class="material-icons " style="color: #03a9f4">add</i>
													</a> 
													
												</center> 
											</div>
											   
										</div>
										<div></div>
									</div>
								</div>                                      
								<div class="card white">
									<div class="card-content" style="padding-bottom: 5px; padding-top: 10px">                                               
										<span class="card-title">Detalle</span>

										<table id="tableProformaDetalle" class="responsive-table display" cellspacing="0">
											<thead>
												<tr >
													<th class="center">#</th>  
													<th class="center">Concepto</th> 
													<th class="center">Descripción</th> 
													<th class="center">Precio</th>
													<th class="center">Des.(Unidad)</th>  
													<th class="center">Acciones</th>
												</tr>
											</thead>
											 
											<tfoot>
												<tr >
													<th class="center">#</th>  
													<th class="center">Concepto</th> 
													<th class="center">Descripción</th> 
													<th class="center">Precio</th>
													<th class="center" >Des.(Unidad)</th>  
													<th class="center" >Acciones</th>
												</tr>
											</tfoot>
	
											<tbody >  
												<tr id="detalleB">
													<td colspan="6" style="text-align: center; text: red;" > <H5 > Agregar    Concepto</H5> </td>   
												</tr>
												
											</tbody>
										</table>
						
						
										{{--  <table  id="tableProformaDetalle" class="responsive-table display tabla" cellspacing="0">
											<thead>
												<tr>
													<th>#</th>  
													<th>Concepto</th> 
													<th >Descripción</th> 
													<th>Precio</th>
													<th class='col s12 m4 l8'>Des.(Unidad)</th>  
													<th class="center">Acciones</th>
												</tr>
											</thead>  
							
											<tbody>  
											</tbody>
										</table>   --}} 
						
										 
										{{--  <tr id='e' class='center'>  
											<td> </td> 
											<td> concepto </td>
											<td>  descripcion </td>
											<td> precio </td> 
											<td class=' col s12 m6 l4'><input type='number'> </td> 
											<td>   
												<a id='delete5' class='eliminacionT btn-floating waves-effect waves-light grey btn  lighten-5   tooltipped'    data-position='top' data-tooltip='ELIMINAR' >
													<i class='material-icons ' style='color: #03a9f4'>delete</i> </a>
							
											</td> 
							
										</tr>  --}}  
										 
									</div>
								</div>  
							</div>
						 </form>
						@include('forms.proformas.modalAddPlan')  
						@include('forms.proformas.modalAddEquipo') 
						@include('forms.proformas.modalAddConceptoManual')  
					</div>
	</div>
</div>
 
@endsection 
@section('script') 
@include('forms.proformas.scripts.addProforma') 
@include('forms.proformas.scripts.obtenerDireccion')  

@endsection

 
