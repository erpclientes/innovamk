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
                                                <div class="input-field col s12 s12 m6 l6" >
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
                          <div class="card-content "> <br>
                                             {{--  <div  class="card white col s12 m6 l10 offset-l1 " >   --}}
                                                <div class="row "> 
                                                 <div  class="card white col s12 m8 l10 offset-l1 offset-m2 " >
                                                    <div class="input-field col s12 m6 l6 offset-l1 ">                                  
                                                      <p>Fecha de instalación del servicio.</p>                                  
                                                    </div> 
                                                    <div class="col s12 m6 l4">
                                                      <input id="fecha_instalacion" name="fecha_instalacion" type="text" class="datepicker" placeholder="dd/mm/AAAA">
                                                      <label for="fecha_instalacion">Fecha de Instalación</label>
                                                      <div class="errorTxt1" id="error6" style="color: red; font-size: 12px; font-style: italic;"></div>                                   
                                                    </div> 
                                                  </div>          
                                                </div> <br>
                                                <div class="row">
                                                  <div  class="card white col s12 m8 l10 offset-l1 offset-m2 " >
                                                    <div class="input-field col s12 m6 l6 offset-l1">                                  
                                                      <p>Facturar al momento de la creación del servicio.</p>                                  
                                                    </div> 
                                                    <div class="col s12 m6 l4"> 
                                                      <select id="facturable" class="browser-default" name="facturable" onchange="elegirFacturacion(this)" > 
                                                        <option value="facturable" disabled="">Seleccionar</option> 
                                                        @foreach($parametros as $datos)
                                                          @if($datos->parametro == 'ADD_FACTURACION' ) 
                                                            @if($datos->valor == 'SI')
                                                              <option  data-parametro3="SI" value="SI" selected="">SI</option>
                                                              <option  data-parametro3="NO" value="NO">NO</option>
                                                            @else if($datos->valor == 'NO')
                                                              <option  data-parametro3="SI"value="SI">SI</option>
                                                              <option  data-parametro3="NO"value="NO" selected="">NO</option>
                                                            @endif 
                                                          @endif
                                                        @endforeach  
                                                      </select>                                      
                                                    </div>
                                                  </div> 
                                                             
                                                </div><br>
                                                <div class="row" id="instalacionDiv" > 
                                                  <div  class="card white col s12 m8 l10 offset-l1 offset-m2" >
                                                    <div class="input-field col s12 m6 l6 offset-l1">                                  
                                                      <p>Agregar concepto de instalación al la factura.</p>                                  
                                                    </div> 
                                                    <div class="col s12 m6 l4">  
                                                      <select id="instalacion" onchange="elegirInstalacion(this)" class="browser-default" name="instalacion" data-error=".errorTxt1"> 
                                                        <option value="instalacion" disabled="">Habilitar</option>
                                                        @foreach($parametros as $datos)
                                                          @if($datos->parametro == 'APLICAR_INSTALACION' ) 
                                                            @if($datos->valor == 'SI')
                                                              <option data-parametro2="SI" value="SI" selected="">SI</option>
                                                              <option data-parametro2="NO"   value="NO">NO</option>
                                                            @else if($datos->valor == 'NO')
                                                              <option data-parametro2="SI"value="SI">SI</option>
                                                              <option data-parametro2="NO"  value="NO" selected="">NO</option>
                                                            @endif 
                                                          @endif
                                                        @endforeach 
                                                      </select>                                      
                                                    </div><br><br><br> 
                                                    <div id="concepto" class=" input-field col s12 m6 l6 offset-l3" > 
                                                      @foreach($parametros as $datos)
                                                        @if($datos->parametro == 'VALOR_INSTALACION' )
                                                        <i class="material-icons prefix">attach_money</i>
                                                        <input id="precioInstalacion"  value="{{ $datos->valor_long }}" name="precioInstalacion" type="text" placeholder="" maxlength="9">
                                                        <label for="precioInstalacion">Precio del Instalación</label>
                                                        <div class="errorTxt1" id="error15" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                        @endif
                                                      @endforeach
                                                      

                                                    </div>

                                                  </div>
                                                            
                                                </div><br>
                                                <div class="row">  
                                                    <div  class="card white col s12 m8 l10 offset-l1 offset-m2 " >
                                                      <div class="input-field col s12 m6 l6 offset-l1">                                  
                                                        <p>Asignar al técnico responsable de la instalación.</p>                                  
                                                      </div> 
                                                      <div class="col s12 m6 l5 center"> 
                                                        @include('forms.servicio.modalAddTecnico')
                                                        <br>
                                                        <a href="#modalAddTecnico" class="btn-floating  modal-trigger waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Exportar">
                                                          <i class="material-icons" style="color: #2E7D32">add</i></a>

                                                      </div>
                                                      <div class="errorTxt1" id="error20" style="color: red; font-size: 12px; font-style: italic;"></div> 
                                                      <div class="col s12 m8 l10"  id="datosTecnicos" style="display: none;">  
                                                        <div class=" col s12 m10 l10 offset-l2 offset-m2 ">
                                                          <i class="material-icons prefix">perm_identity</i>
                                                          <label for="tecnico">Nombre</label>
                                                          <input style="text-align: center;" id="tecnico" readonly="readonly" name="tecnico" type="text" data-error=".errorTxt4" value=""> 
                                                          <div class="errorTxt4"></div>
                                                        </div>   
                                                        <div class=" col s12 m10 l10 offset-l2 offset-m2 " >
                                                          <i class="material-icons prefix">person</i>
                                                          <label for="documentoTecnico">Documento</label>
                                                          <input style="text-align: center;"   id="documentoTecnico" readonly="readonly" name="documentoTecnico" type="text" data-error=".errorTxt5" value=""> 
                                                          
                                                        </div> 
                                                        <input   id="idTecnico" name="idTecnico" type="hidden" data-error=".errorTxt5" value="">                                   
                                                      </div> 
                                                    </div>      
                                                </div><br> 
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
