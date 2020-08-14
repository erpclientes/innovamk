<div id="ivw_PCQ" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>IMPORTAR PERFILES DEL MIKROTIK</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="importPCQ" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          <a id="i_pcq_allCheck" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Seleccionar todo">
                                            <i class="material-icons " style="color: #4a148c">radio_button_checked</i></a>
                                          <a id="i_pcq_clearCheck" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Quitar checkeds">
                                            <i class="material-icons " style="color: #616161">radio_button_unchecked</i></a>
                                          <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">      
                                      
                                      <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="ipcq_idrouter" name="ipcq_idrouter" data-error=".errorTxt1" > 
                                                      <option value="0" disabled="" selected="">Elija un router</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div id="ipcq_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 left-align">
                                                    <blockquote style="margin: 0px">Los perfiles a importar serán registrados si es que no exiten en la base de datos.</blockquote>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                          


                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Perfiles de Internet</span>
                                              <div class="row">
                                                <?php 
                                                  $bandera = false;

                                                  if (count($hotspot) > 0) {
                                                    # code...
                                                    $bandera = true;
                                                    $i = 0;
                                                  }
                                                ?>                    
                                                  
                                                    <div class="card-content">
                                                      <form id="formImportPCQ" accept-charset="UTF-8" enctype="multipart/form-data">
                                                        <input type="hidden" name="pcq_cont" id="pcq_cont" value="0">
                                                        <input type="hidden" name="pcq_id_router" id="pcq_id_router" value="0">
                                                        <table id="tableImportPCQ" class="bordered responsive-table" cellspacing="0">
                                                           <thead>
                                                              <tr>
                                                                 <th class="center">Check</th>
                                                                 <th class="center" style="width: 180px">Plan Internet</th>
                                                                 <th>Nombre</th>
                                                                 <th class="center">Velocidad</th>  
                                                                 <th class="center" style="width: 8rem">Precio</th>   
                                                                 <th class="center">Agrupar</th>  
                                                                 <th class="center">Estado</th>
                                                              </tr>
                                                           </thead>
                                                          
                                                           
                                                           <tbody>
                                                                                                                         
                                                           
                                                            
                                                           </tbody>
                                                        </table>
                                                      </form>
                                                      </div> 


                                               

                                              </div> 
                                            </div>
                                        </div>                                        
                                            

                                    </div>   
                                  

              </div>
              
            </div>

  