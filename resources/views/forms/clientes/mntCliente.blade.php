<br>
 
@foreach($clientes as $datos)
<div class="row">
  <div class="col s12 m7 l9">
      <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRO CLIENTE </h2>
                  </div>
                  <form class="formValidate right-alert" id="formValidate" method="POST" action="{{ url('/clientes/actualizar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i></button>
                          <a style="margin-left: 6px"></a>   
                          <a href="{{url('/clientes')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>            
                        </div>  
                        @include('forms.scripts.modalInformacion')                   
                  </div>
      <div class="row">
        <div class="col s12 m12 l7">               
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idcliente" value="{{ $datos->idcliente }}">
                    <div class="card" style="margin-left: 20px; margin-top: 20px">
                        <div class="card-content">
                          <span class="card-title">Generales</span>
                            <div class="row">
                              <div class="col s12 m6 l6">
                                  <label for="idempresa">Empresa</label>                 
                                  <select class="browser-default" id="idempresa" name="idempresa" required>
                                    <option value="" disabled selected="">Seleccione</option>
                                    @foreach($empresa as $val)
                                    @if($val->idempresa == $datos->idempresa)
                                      <option value="{{$val->idempresa}}" selected> {{$val->razon_social}}</option>
                                    @endif
                                    @endforeach
                                    @foreach($empresa as $val)
                                    @if($val->idempresa != $datos->idempresa)
                                      <option value="{{$val->idempresa}}"> {{$val->razon_social}}</option>
                                    @endif
                                    @endforeach
                                  </select>
                                  <div class="errorTxt1"></div>
                              </div>
                              <div class="col s12 m6 l6">
                                <label for="iddocumento">Documento</label>
                                @foreach($parametros as $val)
                                @if($val->parametro == 'ADD_COD_INTERNO' and $val->valor == 'SI')
                                  <select class="browser-default" id="iddocumento" name="iddocumento" required disabled> 
                                    <option value="COD" disabled selected="">Código interno</option>                                  
                                  </select>
                                @elseif($val->parametro == 'ADD_COD_INTERNO' and $val->valor == 'NO')
                                <select class="browser-default" id="iddocumento" name="iddocumento" required>
                                  <option value="" disabled selected="">Seleccione</option>
                                  @foreach($tipo_documento as $documento)
                                  <option value="{{$documento->iddocumento}}" {{ $documento->iddocumento == $datos->iddocumento ? "selected" : "" }}>{{$documento->dsc_corta}} - {{$documento->descripcion}}</option>
                                  @endforeach
                                @endif
                                @endforeach
                                </select>
                                <div class="errorTxt1"></div>
                              </div>
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix active">label_outline</i>
                                @foreach($parametros as $val)
                                @if($val->parametro == 'ADD_COD_INTERNO' and $val->valor == 'SI')
                                <input id="nro_documento" name="nro_documento" type="text" data-error=".errorTxt2" maxlength="20" value="{{ $datos->nro_documento }}" onkeyup="mayus(this);" disabled>
                                @elseif($val->parametro == 'ADD_COD_INTERNO' and $val->valor == 'NO')
                                <input id="nro_documento" name="nro_documento" type="text" data-error=".errorTxt2" maxlength="20" value="{{ $datos->nro_documento }}" onkeyup="mayus(this);">
                                @endif
                                @endforeach
                                <label for="nro_documento">Nro. Documento</label>
                                <div class="errorTxt2"></div>
                              </div>          
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="apaterno" name="apaterno" type="text" data-error=".errorTxt3" value="{{ $datos->apaterno }}">
                                <label for="apaterno">Apellido Paterno</label>
                                <div class="errorTxt3"></div>
                              </div>
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="amaterno" name="amaterno" type="text" data-error=".errorTxt4" value="{{ $datos->amaterno }}">
                                <label for="amaterno">Apellido Materno</label>
                                <div class="errorTxt4"></div>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">person</i>
                                <input   id="nombres" name="nombres" type="text" data-error=".errorTxt5" value="{{ $datos->nombres }}"  >
                                <label for="nombres">Nombres</label>
                                <div class="errorTxt5"></div>
                              </div>  
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">maps_local</i>
                                <input id="latitudF" name="latitudF" type="text" value="{{ $datos->latitud }}" readonly="readonly">
                                <label for="latitudF">Incorporar latitud</label>
                              </div>
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">maps_local</i>
                                <input id="longitudF" name="longitudF" type="text" value="{{ $datos->longitud }}" readonly="readonly" >
                                <label for="longitudF">Incorporar longitud</label>
                              </div>
                              <div class="input-field col s12 m6 l12">
                                <i class="material-icons prefix">room</i>
                                <input id="direccion"  readonly="readonly" name="direccion" type="text" value="{{ $datos->direccion }}">
                                <label for="direccion">Dirección</label>
                              </div>

                              {{-- <div class="input-field col s12 m6 l6">
                                <label for="zonas">ZONAS</label>
                                <select class="browser-default" id="zonas" name="zonas" required>
                                  <option value="" disabled>Seleccione</option>
                                  @foreach($zonas as $fp)
                                  <option value="{{$fp->id }}" {{ $fp->id== $datos->idZonas ? "selected" : "" }}>{{$fp->nombre}}</option>
                                  @endforeach
                                </select> 
                              </div> --}}  

                              
                              {{-- Modal  --}}
                                <div class="col s12  "> 
                                <a type="button" class="waves-effect waves-light btn modal-trigger gradient-45deg-indigo-blue col s12" href="#modalUpdate" id="modalActualizarClienteDir"  style="height: 44px; letter-spacing: .4px; padding-top: 0.3rem;"   >Actualizar Dirección</a>
                                @include('forms.clientes.mapa.mapsClienteUpdate')
                                
                              </div>  
                            </div>               
                        </div>
                      </div>
        </div>
        <div class="col s12 m12 l5">
                
                <div class="card" style="margin-right: 20px; margin-top: 20px">
                        <div class="card-content">
                          <span class="card-title">Datos Doc. Venta</span>
                             <div class="row">
                                  <div class="col s12 m12 l12">
                                    <label for="forma_pago">Forma de Pago</label>
                                    <select class="browser-default" id="forma_pago" name="forma_pago" required>
                                      <option value="" disabled>Seleccione</option>
                                      @foreach($forma_pagos as $fp)
                                      <option value="{{$fp->idforma_pago}}" {{ $fp->idforma_pago == $datos->forma_pago ? "selected" : "" }}>{{$fp->descripcion}}</option>
                                      @endforeach
                                    </select> 
                                  </div>   
                                  <div class="col s12 m12 l12">
                                    <label for="doc_venta">Comp. de Venta</label>
                                    <select class="browser-default" id="doc_venta" name="doc_venta" required>
                                      <option value="" disabled>Seleccione</option>
                                      @foreach($tipo_documento_venta as $tdv)
                                      <option value="{{$tdv->iddocumento}}" {{ $tdv->iddocumento == $datos->doc_venta ? "selected" : "" }}>{{$tdv->descripcion}}</option>
                                      @endforeach
                                    </select>
                                  </div>                        
                                </div> 
                                <div class="row">                               
                                  <div class="col s12 m12 l12">
                                    <label for="moneda">Moneda</label>
                                    <select class="browser-default" id="moneda" name="moneda" required>
                                      <option value="" disabled>Seleccione</option>
                                      @foreach($moneda as $m)
                                      <option value="{{$m->idmoneda}}" {{ $m->idmoneda == $datos->moneda ? "selected" : "" }}>{{$m->descripcion}} - {{$m->dsc_corta}}</option>
                                      @endforeach
                                    </select> 
                                  </div>   
                                  <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix active">event</i>
                                    @if(count($servicio) > 0)
                                      @foreach($servicio as $val)
                                      <input id="dia_pago" name="dia_pago" type="number" value="{{ $val->dia_pago }}" disabled="">
                                      @endforeach
                                    @else
                                      <input id="dia_pago" name="dia_pago" type="text" value="No registrado" disabled="">
                                    @endif
                                    <label for="dia_pago">Día de Pago</label>
                                  </div>    
                                  <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix active">attach_money</i>
                                    @if(count($servicio) > 0)
                                      @foreach($servicio as $val)
                                      <input id="precio" name="precio" type="number" value="{{ $val->precio }}" disabled="">
                                      @endforeach
                                    @else
                                      <input id="precio" name="precio" type="text" value="No registrado" disabled="">
                                    @endif
                                    <label for="precio">Monto</label>
                                  </div>                        
                                </div> 
                                
                              </div>
                        </div>
        </div>

        <div class="col s12 ">                        
                  
                    <div class="card" style="margin-left: 20px; margin-right: 20px">
                        <div class="card-content">
                          <span class="card-title">Contacto</span>
                             <div class="row"> 
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">email</i>
                                <input id="contacto" name="contacto" type="text" value="{{ $datos->contacto }}">
                                <label for="contacto">Contacto</label>
                              </div>    
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">perm_contact_cal</i>
                                <input id="correo" name="correo" type="text" value="{{ $datos->correo }}">
                                <label for="correo">Email</label>
                              </div>                               
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">call</i>
                                <input id="telefono1" name="telefono1" type="text" value="{{ $datos->telefono1 }}">
                                <label for="telefono1">Telefono 1</label>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                 <i class="material-icons prefix">call</i>
                                <input id="telefono2" name="telefono2" type="text" value="{{ $datos->telefono2 }}">
                                <label for="telefono2">Telefono 2</label>
                              </div>  
                              <div class="input-field col s12">
                                <i class="material-icons prefix">mode_edit</i>
                                <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" value="">{{ $datos->glosa }}</textarea>
                                <label for="glosa" class="">Comentario</label>
                              </div>            
                            </div>
                                
                              </div>
                            </div>     

        </div>
      </div>     
                      
                  </form>
              </div>
  </div>


  

                            {{--  <div class="col s12 m5 l3 bordes" style="padding-left: 5px">
                                <ul id="task-card" class="collection with-header" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);" >  --}}
                                    
                                    @if(count($servicio) > 0)
                                      @foreach($servicio as $ser)
                                        @foreach ($notificaciones as $val)
                                          @if ($ser->idservicio==$val->idservicio)
                                          <ul id="task-card" class="collection with-header" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);" >
                                              <li class="collection-header cyan">
                                                <h4 class="task-card-title">Resumen</h4>
                                                <p class="task-card-date">Notificaciones</p>
                                                @foreach($perfiles as $perfil)
                                                  @if($perfil->idperfil == $ser->perfil_internet) 
                                                    <p class="task-card-date">Servicio : {{$perfil->name}} </p>
                                                  @endif
                                                @endforeach  
                                                
                                              </li> 
                                              <li class="collection-item dismissable grey-text darken-1" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                <i class="material-icons">event</i>
                                                Día Pago
                                                <a href="#" class="secondary-content"><span class="task-cat teal">
                                                      @if($val->aviso >0)
                                                        {{ date_format(date_create($val->fecha_pago),'d/m/Y') }}
                                                      @else
                                                        Desabilitado
                                                      @endif
                                                  </span></a>
                                              </li>

                                              <li class="collection-item dismissable grey-text darken-1" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                  <i class="material-icons">credit_card</i>
                                                  Facturación
                                                  <a href="#" class="secondary-content"><span class="task-cat purple"> 
                                                    @if($val->aviso >0)
                                                      {{ date_format(date_create($val->fecha_facturacion),'d/m/Y') }}
                                                    @else
                                                      Desabilitado
                                                    @endif 
                                                  </span></a>
                                                  
                                              </li>
                                            
                                              <li class="collection-item dismissable grey-text darken-1" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                  <i class="material-icons">alarm</i>
                                                  Aviso
                                                  <a href="#" class="secondary-content"><span class="task-cat  amber darken-2">
                                                    @if($val->aviso >0)
                                                      {{ date_format(date_create($val->fecha_aviso),'d/m/Y') }}
                                                    @else
                                                      Desabilitado
                                                    @endif
                                                  </span></a>
                                                  
                                              </li>
                                              <li class="collection-item dismissable grey-text darken-1" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                  <i class="material-icons">report_problem</i>
                                                  Corte
                                                  <a href="#" class="secondary-content"><span class="task-cat indigo darken-1">                                          
                                                    @if($val->corte > 0)
                                                      {{ date_format(date_create($val->fecha_corte),'d/m/Y') }}
                                                    @else
                                                      Desabilitado
                                                    @endif
                                                  </span></a>
                                                  
                                              </li>
                                         </ul>
                                        @endif
                                            
                                      @endforeach
                                      @endforeach
                                    @else
                                    
                                    <ul id="task-card" class="collection with-header" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);" >
                                        <li class="collection-header cyan">
                                          <h4 class="task-card-title">Resumen</h4>
                                          <p class="task-card-date">Notificaciones</p>
                                        </li>
                                        <li class="collection-item dismissable grey-text darken-1" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            <i class="material-icons">event</i>
                                            Día Pago
                                            <a href="#" class="secondary-content"><span class="task-cat teal">
                                              Desabilitado
                                              </span></a>
                                        </li>
  
                                        <li class="collection-item dismissable grey-text darken-1" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            <i class="material-icons">credit_card</i>
                                            Facturación
                                            <a href="#" class="secondary-content"><span class="task-cat purple">
                                              Desabilitado
                                            </span></a>
                                            
                                        </li>
                                      
                                        <li class="collection-item dismissable grey-text darken-1" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            <i class="material-icons">alarm</i>
                                            Aviso
                                            <a href="#" class="secondary-content"><span class="task-cat  amber darken-2">
                                              Desabilitado
                                            </span></a>
                                            
                                        </li>
                                        <li class="collection-item dismissable grey-text darken-1" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            <i class="material-icons">report_problem</i>
                                            Corte
                                            <a href="#" class="secondary-content"><span class="task-cat indigo darken-1">
                                              Desabilitado
                                            </span></a>
                                            
                                        </li>
                                      </ul>
                                    @endif
                                   
                                    
                                    
                                {{--  </ul>  --}}
                            </div>

                            @if(!is_null($datos->longitud ))
                            <div class="col s12 m5 l3" style="padding-left: 5px">
                                <div class="map-card">
                                    <div class="card">
                                        <div class="card-image waves-effect waves-block waves-light" style="height: 18rem; width: 100%"> 

                                            <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q={{ $datos->latitud }},{{$datos->longitud}}+(empresa)&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.mapsdirections.info/marcar-radio-circulo-mapa/">Dibuja un circulo Google Maps</a></div>

                                        </div>
                                        <div class="card-content">                    
                                            <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                                <i class="material-icons">pin_drop</i>
                                            </a>
                                            <h4 class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">{{$datos->direccion}}</a>
                                            </h4> 
                                            <p class="blog-post-content">Información de referencia del cliente</p>
                                        </div>
                                        <div class="card-reveal">
                                            <span class="card-title grey-text text-darken-4">{{ $datos->apaterno.' '.$datos->amaterno.' '.$datos->nombres }} <i class="material-icons right">close</i></span>                   
                                            
                                            @if(!is_null($datos->direccion))
                                            <p><i class="material-icons cyan-text text-darken-2">room</i>{{$datos->direccion}}</p>
                                            @endif  
                                            @if(!is_null($datos->telefono1))
                                            <p><i class="material-icons cyan-text text-darken-2">perm_phone_msg</i> {{$datos->telefono1}}</p>
                                            @endif  
                                            @if(!is_null($datos->correo))
                                            <p><i class="material-icons cyan-text text-darken-2">email</i> {{$datos->correo}}</p>   
                                            @endif                 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            

                            @foreach ($dequipos as $equipo)
                            @if(!is_null($equipo->longitud ))
                            <div class="col s12 m5 l3" style="padding-left: 5px">
                                <div class="map-card">
                                    <div class="card">
                                        <div class="card-image waves-effect waves-block waves-light" style="height: 18rem; width: 100%"> 

                                            <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q={{ $equipo->latitud }},{{$equipo->longitud}}&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.mapsdirections.info/marcar-radio-circulo-mapa/">Dibuja un circulo Google Maps</a></div>

                                        </div>
                                        <div class="card-content">                    
                                            <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                                <i class="material-icons">pin_drop</i>
                                            </a>
                                            <h4 class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">{{$equipo->direccion}}</a>
                                            </h4> 
                                            <p class="blog-post-content">Información de referencia del equipo</p>
                                        </div>
                                        <div class="card-reveal">
                                            <span class="card-title grey-text text-darken-4">EQUIPO  {{ $equipo->modo }} <i class="material-icons right">close</i></span>
                                            
                                            <p><i class="material-icons cyan-text text-darken-2">forward</i> MARCA : {{$equipo->modelo}}</p>

                                            <p><i class="material-icons cyan-text text-darken-2">forward</i> MODELO : {{$equipo->marca}}</p>

                                            <p><i class="material-icons cyan-text text-darken-2">forward</i> ZONA : {{$equipo->nombre}}</p> 
                                            
                                            {{--  @if(!is_null($equipo->direccion))
                                            <p><i class="material-icons cyan-text text-darken-2">room</i>{{$equipo->direccion}}</p>
                                            @endif  
                                            @if(!is_null($equipo->telefono1))
                                            <p><i class="material-icons cyan-text text-darken-2">perm_phone_msg</i> {{$equipo->telefono1}}</p>
                                            @endif  
                                            @if(!is_null($equipo->correo))
                                            <p><i class="material-icons cyan-text text-darken-2">email</i> {{$equipo->correo}}</p>   
                                            @endif   --}}                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                                
                            @endforeach

                            <?php  
                                $i=0; 
                                foreach ($adjuntos as $item) { 
                                  if (!is_null($item->nombre)){
                                    $i++;

                                  } 
                                }
                            ?>  
                          @if( $i!=0)
                          <div class="col s12 m12 l3 bordes"   >
                            <ul id="task-card" class=" collection with-header " style=" background-color: white; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);" >
                                <li class="collection-header cyan" >
                                    <h6 class="task-card-title"> ARCHIVOS ADJUNTOS</h6>
                                    <p class="task-card-date">Notificaciones</p>
                                </li> 


                                <li> 
                                  <?php  
                                  foreach ($adjuntos as $item) { 
                                   ?>     
                                
                                  <td  class="card-content">
                                    @if ($item->carpeta == 'imagen')
                                    <div class="col s6 m4 l6 center" style="word-wrap: break-word; " >
                                      <img src="{{asset('images/TipoArchivo/IMAGE.png')}}" alt="" id="" class=" responsive-img valign profile-image " style="width:45px;height:45px ;" > <br><p >{{$item->nombre}} </div> 
                                    @endif
                                    @if ($item->carpeta == 'pdf')
                                    <div class="col s6 m4 l6 center" style="word-wrap: break-word; ">
                                      <img src="{{asset('images/TipoArchivo/PDF.png')}}" alt="" id="" class=" responsive-img valign profile-image " style="width:45px;height:45px ;"><br>{{$item->nombre}}</div>  
                                    @endif
                                    @if ($item->carpeta == 'word') 
                                    <div class="col s6 m4 l6 center" style="word-wrap: break-word; ">
                                      <img src="{{asset('images/TipoArchivo/WORD.png')}}" alt="" id="" class=" responsive-img valign profile-image " style="width:35px;height:35px ;"><br>{{$item->nombre}}</div> 
                                    @endif
                                    @if ($item->carpeta == 'zip') 
                                    <div class="col s6 m4 l6 center" style="word-wrap: break-word; ">
                                      <img src="{{asset('images/TipoArchivo/ZIP.png')}}" alt="" id="" class=" responsive-img valign profile-image " style="width:45px;height:45px ;"><br>{{$item->nombre}}</div> 
                                    @endif  
                                  </td>   
                                  
                                   <?php } ?>  

                                </li> 
                            </ul>
                          </div> 
                          @endif




          




                         
                           
</div> 
</div>  
@endforeach

@include('forms.scripts.toast') 



