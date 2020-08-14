<div id="vwDocumentos" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                             
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>ADJUNTAR DOCUMENTO</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="addDocumentoAdjunto"    class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardardoc">
                                            <i class="material-icons " style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          
                                          <a href="#" id="CerrarDocumentoAdjunto" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  
           
                                        
                                  </div>
                                                    
                                  <form  id="myFormDoc" accept-charset="UTF-8" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                     
                                    @foreach($clientes as $val)
                                    <input type="hidden" name="idcliente" value="{{ $datos->idcliente }}">

                                    <input type="hidden" name="idempresa" value="{{$val->idempresa}}"> 
                                    @endforeach
                                    
                                     
                    
                                    <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">      
                                        
                                      <div class="input-field col s12 left-align">
                                        <blockquote style="margin: 0px">Este documento se agregará al archivo del cliente </blockquote>
                                      </div> 

                                      <div class="col s12 l6">
                                      
                                        <div class="card white">
                                            <div class="card-content">
                                                <span class="card-title">Documentos</span>

                                                <div class="row">
                                                  <div class="file-field input-field col s12">
                                                    
                                                      <div class="col s8 m8 l7 center" style="margin: auto; width: 100%">
                                                        <img src="{{asset('images/avatar/archivos3.png')}}" alt="" id="avatarImage" class="  responsive-img valign profile-image    " style="width: 100px">
                                                      </div> 
                                                      <br>
                                                      <div class="file-field input-field col s12 ">                                  
                                                        <div class="btn light-blue darken-1 ">
                                                          <span>SUBIR</span>
                                                          <input type="file" id="archivo" name="archivo" >
                                                        </div> 
                                                        <div class="file-path-wrapper">
                                                          <input class="file-path validate" type="text" name="text" id="imagen">
                                                          <p class="right"><i>Solo se permiten archivos con extensión  
                                                             PNG , DOCX , JPG , PDF y ZIP. </i></p>
                                                          <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                        </div>
                                                      
                                                    </div>                                   
                                                  </div>                                              
                                                </div>

                                            </div>
                                        </div>
                                      </div>

                                      <div class="col col s12 l6">
                                        <div class="card grey lighten-5">
                                          <div class="card-content">
                                              <span class="card-title">Datos del documento</span>

                                              <div class="row"> 
                                                <div class="col s12">
                                                  <label for="iddocumento">Tipo documento</label>
                                                  <select class="browser-default" id="iddocumento" name="iddocumento" required>
                                                    <option value="" disabled selected="">Seleccione</option>
                                                    <option value="Contrato">Contrato</option>
                                                    <option value="Tecnico">Doc. Técnico</option>
                                                    <option value="cedula">Cédula de Identidad</option>
                                                    <option value="otros">Otros</option> 
                                                  </select>
                                                  <div class="errorTxt2" id="h_error2" style="color: red; font-size: 12px; font-style: italic;"></div> 
                                                </div>
                                                <br> <br><br>
                                                <div class="input-field col s12">
                                                  <i class="material-icons prefix">subtitles</i>  
                                                  <input type="text" onkeyup="mayus(this);" name="descripcionAdj" id="descripcionAdj">
                                                  <label for="descripcionAdj">Descripción</label>
                                                  <div class="errorTxt3" id="h_error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div> 
                                                <div class="input-field col s12">
                                                  <i class="material-icons prefix" >subtitles</i>
                                                  <textarea class="materialize-textarea" name="glosa" id="glosa"  style="height: 14ex;" ></textarea>
                                                  <label for="glosa" >Comentario</label>
                                                </div> 
                                                     
                                                   
                                              </div>

                                          </div>
                                        </div>
                                      </div>

                                    </div>   
                                  </form>
                                  

              </div>
              
</div>

  
 