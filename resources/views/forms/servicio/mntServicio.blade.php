@extends('layouts2.app')
@section('titulo','Registro de Servicio')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRAR SERVICIO</h2>
                  </div>
                  <form class="formValidate right-alert">
                    <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <button id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i></button>
                          <a href="{{url('/cliente')}}/{{$idcliente}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.servicio.frmIpPool')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col s12 m12 l12">
                          <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m5 l5">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="idrouter" name="idrouter" data-error=".errorTxt2" > 
                                                      <option value="" disabled="" selected="">Elija un router</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error11" style="color: red; font-size: 8px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="col s12 m4 l4">
                                                    <label for="zonas">ZONAS</label>
                                                    <select class="browser-default" id="zonas" name="zonas" required>
                                                      <option value="" disabled selected="">Seleccione</option>
                                                      @foreach($zonas as $zn)
                                                      <option value="{{$zn->id }}">{{$zn->nombre}}</option>
                                                      @endforeach
                                                    </select> 
                                                    <div class="errorTxt1" id="error10" style="color: red; font-size: 8px; font-style: italic;"></div> 
                                                  </div>

                                                  <div class="input-field col s12 s12 m3 l3 right-align">
                                                    <div class="chip center-align" style="width: 70%">
                                                      <b>Estado:</b> No Disponible
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                                       
                      </div>  

                      <div class="col s12 m12 l6">
                          <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Datos Generales</span>

                                              <div class="row">                                                  
                                                  <div class="col s12 m6 l6">                                                    
                                                    <label for="idtipo">Tipo de Acceso</label>
                                                    <select class="browser-default" id="idtipo" name="idtipo" data-error=".errorTxt1" disabled> 
                                                      <option value="0" disabled="" selected="">Elija opción</option>
                                                      @foreach ($tipo as $valor)
                                                      <option value="{{ $valor->dsc_corta }}">{{ $valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="col s12 m6 l6">
                                                    <label for="idperfil">Perfil de Internet</label>
                                                    <select class="browser-default" id="idperfil" name="idperfil" data-error=".errorTxt1" disabled> 
                                                      <option value="cero" disabled="" selected="">Seleccione un perfil</option>
                                                    </select>
                                                    <div class="errorTxt1" id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      
                                                </div>           
                                              <div class="row"> 
                                                @if($parent == 'SI')
                                                <div class="col s12 m6 l6">
                                                    <label for="parent">Seleccionar Parent</label>
                                                    <select class="browser-default" id="parent" name="parent" data-error=".errorTxt1" disabled> 
                                                      <option value="cero" disabled="" selected="">Seleccione un perfil</option>
                                                      @if('SI' == 'SI')
                                                      <option value="Outside A&J">Outside A&J</option>
                                                      <option value="Outside Lorvin">Outside Lorvin</option>
                                                      <option value="Outside A&J 2">Outside A&J 2</option>
                                                      @endif
                                                    </select>
                                                    <div class="errorTxt1" id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>  
                                                @endif
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">attach_money</i>
                                                  <input id="precio" name="precio" type="text" placeholder="" maxlength="9">
                                                  <label for="precio">Precio del Plan</label>
                                                  <div class="errorTxt1" id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>  
                                                @foreach($parametros as $parametro)
                                                @if($parametro->parametro == 'DIA_PAGO_CLIENTES')
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">insert_invitation</i>
                                                  <input id="dia_pago" name="dia_pago" type="text" maxlength="2" value="{{$parametro->valor_long}}">
                                                  <label for="dia_pago">Día de Pago</label>
                                                  <div class="errorTxt1" id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>
                                                @endif
                                                @endforeach                                                
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">account_circle</i>
                                                  <input id="usuario_cliente" name="usuario_cliente" type="text">
                                                  <label for="usuario_cliente">Usuario</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">vpn_key</i>
                                                  <input id="contrasena_cliente" name="contrasena_cliente" type="text">
                                                  <label for="contrasena_cliente">Contraseña</label>
                                                </div>         
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">place</i>
                                                  <input id="direccion" name="direccion" type="text">
                                                  <label for="direccion">Dirección</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">my_location</i>
                                                  <input id="Coordenadas" name="coordenadas" type="text">
                                                  <label for="coordenadas">Coordenadas</label>
                                                </div>     
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">settings_ethernet</i>
                                                  <input id="ip" name="ip" type="text" placeholder="" disabled>
                                                  <label for="ip">Dirección IP</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">blur_linear</i>
                                                  <input id="mac" name="mac" type="text">
                                                  <label for="mac">MAC</label>
                                                </div>                        
                                              </div>     
                                            </div>
                    </div>
                  </div>

                  <div class="col s12 m12 l6">
                <div class="card white">
                                            <div class="card-content">
                                              <span class="card-title">Datos técnicos</span>

                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">insert_invitation</i>
                                                  <input id="fecha_instalacion" name="fecha_instalacion" type="text" class="datepicker" placeholder="dd/mm/AAAA">
                                                  <label for="fecha_instalacion">Fecha de Instalación</label>
                                                  <div class="errorTxt1" id="error6" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>  
                                                
                                                 <div class="col s12 m6 l6">
                                                    <label for="emisor_conectado">Equipo Emisor</label>
                                                    <select class="browser-default" id="emisor_conectado" name="emisor_conectado" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Seleccione un equipo</option>
                                                      @foreach ($eqemisor as $valor)
                                                      <option value="{{ $valor->idequipo }}">{{ $valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>                               
                                              </div>           
                                              
                                                <div class="col s12 m6 l6">
                                                    <label for="equipo_receptor">Equipo Receptor</label>
                                                    <select class="browser-default" id="equipo_receptor" name="equipo_receptor" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Equipo Cliente Receptor</option>
                                                      @foreach ($eqreceptor as $valor)
                                                      @if(is_null($valor->idestado) or $valor->idestado == 'SN')
                                                      <option value="{{ $valor->idequipo }}">{{ $valor->descripcion }}</option>
                                                      @endif
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1"></div>
                                                  </div>            

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">settings_ethernet</i>
                                                  <input id="ip_receptor" name="ip_receptor" type="text" placeholder="">
                                                  <label for="ip_receptor">IP equipo receptor</label>
                                                </div>     
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">portrait</i>
                                                  <input id="usuario_receptor" name="usuario_receptor" type="text" placeholder="">
                                                  <label for="usuario_receptor">Usuario Equipo Receptor</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">vpn_key</i>
                                                  <input id="contrasena_receptor" name="contrasena_receptor" type="text" placeholder="">
                                                  <label for="contrasena_receptor">Contraseña Equipo Receptor</label>
                                                </div>       
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">mode_edit</i>
                                                  <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"></textarea>
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
</div>
<br><br><br>
@endsection

@section('script')
  @include('forms.servicio.scripts.addServicio')  
@endsection
