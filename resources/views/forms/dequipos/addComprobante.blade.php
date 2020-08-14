<div id="vwComprobante" class="modal modal-fixed-footer" style="height: 50%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>AGREGAR EQUIPO A COMPROBANTE PENDIENTE</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="addEquipoComp" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          
                                          <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  
           
                                        
                                  </div>                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">                                          
                                      <div class="card white">
                                            <div class="card-content">
                                              <form id="FormAddComprobante" accept-charset="UTF-8" enctype="multipart/form-data">
                                                <input type="hidden" name="idequipo" id="comp_idequipo" value="">
                                                <input type="hidden" name="idservicio" id="comp_idservicio" value="">
                                                <div class="row">                                                 
                                                  <div class="col s12 m6 l3">
                                                    <label for="idrouter">Agregar a comprobante</label>
                                                    <select class="browser-default" id="comp_idcomprobante" name="idcomprobante"> 
                                                      <option value="0" disabled="">Seleccione una opción</option>
                                                      @foreach($comprobantes as $comp)
                                                      @foreach($tipo_documento_venta as $tipo)
                                                      @if($tipo->iddocumento == $comp->iddocumento)  
                                                        <option value="{{$comp->codigo}}" selected="">{{$tipo->dsc_corta.' '.$comp->serie.' '.$comp->numero}}</option>
                                                      @endif
                                                      @endforeach                                                      
                                                      @endforeach
                                                    </select>
                                                    <div id="comp_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="col s12 m6 l3">
                                                    <label for="idrouter">Precio equipo</label>
                                                    <input id='comp_precio' name='precio' type='number' class='right-align input_numerico'>
                                                    <div id="comp_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 l6 left-align">
                                                    <blockquote style="margin: 0px">Este equipo se agregará al detalle del comprobante pendiente</blockquote>
                                                  </div> 
                                                </div> 
                                              </form>                    
                                            </div>
                                        </div> 

                                    </div>   
                                  

              </div>
              
            </div>

  