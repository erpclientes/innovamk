<div id="addComprobante" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>GENERAR COMPROBANTE</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 48px; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <button id="addComp" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></button>
                                          
                                          <a href="#" id="cerrarC" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  <form style="margin-top: 70px">
                                    <input type="hidden" id="fecha_inicio" value="">
                                    <input type="hidden" id="fecha_fin" value="">
                                    <input type="hidden" id="fecha_corte" value="">
                                    <input type="hidden" id="perfil" value="">
                                    <input type="hidden" id="vbajada" value="">
                                    <input type="hidden" id="vsubida" value="">

                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:35px; z-index: 1">      

                                      <div class="row" style="margin-bottom: 2px">                                        
                                        <div class="card white">
                                            <div class="card-content" style="padding-bottom: 5px; padding-top: 10px">
                                                <div class="row">
                                                  @foreach($clientes as $datos)                                                  
                                                  <div class="col s12 m6 l3">
                                                    <label for="doc_venta2">Doc. Venta</label>
                                                    <select class="browser-default" id="doc_venta2" name="doc_venta2" required>
                                                      <option value="" disabled>Seleccione</option>
                                                      @foreach($tipo_documento_venta as $tdv)
                                                      <option  id="docucmentoVenta" name="docucmentoVenta" value="{{$tdv->iddocumento}}" {{ $tdv->iddocumento == $datos->doc_venta ? "selected" : "" }}>{{$tdv->descripcion}}</option>
                                                      @endforeach
                                                    </select>                                                    
                                                  </div>   
                                                  @endforeach
                                                  <div class="input-field col s12 m6 l3">                                                    
                                                    <input id="serie" name="serie" type="text" data-error=".errorTxt2" placeholder=" " disabled="">
                                                    <label for="serie">Serie</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  @foreach($parametros as $parametro)
                                                  @if($parametro->parametro == "SHOW_FECHA_EMISION" and $parametro->valor == "SI")
                                                  <div class="input-field col s12 m6 l3">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="fecha_emision" name="fecha_emision" type="text" data-error=".errorTxt2" placeholder=" ">
                                                    <label for="fecha_emision">Fecha Emisión</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  @elseif($parametro->parametro == "SHOW_FECHA_EMISION" and $parametro->valor == "NO")
                                                  <div class="input-field col s12 m6 l3">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="fecha_emision" name="fecha_emision" type="text" data-error=".errorTxt2" placeholder=" " disabled="">
                                                    <label for="fecha_emision">Fecha Emisión</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  @endif
                                                  @endforeach      

                                                  <div class="input-field col s12 m6 l3">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="fecha_vencimiento" name="fecha_vencimiento" type="text" data-error=".errorTxt2" placeholder=" ">
                                                    <label for="fecha_vencimiento">Fecha Vencim.</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>    
  
                                                </div>    
                                                <div class="row" style="margin-bottom: 0px">
                                                  @foreach($parametros as $par)
                                                  @if($par->parametro == "EDIT_FECHA_INICIO")
                                                  <div class="input-field col s12 m6 l3">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="fecha_inicio2" name="fecha_inicio2" type="text" data-error=".errorTxt2" placeholder=" " {{($par->valor == 'SI')? '' : 'disabled'}}>
                                                    <label for="fecha_inicio2">Fecha Inicio</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  @endif
                                                  @endforeach
                                                  @foreach($parametros as $par)
                                                  @if($par->parametro == "EDIT_FECHA_FIN")
                                                  <div class="input-field col s12 m6 l3">
                                                    <i class="material-icons prefix">event</i>
                                                    <input id="fecha_fin2" name="fecha_fin2" type="text" data-error=".errorTxt2" placeholder=" " {{($par->valor == 'SI')? '' : 'disabled'}}>
                                                    <label for="fecha_fin2">Fecha Fin</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>  
                                                  @endif 
                                                  @endforeach
                                                  <div class="input-field col s12 l6 left-align">
                                                    <blockquote style="margin: 0px">Para habilitar los campos Fecha Inicio y fecha Fin configurar el parametro respectivo.</blockquote>
                                                  </div>   
                                                                                                    
                                                </div>                 
                                            </div>
                                        </div>                                       
                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Detalle</span>
                                              
                                              <div class="row"> 
                                                <div class="input-field col s12 m6 l8">
                                                  <i class="material-icons prefix">mode_edit</i>
                                                  <textarea id="descripcion" name="descripcion" class="materialize-textarea" rows="6" lenght="200" maxlength="200" style="height: 200px;"> </textarea>
                                                  <label for="descripcion" class="">Descripción</label>
                                                </div>     
                                                <div class="input-field col s12 m6 l4">
                                                  <i class="material-icons prefix">attach_money</i>
                                                  <input id="precio_unitario" name="precio_unitario" type="text" data-error=".errorTxt5" placeholder=" ">
                                                  <label for="precio_unitario">Importe</label>
                                                  <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>                          
                                              </div>
                                            </div>
                                        </div>                                         
                                        <div class="card white">
                                            <div class="card-content">
                                                <div class="row" style="padding-top: 15px">
                                                  <div class="input-field col s12 m6 l2 offset-l1">
                                                    <input id="subtotal" name="subtotal" type="text" data-error=".errorTxt5" placeholder=" " disabled="">
                                                    <label for="subtotal">SubTotal</label>
                                                    <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>        

                                                  <div class="input-field col s12 m6 l2">
                                                    <input id="descuento" name="descuento" type="text" data-error=".errorTxt5" placeholder=" ">
                                                    <label for="descuento">Descuento</label>
                                                    <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      
                                                  <div class="input-field col s12 m6 l2">
                                                    <input id="subtotal_neto" name="subtotal_neto" type="text" data-error=".errorTxt5" placeholder=" " disabled="">
                                                    <label for="subtotal_neto">Subtotal Neto</label>
                                                    <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      
                                                  <div class="input-field col s12 m6 l2">
                                                    <input id="impuesto" name="impuesto" type="text" data-error=".errorTxt5" placeholder=" " disabled="">
                                                    <label for="impuesto">Impuesto</label>
                                                    <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      
                                                  <div class="input-field col s12 m6 l3">
                                                    <i class="material-icons prefix active">attach_money</i>
                                                    <input id="total" name="total" type="text" data-error=".errorTxt5" placeholder=" " disabled="">
                                                    <label for="total">Total</label>
                                                    <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      
                                                </div>                     
                                            </div>
                                        </div>                                        
                                      </div>                           

                                    </div>   
                                  </form>

              </div>
              
            </div>