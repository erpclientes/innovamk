<div id="addPago" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>REGISTRAR PAGO</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <button id="aceptar" class="hide btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Aceptar pago">
                                            <i class="material-icons " style="color: #2E7D32">check</i></button>
                                          <a id="rechazar" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Rechazar">
                                            <i class="material-icons" style="color: #757575 ">clear</i>
                                          </a>
                                          <a style="margin-left: 6px"></a>   
                                         
                                          <a href="#" id="cAddDMision" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  <form style="margin-top: 70px" id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                                  <div class="row" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">   

                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">   
                                  <input type="hidden" name="id" id="id" value="{{ $datos->codigo }}">   
                                      
                                        <div class="col m8 l6 offset-m2 offset-l3">
                                          <div class="card white">
                                              <div class="card-content">
                                                <span class="card-title">Boucher</span>

                                                  <div class="row">                                                    
                                                    <div class="col s12">                                                      
                                                      <div class="file-field input-field col s12"> 
                                                        <div class="col s12  center" style="">   
                                                          @if(empty($datos->url_imagen))
                                                          <i class="material-icons" id="imagen_scr" style="color: #26c6da; font-size: 10rem; margin: auto">image</i> 
                                                          @else
                                                          <img src="{{url($datos->url_imagen)}}" alt=""  style="height: 100%; width: 100%">
                                                          @endif                                                       
                                                        </div>                                                         
                                                      </div>                                                                                                           
                                                    </div>

                                                    <div class="input-field col s12">
                                                      <i class="material-icons prefix">mode_edit</i>
                                                      <textarea id="observacion" name="observacion" class="materialize-textarea" lenght="200" style="height: 50px;">{{$datos->glosa}}</textarea>
                                                      <label for="observacion" class="active">Observación</label>
                                                      <div id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                    </div>        

                                                  </div>
                                              </div>
                                          </div>
                                        </div>

                                    </div>   
                                  </form>

              </div>
              
            </div>

