<div id="modalProforma" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
							  
							  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
								 <div class="card-header">                    
									<i class="fa fa-table fa-lg material-icons">receipt</i>
									<h2>GENERAR PROFORMA</h2>
								 </div>
							  </div>
							  
							  <div class="row card-header sub-header" style="margin-top: 48px; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
									  <div class="col s12 m12 herramienta">                         
										 <button id="addProform" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
											<i class="material-icons " style="color: #2E7D32">check</i></button>
										 
										 <a href=" {{ url('/proformas') }}" id="cerrarC" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
											<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
									  </div>  
									  @include('forms.scripts.modalInformacion')  
							  </div> 
													  
							  <form  id="myFormProform" accept-charset="UTF-8" enctype="multipart/form-data>"> 
									<input type="hidden" name="_token" value="{{ csrf_token() }}"> 

							  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:35px; z-index: 1">      

									<div class="row" style="margin-bottom: 2px">                                        
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
													  <select class="browser-default" id="iddocumento" name="iddocumento" required> 
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
													<i class="material-icons prefix">perm_contact_cal</i>
													<input id="contactoPro" name="contactoPro" type="text">
													<label for="contactoPro">Contacto</label>
												 </div>
												 <div class="input-field col s12 m6 l6"  >
													<i class="material-icons prefix">room</i>
													<input id="direccionPro" name="direccionPro" type="text"  >
													<label for="direccionPro">Dirección</label>
													<div id="error6" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
												 </div>
												                   
											</div>
									  </div>  
									  <div class="card white">
										<div class="card-content">                                               
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
										</div>
								  </div>                                      
									  <div class="card white">
											<div class="card-content">                                               
											  <span class="card-title">Detalle</span>


											  <table  id="tableProformaDetalle" class="responsive-table display tabla" cellspacing="0">
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
											</table>  

											  <div class="row"> 
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
									</div>    
								 </div>   
							  </form> 
	</div>
	
 </div>
 @include('forms.proformas.modalAddPlan')  
 @include('forms.proformas.modalAddEquipo') 
 @include('forms.proformas.modalAddConceptoManual') 
