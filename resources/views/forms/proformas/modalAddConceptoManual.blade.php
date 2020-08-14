 

	<!-- Modal Structure -->
	<div id="modalAddConcepto" class="modal modal-fixed-footer">
	  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
		 <div class="card-header">                    
			<i class="fa fa-table fa-lg material-icons">receipt</i>
			<h2>AGREGAR CONCEPTO  MANUAL </h2>
		 </div>
	  </div>
	  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
		 <div class="col s12 m12 herramienta">                         
			<a id="addConceptoM" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
			  <i class="material-icons " style="color: #2E7D32">check</i></a>
			<a style="margin-left: 6px"></a>   
			<a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
			  <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
		 </div>   
	  </div> 
	  <br><br><br><br> 
	  <div class="modal-content">                  
			<div class="row cuerpo">
			  <div class="col s12 m12 l12  ">
					<div class="card white"> 
						 <div class="col "> 
							<div class="input-field col s12 m6 l6">
								<i class="material-icons prefix">clear_all</i>
								<input id="conceptoC" name="conceptoC" type="text" data-error=".errorTxt3">
								<label for="conceptoC">Concepto</label>
								<div id="error3" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
							</div>
							 <div class="input-field col s12 m6 l6">
								<i class="material-icons prefix">assignment</i>
								<input id="descripcionC" name="descripcionC" type="text" data-error=".errorTxt4">
								<label for="descripcionC">Descripción</label>
								{{--  <textarea id="descripcionCkeditor" name="descripcionCkeditor" class="materialize-textarea"></textarea>  --}}
								<div id="error4" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
							 </div>   
							 <div class="input-field col s12 m6 l6">
								<i class="material-icons prefix">attach_money</i>
								<input id="precioC" name="precioC" type="number" data-error=".errorTxt5">
								<label for="precioC">Precio</label>
								<div id="error5" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem"></div>
							 </div> 

					    </div>  
				 </div>       
			</div> 
			</div> 
	  </div> 
	</div>

  
