<div id="updPCQ" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>REGISTRAR PERFIL PCQ</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="upd_PCQ" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#" id="u_pcq_cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>       
                                        
                                  </div>
                                                    
                                  <form id="formPCQUpdate" accept-charset="UTF-8" enctype="multipart/form-data" style="margin-top: 70px">
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">      
                                        <input type="hidden" name="u_pcq_idperfil" id="u_pcq_idperfil" value="">
                                        <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="u_pcq_idrouter" name="u_pcq_idrouter" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Elija un router</option>
                                                      <option value="0">Todos</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div id="u_pcq_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
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
                                                  <input id="u_pcq_name" name="u_pcq_name" type="text" value=" ">
                                                  <label for="u_pcq_name">Nombre del Plan</label>
                                                  <div id="u_pcq_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      

                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">attach_money</i>
                                                  <input id="u_pcq_precio" name="u_pcq_precio" type="number" value=" ">
                                                  <label for="u_pcq_precio">Precio</label>
                                                  <div id="u_pcq_error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>   
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">cloud_upload</i>
                                                  <input id="u_pcq_vsubida" name="u_pcq_vsubida" type="text" value=" ">
                                                  <label for="u_pcq_vsubida">Velocidad de Subida</label>
                                                  <div id="u_pcq_error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>     
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">cloud_download</i>
                                                  <input id="u_pcq_vbajada" name="u_pcq_vbajada" type="text" value=" ">
                                                  <label for="u_pcq_vbajada">Velocidad de descarga</label>
                                                  <div id="u_pcq_error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="col s12 m6 l6">
                                                  <label for="u_pcq_perfil">Parent up</label>
                                                    <select class="browser-default" id="u_pcq_parent1" name="u_pcq_parent1" > 
                                                      <option value="sn" disabled="" selected="">Seleccionar</option>
                                                    </select>
                                                    <div id="u_pcq_error6" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="col s12 m6 l6">
                                                  <label for="u_pcq_perfil">Parent down</label>
                                                    <select class="browser-default" id="u_pcq_parent2" name="u_pcq_parent2" > 
                                                      <option value="sn" disabled="" selected="">Seleccionar</option>
                                                    </select>
                                                    <div id="u_pcq_error7" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix active">label_outline</i>
                                                  <input id="u_pcq_limite" name="u_pcq_limite" type="text" value=" ">
                                                  <label for="u_pcq_limite">Límite usuarios</label>
                                                  <div id="u_pcq_error8" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix active">label_outline</i>
                                                  <input id="u_pcq_prioridad" name="u_pcq_prioridad" type="text" value=" ">
                                                  <label for="u_pcq_prioridad">Prioridad</label>
                                                  <div id="u_pcq_error9" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">mode_edit</i>
                                                  <textarea id="u_pcq_glosa" name="u_pcq_glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"> </textarea>
                                                  <label for="glosa" class="">Comentario</label>
                                                </div>            
                                              </div> 
                                            </div>
                                        </div>                                        
                                            

                                    </div>   
                                  </form>

              </div>
              
            </div>

