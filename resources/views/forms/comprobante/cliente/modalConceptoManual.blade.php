<div id="vwNewConcepto{{ $valor->codigo }}" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
							  
							  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
								 <div class="card-header">                    
									<i class="fa fa-table fa-lg material-icons">receipt</i>
									<h2>AGREGAR CONCEPTO MANUAL</h2>
								 </div>
							  </div>
							  
							  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
									  <div class="col s12 m12 herramienta">                         
										 <a id="addNewConMan" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
											<i class="material-icons " style="color: #2E7D32">check</i></a>
										 <a style="margin-left: 6px"></a>   
										 
										 <a   id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
											<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
									  </div>  

									  
							  </div>
													  
							  
							  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:40px; z-index: 1; margin-top: px">      
								<br><br><br><br>
									<div class="card white">
											<div class="card-content">
											  <form id="FormNewComceptoManual" accept-charset="UTF-8" enctype="multipart/form-data"> 
												<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
												<input type="hidden" name="idFactura" value="{{$valor->codigo}}"> 
												 <div class="row"> 
													{{--  <blockquote style="text-align: right;">Se agregará un nuevo concepto manual  para este comprobante.</blockquote>    --}}  
													<div class="input-field col s12 m12 l12  "  > 
														<i class="material-icons prefix">create</i>
														<label for="fecha_emision">Descripción del concepto manual </label> 
														<textarea id="descripcionManual"  name="descripcionManual" class="materialize-textarea"   ></textarea>  
														{{--  <br> <br> 
															<input type="hidden" id="descripcionAddConceptoM"  name="descripcionAddConceptoM"  >
															<textarea id="descripcionCkeditor" name="descripcionCkeditor" class="materialize-textarea"></textarea> 
															<br>
															 --}}
														<div id="descripcionManual1" style="color: red; font-size: 12px; font-style: italic;"></div> 
													</div>  
													<div class="input-field col s12 m6 l3">
													  <i class="material-icons prefix">content_paste</i>
													  <input id="cantidadManual" value="1" name="cantidadManual" type="number" data-error=".errorTxt2" placeholder=" ">
													  <label for="cantidadManual">Cantidad</label>
													  <div id="cantidadManual2" style="color: red; font-size: 12px; font-style: italic;"></div>
													</div>         
													<div class="input-field col s12 m6 l3">
														<i class="material-icons prefix">attach_money</i>
													  <label for="PrecioManual">Precio </label>
													  <input id='PrecioManual' value="0" name='precioManual' type='number' class='right-align' placeholder=" ">
													 <div id="PrecioManual3" style="color: red; font-size: 12px; font-style: italic;"></div>
													</div>
													<div class="input-field col s12 m6 l3">
														<i class="material-icons prefix">attach_money</i>
													  <label for="descuentoManual">Descuento </label>
													  <input id='descuentoManual' value="0" name='descuentoManual' type='number' class='right-align' placeholder=" ">
													 <div id="descuentoManual4" style="color: red; font-size: 12px; font-style: italic;"></div>
													</div>
													<div class="input-field col s12 m6 l3">
														<i class="material-icons prefix">attach_money</i>
													  <label for="impuestoManual">Impuesto </label>
													  <input id='impuestoManual' value="0" name='impuestoManual' type='number' class='right-align' placeholder=" ">
													 <div id="cantidadManual5" style="color: red; font-size: 12px; font-style: italic;"></div>
													</div>

													
												 </div> 
											  </form>                    
											</div>
									  </div>                          
							
											

								 </div>   
							  

	</div>
	
 </div>

