<div id="vwGFichas" class="modal modal-fixed-footer" style="height: 40% !important; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>GENERAR DISEÑO PARA IMPRESIÓN DE FICHAS</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.2rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="generar" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: black">vertical_align_bottom</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          
                                          <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  
           
                                        
                                  </div>
                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 4rem">      
                                      
                                     <div class="card white">
                                            <div class="card-content">
                                              <form accept-charset="UTF-8" enctype="multipart/form-data">
                                                <input type="hidden" name="idficha" id="idficha" value="">
                                                
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="idrouter">Plantillas</label>
                                                    <select class="browser-default" id="idplantilla" name="idplantilla" data-error=".errorTxt1" > 
                                                      <option value="0" disabled="" selected="">Elija una plantilla</option>
                                                      @foreach($plantillas as $valor)
                                                      <option value="{{ $valor->codigo }}">{{ "(".$valor->codigo.") ".$valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div id="ipcq_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 left-align">
                                                    <blockquote style="margin: 0px">Para crear diferentes tipos de plantillas puede hacerlo desde el modulo de Fichas->Plantillas</blockquote>
                                                  </div> 
                                                </div>    
                                              </form>                 
                                            </div>
                                        </div>    
                                  </div>   
                                  

              </div>
              
            </div>

  