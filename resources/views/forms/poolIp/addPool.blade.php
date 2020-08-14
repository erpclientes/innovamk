<div id="vwIpPool" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>CREAR IP POOL</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12">                         
                                          <button id="addPool" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></button>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#" id="cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  

                                               
                                        
                                  </div>
                                                    
                                  <form id="frmAddPool" accept-charset="UTF-8" enctype="multipart/form-data" style="margin-top: 70px" >
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">      
                                     
                                        <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m3 l4">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="idrouter" name="idrouter"> 
                                                      <option value="sn" disabled="" selected="">Elija un router</option>
                                                      <option value="0">Todos</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="input-field col s12 m3 l4">
                                                    <i class="material-icons prefix active">label_outline</i>
                                                    <input id="descripcion" name="descripcion" type="text" data-error=".errorTxt2">
                                                    <label for="descripcion">Descripción</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>   

                                                  <div class="input-field col s12 s12 m4 l4 right-align">
                                                    <div class="chip center-align" style="width: 90%">
                                                      <b>Estado:</b> No Disponible
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                
                                   
                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Rango Ip Pool</span>
                                              <div class="row">
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix active">label_outline</i>
                                                  <input id="ip_inicial" name="ip_inicial" type="text" data-error=".errorTxt2">
                                                  <label for="ip_inicial">Ip inicial</label>
                                                  <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix active">label_outline</i>
                                                  <input id="ip_final" name="ip_final" type="text" data-error=".errorTxt2">
                                                  <label for="ip_final">Ip final</label>
                                                  <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>   
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">mode_edit</i>
                                                  <textarea id="glosa" name="glosa" class="materialize-textarea" style="height: 120px;"></textarea>
                                                  <label for="glosa" class="">Comentario</label>
                                                </div>            
                                              </div> 
                                            </div>
                                        </div>     

                                    </div>   
                                  </form>

              </div>
              
            </div>

