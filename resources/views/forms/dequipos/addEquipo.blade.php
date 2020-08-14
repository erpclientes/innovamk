<div id="vwEquipo" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>EQUIPOS DISPONIBLES</h2>
                                    </div>
                                  </div>
                                  <?php  $contador = 0;   ?>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <a id="addEquipo" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></a>
                                          <a style="margin-left: 6px"></a>


                                          <a id="#" href="#modal2" class=" modal-trigger btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-dely="500" data-tooltip="Agregar Equipo">
                                            <i class="material-icons " style="color: #2E7D32">add</i></a>    
                                            
                                          

                                          <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>   

           
                                        
                                  </div>
                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">      
                                      
                                      <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m6 l3">
                                                    <label for="idrouter">Servicios</label>
                                                    <select class="browser-default" id="s_idservicio" name="s_idservicio"> 
                                                      <option value="0" disabled="" selected="">Seleccione un servicio</option>
                                                      @foreach ($servicio as $valor)
                                                       @foreach($tipo as $tip)
                                                        @if($tip->idrouter == $valor->idrouter and $tip->dsc_corta == $valor->tipo_acceso)
                                                          <option value="{{ $valor->idservicio }}">{{ '('.$valor->idservicio.') '.$tip->descripcion }}</option>
                                                        @endif
                                                       @endforeach
                                                      
                                                      @endforeach
                                                    </select>
                                                    <div id="de_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="col s12 m6 l3">
                                                    <label for="idrouter">Agregar a comprobante</label>
                                                    <select class="browser-default" id="s_idaccion" name="s_idaccion"> 
                                                      <option value="0" disabled="" selected="">Seleccione una opción</option>
                                                      @foreach($comprobantes as $comp)
                                                      @foreach($tipo_documento_venta as $tipo)
                                                      @if($tipo->iddocumento == $comp->iddocumento)  
                                                        <option value="{{$comp->codigo}}">{{$tipo->dsc_corta.' '.$comp->serie.' '.$comp->numero}}</option>
                                                      @endif
                                                      @endforeach                                                      
                                                      @endforeach
                                                      <option value="NO_COMP">No agregar a comprobante</option>
                                                    </select>
                                                    <div id="de_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 l6 left-align">
                                                    <blockquote style="margin: 0px">Solo se listan aquellos equipos que aún no fueron asignados</blockquote>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                          


                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Lista de Equipos</span>
                                              <div class="row">
                                                <?php 
                                                  $bandera = false;

                                                  if (count($equipos) > 0) {
                                                    # code...
                                                    $bandera = true;
                                                    $i = 0;
                                                  }
                                                ?>                    
                                                  
                                                    <div class="card-content">
                                                      <form id="FormEquipo" accept-charset="UTF-8" enctype="multipart/form-data">
                                                        <input type="hidden" name="cont" id="cont" value="{{count($equipos)}}">
                                                        <input type="hidden" name="idservicio" id="idservicio" value="0">
                                                        <input type="hidden" name="idaccion" id="idaccion" value="0">
                                                        <input type="hidden" name="idcliente" id="idcliente" value="{{$idcliente}}">
                                                        <table id="tableEquipo" class="bordered responsive-table" cellspacing="0">
                                                           <thead>
                                                              <tr>
                                                                 <th class="center">Check</th>
                                                                 <th>Descripción</th>
                                                                 <th>Marca</th>
                                                                 <th>Modelo</th>
                                                                 <th>Modo</th>
                                                                 <th class="center" style="width: 8rem">Precio</th>                      
                                                                 <th class="center">Estado</th>
                                                              </tr>
                                                           </thead>

                                                           <tbody>
                                                             
                                                            <?php 
                                                                $i=0;
                                                                  foreach ($equipos as $valor) {
                                                                  $i++;
                                                               ?>
                                                            
                                                              <tr id="e">
                                                                <input type="hidden" name="idequipo{{$i}}" id="idequipo{{$i}}" value="{{$valor->idequipo}}">
                                                                 <td>
                                                                    <p class="center">
                                                                        <label for="c{{$valor->idequipo}}">
                                                                          <input type="checkbox" class="filled-in" id="c{{$valor->idequipo}}" name="check{{$i}}" tabindex="{{$i}}">
                                                                          <span></span>
                                                                      </label>
                                                                    </p>
                                                                 </td>
                                                                 <td>{{$valor->descripcion}}</td>
                                                                 <td>{{$valor->marca}}</td>
                                                                 <td>{{$valor->modelo}}</td>
                                                                 <td>{{$valor->modo}}</td>
                                                                 <td><input id='precio{{$i}}' name='precio{{$i}}' type='number' class='right-align input_numerico' style='margin: 0; height: 2rem; width: 80%'></td>
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
                                                              <?php } ?>

                                                              <?php  $contador = $i+1;   ?> 
                                                            
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


            @include('forms.clientes.modalAddEquipo') 

           

 
           
             
          

  