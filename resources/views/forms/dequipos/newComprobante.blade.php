<div id="vwNewComprobante" class="modal modal-fixed-footer" style="height: 50%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>GENERAR NUEVO COMPROBANTE</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="addNewComp" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          
                                          <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  
           
                                        
                                  </div>
                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">      
                                      
                                      <div class="card white">
                                            <div class="card-content">
                                              <form id="FormNewComprobante" accept-charset="UTF-8" enctype="multipart/form-data">
                                                <input type="hidden" name="idequipo" id="new_idequipo" value="">
                                                <input type="hidden" name="idservicio" id="new_idservicio" value="">
                                                <input type="hidden" name="idcliente" id="idcliente" value="{{$idcliente}}">
                                                <input type="hidden" name="descripcion" id="new_descripcion" value="">
                                                <div class="row">   
                                                <div class="input-field col s12 left-align">
                                                    <blockquote style="">Se generará un nuevo comprobante de pago para este.</blockquote>
                                                  </div>                                               
                                                  <div class="col s12 m6 l3">
                                                    <label for="idrouter">Doc. venta</label>
                                                    <select class="browser-default" id="comp_idcomprobante" name="idcomprobante"> 
                                                      <option value="0" disabled="">Seleccione documento</option>
                                                      @foreach($clientes as $datos) 
                                                      @foreach($tipo_documento_venta as $tdv)
                                                      <option value="{{$tdv->iddocumento}}" {{ $tdv->iddocumento == $datos->doc_venta ? "selected" : "" }}>{{$tdv->descripcion.' '.$tdv->serie.'-'.$tdv->correlativo}}</option>
                                                      @endforeach
                                                      @endforeach
                                                    </select>
                                                    <div id="new_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="input-field col s12 m6 l3">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="new_fecha_emision" name="fecha_emision" type="text" data-error=".errorTxt2" placeholder=" ">
                                                    <label for="fecha_emision">Fecha Emisión</label>
                                                    <div id="new_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      

                                                  <div class="input-field col s12 m6 l3">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="new_fecha_vencimiento" name="fecha_vencimiento" type="text" data-error=".errorTxt2" placeholder=" ">
                                                    <label for="fecha_vencimiento">Fecha Vencim.</label>
                                                    <div id="new_error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      
                                                  <div class="input-field col s12 m6 l3">
                                                    <label for="idrouter">Precio equipo</label>
                                                    <input id='new_precio' name='precio' type='number' class='right-align' placeholder=" ">
                                                    <div id="new_error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  
                                                </div> 
                                              </form>                    
                                            </div>
                                        </div>                          
                                
                                            

                                    </div>   
                                  

              </div>
              
            </div>

  