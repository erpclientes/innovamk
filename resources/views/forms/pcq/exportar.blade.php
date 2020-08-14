<div id="ePCQ" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>EXPORTAR PERFILES PCQ</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="exportPCQ" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Exportar">
                                            <i class="material-icons" style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>   
                                          <a id="e_pcq_allCheck" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Seleccionar todo">
                                            <i class="material-icons" style="color: #4a148c">radio_button_checked</i></a>
                                            <a id="e_pcq_clearCheck" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Quitar checkeds">
                                            <i class="material-icons" style="color: #616161">radio_button_unchecked</i></a>
                                          <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  
            
                                        
                                  </div>
                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">      
                                      
                                                                            
                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Perfiles de Internet</span>
                                              <div class="row">
                                                <?php 
                                                  $bandera = false;

                                                  if (count($pcq) > 0) {
                                                    # code...
                                                    $bandera = true;
                                                    $i = 0;
                                                  }
                                                ?>                    
                                                  
                                                    <div class="card-content">
                                                      
                                                      <table id="tableHotspot" class="bordered responsive-table" cellspacing="0">
                                                           <thead>
                                                              <tr>
                                                                 <th class="center">Check</th>
                                                                 <th>Router</th>
                                                                 <th>Desc. Perfil</th>
                                                                 <th>Target</th>                         
                                                                 <th class="center">Estado</th>
                                                              </tr>
                                                           </thead>
                                                           <?php
                                                                if($bandera){                                                           
                                                            ?>
                                                           
                                                           <tbody>
                                                                                                                         
                                                            <?php 
                                                                  foreach ($pcq as $valor) {
                                                                  $i++;
                                                               ?>
                                                            <form id="formPCQ{{$valor->idperfil}}" accept-charset="UTF-8" enctype="multipart/form-data" class="grey lighten-5">
                                                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                              <input type="hidden" name="idperfil" value="{{$valor->idperfil}}">
                                                              <tr id="e{{$valor->idperfil}}">
                                                              
                                                                 <td>
                                                                    <p class="center">
                                                                      <label for="c{{$valor->idperfil}}">
                                                                        <input type="checkbox" class="filled-in" id="c{{$valor->idperfil}}" name="check" tabindex="{{$i}}">
                                                                        <span></span>
                                                                      </label>
                                                                    </p>
                                                                 </td>
                                                                 <td>
                                                                  @foreach($router as $rou) 
                                                                    @if($rou->idrouter == $valor->idrouter)
                                                                      {{$rou->alias}}
                                                                    @endif
                                                                  @endforeach                                       
                                                                  </td>
                                                                 <td><?php echo $valor->name ?></td>
                                                                 <td><?php echo $valor->rate_limit ?></td>
                                                                 <td class="center">
                                                                    @if($valor->estado == 0)
                                                                    <div class="chip center-align" style="width: 100%">
                                                                        <b>NO DISPONIBLE</b>
                                                                      <i class="material-icons"></i>
                                                                    </div>
                                                                  @else
                                                                    <div class="chip center-align teal accent-4 white-text" style="width: 100%">
                                                                      <b>ACTIVO</b>
                                                                      <i class="material-icons"></i>
                                                                    </div>
                                                                  @endif
                                                                 </td>
                                                                 
                                                              </tr>
                                                              </form>   
                                                              <?php }} ?>
                                                            
                                                           </tbody>
                                                        </table>
                                                      </div> 


                                               

                                              </div> 
                                            </div>
                                        </div>                                        
                                            

                                    </div>   
                                  

              </div>
              
            </div>

