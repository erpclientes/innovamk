 <!-- Modal Structure -->
          <div id="modal2" class="modal modal-fixed-footer">
            <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
              <div class="card-header">                    
                <i class="fa fa-table fa-lg material-icons">receipt</i>
                <h2>AGREGAR EQUIPO </h2>
              </div>
            </div>
            <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
              <div class="col s12 m12 herramienta">                         
                <a id="addEquipoEmisor" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                  <i class="material-icons " style="color: #2E7D32">check</i></a>
                <a style="margin-left: 6px"></a>  

                <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                  <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
              </div>   
            </div> 
            <div class="modal-content"> 
              <h4></h4><br><h4></h4><br>                 
                <div class="row cuerpo">
                  <div class="col s12 m12 l12">
                      <div class="card white">
                        <div class="card-content">
                          <div class="row">
                            <div class="col s12 m4 l4">
                              <label for="idgrupo">Grupo</label>
                              <select class="browser-default" id="idgrupo" name="idgrupo" data-error=".errorTxt1" > 
                                <option value="" disabled="" selected="">Elija un grupo</option>
                                @foreach($grupo as $val)
                                  <option value="{{$val->idgrupo}}">{{$val->descripcion}}</option>
                                @endforeach                                                      
                              </select>
                              <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div>
                          <div class=" col s12 m4 l4">
                            <label for="zonas">ZONAS</label>
                            <select class="browser-default" id="zonas" name="zonas" required>
                              <option value="" disabled selected="">Seleccione</option>
                              @foreach($zonas as $zn)
                              <option value="{{$zn->id }}">{{$zn->nombre}}</option>
                              @endforeach
                            </select>
                            <div class="errorTxt1" id="error8" style="color: red; font-size: 12px; font-style: italic;"></div>

                          </div>
                          
            
                          <div class="input-field col s12 s12 m4 l4 right-align">
                            <div class="chip center-align" style="width: 70%;height: 60px;">
                              <b>Estado:</b> <br> No Disponible
                              <i class="material-icons mdi-navigation-close"></i>
                              
                            </div>
                          </div> 
                        </div>                     
                      </div>
                    </div>       
                </div>
                  <div class="col s12 m12 l6">                        
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="contador" value="{{ $contador }}">


                                
                                <div class="card white">
                                    <div class="card-content" >
                                      <span class="card-title">Datos generales</span> 
            
                                      <div class="row">
                                        <div class="col s12 m6 l12">
                                          <label for="idmarca">Marca</label>
                                          <select class="browser-default" id="idmarca" name="idmarca" data-error=".errorTxt1" disabled=""> 
                                            <option value="" disabled="" selected="">Elija una marca</option>
                                            @foreach($marca as $val)
                                              <option value="{{$val->idmarca}}">{{$val->descripcion}}</option>
                                            @endforeach
                                          </select>
                                          <div class="errorTxt1" id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                        </div>
                                        <div class="col s12 m6 l12">
                                          <label for="idmodelo">Modelo</label>
                                          <select class="browser-default" id="idmodelo" name="idmodelo" data-error=".errorTxt1" disabled="" > 
                                            <option value="" disabled="" selected="">Elija un modelo</option>
                                            @foreach($modelo as $val)
                                              <option value="{{$val->idmodelo}}">{{$val->descripcion}}</option>
                                            @endforeach
                                          </select>
                                          <div class="errorTxt1" id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                        </div>                 
                                      </div>                     
                                      <div class="row">                            
                                        <div class="input-field col s12 m6 l12">
                                          <i class="material-icons prefix">clear_all</i>
                                          <input id="descripcionE" name="descripcionE" type="text" data-error=".errorTxt4">
                                          <label for="descripcionE">Descripcion</label>
                                          <div class="errorTxt4" id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                        </div> 
                                                              
                                      </div>
                              </div>
                            </div>
                  </div>
                  <div class="col s12 m12 l6">                      
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="card white">
                                    <div class="card-content">
                                      <span class="card-title">Datos técnicos</span>
                                      <div class="row">
                                        <div class="col s12 m6 l12">
                                          <label for="idmodo">Modo equipo</label>
                                          <select class="browser-default" id="idmodo" name="idmodo" data-error=".errorTxt1" > 
                                            <option value="" disabled="" selected="">Elija un grupo</option>
                                            @foreach($modo as $val)
                                              <option value="{{$val->idmodo}}">{{$val->descripcion}}</option>
                                            @endforeach
                                          </select>
                                          <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                        </div>     
                                        <div class="input-field col s12 m12 l12">
                                          <i class="material-icons prefix">settings_ethernet</i>
                                          <input id="ip" name="ip" type="text" data-error=".errorTxt5">
                                          <label for="ip">Dirección IP</label>
                                          <div class="errorTxt5"></div>
                                        </div>    
                                        <div class="input-field col s12 m12 l12">
                                          <i class="material-icons prefix">person</i>
                                          <input id="usuario" name="usuario" type="text">
                                          <label for="usuario">Usuario</label>
                                        </div>     
                                        <div class="input-field col s12 m12 l12">
                                          <i class="material-icons prefix">lock_outline</i>
                                          <input id="contrasena" name="contrasena" type="text">
                                          <label for="contrasena">Contraseña</label>
                                        </div>  
                                                    
                                      </div>
                              </div>
                            </div>
                  </div> 
                </div> 
            </div> 
          </div>
