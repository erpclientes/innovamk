<div class="row cuerpo">
<br>
  
  <div class="col s12">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>SERVICIO DE INTERNET</h2>
                  </div>

                  <div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          @foreach($clientes as $datos)
                          <a href="{{ url('/servicio/nuevo') }}/{{$datos->idcliente}}" class="btn-floating waves-effect waves-light grey lighten-5">
                            <i class="material-icons " style="color: #03a9f4">add</i></a>
                          @endforeach
                          <a href="{{url('/clientes')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>     
                        </div>    
  
                        @include('forms.pruebas.scripts.modalInformacion')        
                  </div>
                                    
                  <div class="row">
                    <div class="col s12 m12 l12">                      
                        <div class="card-content">                          
                          <table id="data-table-simple" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Código</th>
                                     <th>Router</th>
                                     <th>Tipo Acceso</th>
                                     <th>Perfil</th>
                                     <th>Costo</th>  
                                     <th>Fecha Pago</th>                    
                                     <th class="center">Estado</th>
                                     <th class="center">Acciones</th>
                                  </tr>
                               </thead>
                               
                               <tbody>
                                <?php 
                                    $i = 0;
                                      foreach ($servicio as $valor) {
                                      $i++;
                                ?>
                                <tr>   
                                    <td><?php echo $i; ?></td>
                                    <td>{{$valor->idservicio}}</td>
                                    @foreach($router as $rou)
                                    @if($rou->idrouter == $valor->idrouter)
                                      <td>{{$rou->alias}}</td>
                                    @endif
                                    @endforeach
                                    @foreach($tipo as $tip)
                                    @if($tip->idrouter == $valor->idrouter and $tip->dsc_corta == $valor->tipo_acceso)
                                      <td>{{$tip->descripcion}}</td>
                                    @endif
                                    @endforeach  
                                    @foreach($perfiles as $perfil)
                                    @if($perfil->idperfil == $valor->perfil_internet)
                                      <td>{{$perfil->name}}</td>
                                    @endif
                                    @endforeach                   
                                    <td><?php echo $valor->precio ?></td>
                                    <td><?php echo $valor->dia_pago ?></td>
                                    <td style="width: 9rem">
                                    @if($valor->estado == 0)
                                    <div id="u_estado" class="chip center-align" style="width: 80%">
                                            <b>NO DISPONIBLE</b>
                                          <i class="material-icons"></i>
                                    </div>
                                    @else
                                        <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 80%">
                                          <b>ACTIVO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                     </td>
                                     
                                     <td class="center" style="width: 12rem">
                                       <a href="{{ url('/servicio/mostrar') }}/{{$valor->idservicio}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>                                       
                                       <a href="#alterServicio{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #ef9a9a ">delete</i></a>
                                      @if($valor->estado == 1)                                      
                                       <a href="#s_confirmacion2{{$valor->idservicio}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
                                        <i class="material-icons" style="color: #757575 ">clear</i></a>
                                       @else
                                       <a href="#s_confirmacion3{{$valor->idservicio}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
                                        <i class="material-icons" style="color: #2e7d32 ">check</i></a>
                                       @endif
                                       @if($valor->activar_notificacion == 1)                                      
                                        <a href="#s_confirmacion5{{$valor->idservicio}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desactivar aviso en pantalla">
                                        <i class="material-icons" style="color: #dd2c00">remove</i></a>
                                       @else
                                       <a href="#s_confirmacion4{{$valor->idservicio}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Activar aviso en pantalla">
                                        <i class="material-icons" style="color: #26a69a  ">done</i></a>                                       
                                       @endif
                                     </td>
                                  </tr>
                                  @include('forms.servicio.scripts.alertaConfirmacion')
                                  @include('forms.servicio.scripts.alertaConfirmacion2')
                                  @include('forms.servicio.scripts.alertaConfirmacion3')
                                  @include('forms.servicio.scripts.alertaConfirmacion4')
                                  @include('forms.servicio.scripts.alertaConfirmacion5')
                                  <?php } ?>
                               </tbody>
                            </table>
                          </div> <br>                   
                  </div>

                </div>
    </div>
  </div>

  <div class="col s12">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>EQUIPOS</h2>
                  </div>

                  <div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          <a id="verEquipos" class="btn-floating waves-effect waves-light grey lighten-5 modal-trigger tooltipped" data-position="top" data-delay="500" data-tooltip="Agregar equipo">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          <a style="margin-left: 6px"></a>   
                          <a href="{{url('/clientes')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>     
                        </div>    
  
                        @include('forms.dequipos.addEquipo')        
                  </div>

                  <div class="row">
                    <div class="col s12 m12 l12">                      
                        <div class="card-content">
                          <table id="data-table-simple" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Equipo</th>
                                     <th>Marca</th>
                                     <th>Modelo</th>
                                     <th>Modo</th>  
                                     <th>IP</th>                    
                                     <th>Estado</th>
                                     <th class="center">Acciones</th>
                                  </tr>
                               </thead>
                              
                               <tfoot>
                                  <tr>
                                     <th>#</th>
                                     <th>Equipo</th>
                                     <th>Marca</th>
                                     <th>Modelo</th>
                                     <th>Modo</th>  
                                     <th>IP</th>                    
                                     <th>Estado</th>
                                     <th>Acciones</th>
                                  </tr>
                               </tfoot>

                               <tbody>
                                <?php 
                                    $i=0;
                                      foreach ($dequipos as $equipo) {
                                      $i++;
                                ?>
                                <tr>   
                                    <td>{{$i}}</td>
                                    <td>{{$equipo->descripcion}}</td>
                                    <td>{{$equipo->marca}}</td>
                                    <td>{{$equipo->modelo}}</td>
                                    <td>{{$equipo->modo}}</td>
                                    <td>{{$equipo->ip}}</td>
                                    <td>
                                    @if($equipo->idestado == 'AS')
                                      <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                          <b>ASIGNADO</b>
                                          <i class="material-icons"></i>
                                      </div>
                                    @else

                                      @if ($equipo->modo == 'EMISOR')
                                            <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                              <b>CONECTADO</b>
                                              <i class="material-icons"></i>
                                          </div>
                                      @else 
                                          <div id="u_estado" class="chip center-align" style="width: 70%">
                                            <b>SIN ASIGNAR</b>
                                          <i class="material-icons"></i>
                                      </div>  
                                      @endif                                     
                                    @endif
                                    </td>
                                     
                                     <td class="center" style="width: 12rem">
                                       <a href="{{ url('/equipos/mostrar') }}/{{$equipo->idequipo}}" target="_blank" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>   
                                      @if($equipo->facturado == "NO")          
                                       <a href="#vwNewComprobante" id="newComprobante{{$equipo->idequipo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Nuevo comprobante" data-precio="{{$equipo->costo}}" data-idequipo="{{$equipo->idequipo}}" data-descripcion="{{$equipo->descripcion}}" data-idservicio="{{$equipo->idservicio}}">
                                        <i class="material-icons" style="color: #00897b  ">playlist_add</i></a>             
                                       <a href="#vwComprobante" id="addComprobante{{$equipo->idequipo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Agregar a comprobante PE" data-precio="{{$equipo->costo}}" data-idequipo="{{$equipo->idequipo}}" data-idservicio="{{$equipo->idservicio}}">
                                        <i class="material-icons" style="color: #ffd54f ">autorenew</i></a>     
                                      @endif
                                       
                                     </td>
                                  </tr>
                                  
                                  <?php } ?>
                               </tbody>
                            </table>
                            @include('forms.dequipos.addComprobante') 
                            @include('forms.dequipos.newComprobante')  
                          </div> <br>                   
                  </div>

                </div>

    </div>
  </div>

  <div class="col s12">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>DOCUMENTOS ADJUNTOS</h2>
                  </div>

                  <div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          <a href="#vwDocumentos" class="btn-floating waves-effect waves-light grey lighten-5 modal-trigger tooltipped" data-position="top" data-delay="500" data-tooltip="Agregar Documento">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          <a style="margin-left: 6px"></a>   
                          <a href="{{url('/clientes')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>     
                        </div>    
  
                        @include('forms.clientes.documentos.addDocumentos')        
                  </div>

                  <div class="row">
                    <div class="col s12 m12 l12">                      
                        <div class="card-content">
                          <table id="data-table-simple" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr> 
                                     <th>#</th>
                                     <th>Nombre</th>
                                     <th>Tipo de Documento</th>
                                     <th>Formato de Documento</th>
                                     <th>Fecha de Creación</th>  
                                     <th>Descripción</th> 
                                     <th class="center">Acciones</th>        
                                  </tr>
                               </thead>
                              
                               <tfoot>
                                  <tr>
                                     <th>#</th>
                                     <th>Nombre</th>
                                     <th>Tipo de Documento</th>
                                     <th>Formato de Documento</th>
                                     <th>Fecha de Creación</th>  
                                     <th>Descripción</th>  
                                     <th  >Acciones</th>
                                  </tr>
                               </tfoot>

                               <tbody>
                                <?php 
                                    $i=0;
                                      foreach ($adjuntos as $item) {
                                      $i++;
                                ?>
                                <tr>   
                                    <td>{{$i}}</td>
                                    <td>{{$item->nombre}}</td>
                                    <td>{{$item->tipo_doc}}</td>
                                    <td>
                                      @if ($item->carpeta == 'imagen')
                                      <div class="col s8 m8 l6 center" style="margin: auto; width: 100%">
                                        <img src="{{asset('images/TipoArchivo/IMAGE.png')}}" alt="" id="" class=" responsive-img valign profile-image " style="width:45px;height:45px ;"> </div>
                                      @endif
                                      @if ($item->carpeta == 'pdf')
                                      <div class="col s8 m8 l6 center" style="margin: auto; width: 100%">
                                        <img src="{{asset('images/TipoArchivo/PDF.png')}}" alt="" id="" class=" responsive-img valign profile-image " style="width:45px;height:45px ;"> </div> 
                                      @endif
                                      @if ($item->carpeta == 'word')
                                      <div class="col s8 m8 l6 center" style="margin: auto; width: 100%">
                                        <img src="{{asset('images/TipoArchivo/WORD.png')}}" alt="" id="" class=" responsive-img valign profile-image " style="width:35px;height:35px ;"> </div>
                                      @endif
                                      @if ($item->carpeta == 'zip')
                                      <div class="col s8 m8 l6 center" style="margin: auto; width: 100%">
                                        <img src="{{asset('images/TipoArchivo/ZIP.png')}}" alt="" id="" class=" responsive-img valign profile-image " style="width:55px;height:55px ;"> </div>
                                      @endif  
                                    </td>
                                    <td>{{$item->fecha_creacion}}</td>
                                    <td>{{$item->descripcion}}</td> 
                                    <td class="center" style="width: 12rem"> 
                                        <a href="{{asset('documentosAdj/')}}/{{$item->carpeta}}/{{$item->nombre}}" download="{{$item->nombre}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="descargar">
                                          <i class="material-icons grey-text text-darken-4">vertical_align_bottom</i>
                                        </a>
                                        <a href="#confirmacion{{$item->iddocumento}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                          <i class="material-icons" style="color: #ef9a9a ">delete</i></a>
                                    </td> 
                                   
                                                                          
                                      
                                </tr>
                                      @include('forms.clientes.documentos.scripts.alertaConfirmacion')
                                  
                                  <?php } ?>
                               </tbody>
                          </table>
                           
                            @include('forms.dequipos.addComprobante') 
                            @include('forms.dequipos.newComprobante')  
                        </div>                   
                  </div>

                </div>

    </div>
  </div>
</div>
      


