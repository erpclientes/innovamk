
<div id="DatosIdCliente" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
							  
							  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
								 <div class="card-header">                    
									<i class="fa fa-table fa-lg material-icons">receipt</i>
									<h2>DATOS DE CLIENTE</h2>
								 </div>
							  </div> 
							  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
									  <div class="col s12 m12 herramienta">                         
										 <a id="aceptarDatos"  class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Agregar datos al formulario">
											<i class="material-icons " style="color: #2E7D32">check</i></a>
										 <a style="margin-left: 6px"></a> 

										 <a  id="cancelarDatos" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Ingregar otro documento">
											<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
									  </div>   


									  
							  </div>
													  
							  
							<div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">      
									
									 

									  <div class="card white">
											<div class="card-content">                                               
											   
											  <div class="row">
											           
											<div class="col s12 m6 l6" readonly="readonly">
												<i class="material-icons prefix active">label_outline</i>
												<label for="nro_documentoD">Nro. Documento</label>  
											  <input  readonly="readonly" id="nro_documentoD" name="nro_documentoD" type="text" data-error=".errorTxt2" maxlength="20" onkeyup="mayus(this);"> 
											</div>        
											<div class="col s12 m6 l6">
												<i class="material-icons prefix">perm_identity</i>
											  <label for="apaternoD">Apellido Paterno</label>
											  <input  readonly="readonly" id="apaternoD" name="apaternoD" type="text" data-error=".errorTxt3"> 
											</div>
											<div class="col s12 m6 l6">
												<i class="material-icons prefix">perm_identity</i>
											  <label for="amaternoD">Apellido Materno</label>
											  <input  readonly="readonly" id="amaternoD" name="amaternoD" type="text" data-error=".errorTxt4"> 
											</div>   
											<div class="col s12 m6 l6">
												<i class="material-icons prefix">person</i>
												<label for="nombresD">Nombres</label> 
											  <input  readonly="readonly" id="nombresD" name="nombresD" type="text" data-error=".errorTxt5"> 
											</div>
											<div class="col s12 m6 l6">
												<i class="material-icons prefix">call</i>
												<label for="telefono1D">Telefono 1</label>
												<input  readonly="readonly" id="telefono1D" name="telefono1D" type="text" data-error=".errorTxt5" > 
											</div>  
											<div class="col s12 m6 l6">
												<i class="material-icons prefix">email</i>
												<label for="correoD">Email</label>
												<input  readonly="readonly" id="correoD" name="correoD" type="email" data-error=".errorTxt5"> 
											</div>
											<div class="col s12 m6 l6"> 
												<i class="material-icons prefix">maps</i>
												<label for="latitudD">Latitud</label>
												<input  readonly="readonly" id="latitudD" name="latitudD" type="text" data-error=".errorTxt5"> 
											</div>  
											<div class="col s12 m6 l6"> 
												<i class="material-icons prefix">maps</i>
												<label for="longitudD">Longitud</label>
												<input  readonly="readonly" id="longitudD" name="longitudD" type="text"  data-error=".errorTxt5"> 
											</div>  

											  </div> 
											</div>
									  </div>                                        
											

							</div>   
							  

	</div>
	
 </div> 





  


