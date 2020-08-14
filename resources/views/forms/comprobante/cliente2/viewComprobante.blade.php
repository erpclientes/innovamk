<div id="viewComprobante-{{$valor->codigo}}" class="modal modal-fixed-footer" style="height: 100%;">
  <div class="modal-content" style="padding: 0px; overflow-x: scroll; height: 300%; background-color: #f9f9f9">
    <div class="card" style="position: fixed; width: 100%; z-index: 2">
      <div class="card-header">
        <i class="fa fa-table fa-lg material-icons">receipt</i>
        <h2>Detalle</h2>
      </div>
      <div class="row card-header sub-header" style="margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
          <div class="col s12 m12 herramienta">                         
            <a href="#" id="cerrarC" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
              <i class="material-icons" style="color: #424242">keyboard_tab</i>
            </a>  
          </div>  
      </div>
      <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">
        <div class="row">
          <div class="card white">
            <div class="card-content">
              <div class="row">
                @foreach($clientes as $datos)                                                  
                                                  <div class="col s12 m6 l3">
                                                    <label for="doc_venta3">Doc. Venta</label>
                                                    <select class="browser-default" id="doc_venta3" name="doc_venta3" required disabled="">
                                                      <option value="" disabled>Seleccione</option>
                                                      @foreach($tipo_documento_venta as $tdv)
                                                      <option value="{{$tdv->iddocumento}}" {{ $tdv->iddocumento == $datos->doc_venta ? "selected" : "" }}>{{$tdv->descripcion}}</option>
                                                      @endforeach
                                                    </select>                                                    
                                                  </div>   
                                                  @endforeach
                                                  <div class="input-field col s12 m6 l3">
                                                    
                                                    <input id="serie2" name="serie2" type="text" data-error=".errorTxt2" placeholder="{{$valor->serie.'-'.$valor->numero}}" disabled="">
                                                    <label for="serie2">Serie</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>     
                <div class="input-field col s12 m6 l3">
                  <i class="material-icons prefix">event</i>
                  <input  type="text" value="{{ date_format(date_create($valor->fecha_emision),'d/m/Y') }}" disabled>
                  <label for="fecha_emision">Fecha Emisión</label>
                  <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                </div>
                <div class="input-field col s12 m6 l3">
                  <i class="material-icons prefix">event</i>
                  <input  type="text" value="{{ date_format(date_create($valor->fecha_vencimiento),'d/m/Y') }}" disabled>
                  <label for="fecha_vencimiento">Fecha de Venc.</label>
                  <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Detalle</span>
                                              
                                              <div class="row" id="detPrincipal{{$valor->codigo}}" style="margin-bottom: 0px"> 
                                                <div class="input-field col s12 m6 l8">
                                                  <i class="material-icons prefix">mode_edit</i>
                                                  <textarea class="materialize-textarea" rows="6" lenght="200" maxlength="200" disabled="" style="height: 150px;margin-bottom: 0px">{{$valor->detalle}}</textarea>
                                                  <label for="descripcion2" class="">Descripción</label>
                                                </div>     
                                                <div class="input-field col s12 m6 l4">
                                                  <i class="material-icons prefix">attach_money</i>
                                                  <input type="text" data-error=".errorTxt5" disabled="" placeholder="{{$valor->costo_servicio}}"  style="margin-bottom: 0px">
                                                  <label for="precio_unitario">Importe</label>
                                                  <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>                          
                                              </div>
                                             
                                               <div class="row" id="detFac{{$valor->codigo}}" style="margin-bottom: 0px"> 
                                                            
                                              </div>
                                            </div>
                                            <br>
                                        </div>                                      
          <div class="card white">
            <div class="card-content">
              <div class="row" style="padding-top: 15px">
                <div class="input-field col s12 m6 l2 offset-l2">
                  <input id="subtotal2" name="subtotal2" type="text" disabled="" value="{{$valor->subtotal}}">
                  <label for="subtotal">SubTotal</label>
                </div>
                <div class="input-field col s12 m6 l2">
                  <input id="descuento2" name="descuento2" type="text" disabled="" value="{{$valor->descuento}}">
                  <label for="descuento">Descuento</label>
                </div>
                <div class="input-field col s12 m6 l2">
                  <input id="subtotal_neto" name="subtotal_neto" type="text" disabled="" value="{{$valor->subtotal_neto}}">
                  <label for="subtotal_neto">Subtotal Neto</label>
                </div>
                <div class="input-field col s12 m6 l2">
                  <input id="impuesto" name="impuesto" type="text" disabled="" value="{{$valor->impuesto}}">
                  <label for="impuesto">Impuesto</label>
                </div>
                <div class="input-field col s12 m6 l2">
                  <i class="material-icons prefix active">attach_money</i>
                  <input id="total" name="total" type="text" disabled="" value="{{$valor->total}}">
                  <label for="total">Total</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
</div>