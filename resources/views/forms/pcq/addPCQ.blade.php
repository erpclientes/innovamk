<div id="addPCQ" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>REGISTRAR PERFIL PCQ</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="add_PCQ" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#" id="pcq_cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>       
                                        
                                  </div>
                                                    
                                  <form id="formPCQ" accept-charset="UTF-8" enctype="multipart/form-data" style="margin-top: 70px">
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">      
                                      
                                        <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="pcq_idrouter" name="pcq_idrouter" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Elija un router</option>
                                                      <option value="0">Todos</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div id="pcq_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
                                                    <div class="chip center-align" style="width: 70%">
                                                      <b>Estado:</b> No Disponible
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                 
                                      
                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Datos Generales</span>
                                              <div class="row">                                                
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix active">label_outline</i>
                                                  <input id="pcq_name" name="pcq_name" type="text">
                                                  <label for="pcq_name">Nombre del Plan</label>
                                                  <div id="pcq_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      

                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">attach_money</i>
                                                  <input id="pcq_precio" name="pcq_precio" type="number">
                                                  <label for="pcq_precio">Precio</label>
                                                  <div id="pcq_error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>   
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">cloud_upload</i>
                                                  <input id="pcq_vsubida" name="pcq_vsubida" type="text">
                                                  <label for="pcq_vsubida">Velocidad de Subida</label>
                                                  <div id="pcq_error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>     
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">cloud_download</i>
                                                  <input id="pcq_vbajada" name="pcq_vbajada" type="text">
                                                  <label for="pcq_vbajada">Velocidad de descarga</label>
                                                  <div id="pcq_error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="col s12 m6 l6">
                                                  <label for="pcq_perfil">Parent up</label>
                                                    <select class="browser-default" id="pcq_parent1" name="pcq_parent1" > 
                                                      <option value="sn" disabled="" selected="">Seleccionar</option>
                                                    </select>
                                                    <div id="pcq_error6" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="col s12 m6 l6">
                                                  <label for="pcq_perfil">Parent down</label>
                                                    <select class="browser-default" id="pcq_parent2" name="pcq_parent2" > 
                                                      <option value="sn" disabled="" selected="">Seleccionar</option>
                                                    </select>
                                                    <div id="pcq_error7" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix active">label_outline</i>
                                                  <input id="pcq_limite" name="pcq_limite" type="text">
                                                  <label for="pcq_limite">Límite usuarios</label>
                                                  <div id="pcq_error8" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix active">label_outline</i>
                                                  <input id="pcq_prioridad" name="pcq_prioridad" type="text">
                                                  <label for="pcq_prioridad">Prioridad</label>
                                                  <div id="pcq_error9" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">mode_edit</i>
                                                  <textarea id="pcq_glosa" name="pcq_glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"></textarea>
                                                  <label for="glosa" class="">Comentario</label>
                                                </div>            
                                              </div> 
                                            </div>
                                        </div>                                        
                                            

                                    </div>   
                                  </form>

              </div>
              
            </div>

